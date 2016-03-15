<?php
	// $Revision: 1.2 $
	// $Date: 2010/06/26 20:26:48 $
	//
	// Competition System - documentation
	//
	require "page.inc";
	$connection = dbsetup();

	$page=$_GET["page"];
	$edit=$_GET["edit"];

	pheader("Documentation: {$page}");

	print "<a href=\"/documentationhome.php\">Documentation Home</a><br>";

	$fields = array("documentation", "topic", "priority");
	$fieldsizes = array(documentation=>20, topic=>20, priority=>2);

	$dblock = array(table=>"documentation", where=>"documentation='{$page}'");

	//
	// edit:
	// 0- no edit
	// 1- edit page
	// 2- enter data from 1 and return to non-edit mode
	// 3- prompt to comfirm delete
	// 4- delete this doc, link to home or to add documentation

	if($edit==2)
	{
		//dblock($dblock,"changedby");
		dblock($dblock,"check");

		if (! (@mysqli_query ($connection, "delete from documentation where documentation='{$page}'") ))
			dbshowerror($connection, "die");

		$query="insert into documentation (";
		foreach($fields as $name)
			if(isset($_POST[$name."input"]) && $_POST[$name."input"]!="")
				$query=$query."{$name}, ";
		$query=$query."data) values (";
		foreach($fields as $name)
			if(isset($_POST[$name."input"]) && $_POST[$name."input"]!="")
				$query=$query."'{$_POST[$name."input"]}', ";
		$query=$query."'{$_POST["datainput"]}')";

		if (! (@mysqli_query ($connection, $query) ))
			dbshowerror($connection, "die");


		if (! ($result=@mysqli_query ($connection, "select * from pagetodoc where documentation='{$page}'") ))
			dbshowerror($connection, "die");
		$totalpage=0;
		while($row = mysqli_fetch_array($result))
			$totalpage++;
		if (! (@mysqli_query ($connection, "delete from pagetodoc where documentation='{$page}'") ))
			dbshowerror($connection, "die");

		$page=$_POST["documentationinput"];
		$dblock = array(table=>"documentation",where=>"documentation='{$page}'");

		$c=0;
		while($c<=$totalpage)
		{
			$temp=$_POST["page".$c];
			if(isset($temp) && $temp!="")
			{
				if (! (@mysqli_query ($connection, "insert into pagetodoc (documentation, page) values ('{$page}', '{$temp}')") ))
					dbshowerror($connection, "die");
			}
			$c++;
		}

		dblock($dblock,"abandon");

		$edit=0;
	}
	if($edit==3 || $edit==4)
		dblock($dblock,"check");

	if ($edit) dblock($dblock,"lock");

    $editURL = "/documentation.php?page={$page}";
    //print dblockshowedit($edit, $dblock, $editURL);

	if(!isset($page))
		print "<font color=red>No Documentation selected</font>";

	if (! ($result=@mysqli_query ($connection, "select * from documentation where documentation='{$page}'") ))
		dbshowerror($connection, "die");

	$doc=mysqli_fetch_array($result);
	$data=$doc["data"];

	if($admin)
	{
		if($edit==3)
		{
			print "<font color=red><b>You have requested this documentation to be deleted<br>ARE YOU ABSOLUTELY SURE?</b></font>";
			print "<br><a href=\"/documentation.php?page={$page}&edit=4\">Yes, Kill it</a>&nbsp&nbsp&nbsp&nbsp";
			print "<a href=\"/documentation.php?page={$page}\">No, save me</a>";
		}
		else if($edit==4)
		{
			if (! (@mysqli_query ($connection, "delete from documentation where documentation='{$page}'") ))
				dbshowerror($connection, "die");

			print "<b>This documentation has been deleted</b><br>&nbsp&nbsp;I hope you know what you're doing";
			print "<br><a href=\"/documentationhome.php\">Documentation Home</a>";
			print "<br><a href=\"/newdocumentation.php\">Create new Documentation</a>";
		}
		else
		{
			if($edit)
			{
				print "<a href=\"/documentation.php?page={$page}&edit=3\">Delete this page</a>";
				print "<br><a href=\"/documentation.php?page={$page}&$edit=0\">Cancel Editing</a>";
				print "<form method=\"POST\" action=\"/documentation.php?page={$page}&edit=2\">";
			}

			print dblockshowedit($edit, $dblock, $editURL);

			print "<br><br><table border=1><tr>";
			foreach($fields as $name)
				print "<td>{$name}</td>";
			print "</tr><tr>";
			foreach($fields as $name)
			{
				if($edit)
					print "<td><input type=\"text\" name=\"{$name}input\" size={$fieldsize[$name]} maxlength={$fieldsize[$name]} value='{$doc[$name]}'></td>";
				else
					print "<td>{$doc[$name]}</td>";
			}

			print "</table><br>Pages:";

			//print pages:
			if (! ($result=(@mysqli_query ($connection, "select page from pagetodoc where documentation='{$page}'") )))
				dbshowerror($connection, "die");
			$count=0;
			while($row=mysqli_fetch_array($result))
			{
				if($edit)
					print " <input type=\"text\" name=\"page{$count}\" size=10 maxlength=20 value='{$row["page"]}'>";
				else
				{
					if($count==0)
						print " {$row["page"]}";
					else
						print ", {$row["page"]}";
				}
				$count++;
			}
			if($edit)//new page
				print " <input type=\"text\" name=\"page{$count}\" size=10 maxlength=20>";
			print "<br><br>";
		}
	}
	else
	{
		print "Topic: ".$doc["topic"];
		$edit=0;
	}

	if($edit!=3 && $edit!=4)
	{
		if($edit)
		{
			print "<input type=\"text\" name=\"datainput\" size=5000 maxlength=5000 value={$data}>";
			print "<INPUT TYPE=\"submit\" name=\"Submit\" VALUE=\"Save\" ALIGN=middle BORDER=0></form>";
		}
		else
			print $data;
	}

	pfooter();
?>