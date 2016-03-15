<?php
  // $Revision: 2.5 $
  // $Date: 2011/04/11 05:25:48 $
  //
  // Competition System - Rank teams page
  //
  // Single form to rank teams will overall rank, and if position-oriented, also rank by positions
  //  Allows sorting as part of overall analysis.
  //

  require "page.inc";

  // get variables
  $edit=$_GET["edit"];
  $sort=$_GET["sort"];		// field to be sorted
    // set default if needed
    if ($sort == "") $sort="rank_overall";

  // lsort -- listing sort  (lsort is added on from other more complicated sort associated with ranks
  $lsort=$_GET["lsort"];		// field to be sorted
    // set default if needed
    if ($lsort == "") $lsort="rank_overall";

  // header and setup
  pheader($host_team_name . " - Ranking");
  $connection = dbsetup();

  // define lock array, fields arrays
  $dblock = array(table=>"process_lock",where=>"lock_id = 'ranking'");
  $table_team = array("name","nickname","org","location","students","website");

  //
  // doc from below
  //
  // add edit link or submit button
  //
  //  this part is a little tricky:
  //    instead of using the normal post field of op for the Save button, we set a different name for each
  //    place the button is pressed. Then the results processing logic scans through the post fields and determines
  //    how to set the sort variable.  The normal "Save" is stored as a hidden value that is overwritten by a cancel operation.
  //


  // handle update if returning from edit mode
  // edit:
  //   1 = go into edit mode
  //   2 = save and return to non-edit mode
  //   3 = save and stay in edit mode
  if (($edit == 2) || ($edit == 3))
  {
  	// load operation
  	if ( $_POST[op] == "Save")
	{
		// check db
		dblock($dblock,"check");

	    // query teams from db, then iterate load variables, sort, and store
		// query and load
		if (! ($result = @ mysqli_query ($connection, "select teamnum from teambot")))
  			dbshowerror($connection, "die");

		// load teams
  		while($row = mysqli_fetch_array($result))
  		{
  			$teamnum=$row["teamnum"];

			// load sort array
			$teamsrank[$teamnum]=$_POST["{$teamnum}_rank_{$sort}"];
		}

        // sort ranks
        asort($teamsrank);

        // store in order processed, placing NULL's at end
        $cnt=1;
        foreach ($teamsrank as $teamnum => $rank)
        {
        	// if NULL skip, otherwise process
        	if ($rank != "")
        	{
        		if (! (@mysqli_query ($connection, "update teambot set rank_{$sort} = {$cnt} where teamnum = {$teamnum} ") ))
					dbshowerror($connection, "die");

				$cnt = ++$cnt;
			}
		}

		// process nulls at end of list
        foreach ($teamsrank as $teamnum => $rank)
        {
        	// if NULL skip, otherwise process
        	if ($rank == "")
        	{
        		if (! (@mysqli_query ($connection, "update teambot set rank_{$sort} = {$cnt} where teamnum = {$teamnum} ") ))
					dbshowerror($connection, "die");

				$cnt = ++$cnt;
			}
		}


		// commit
		if (! (@mysqli_commit($connection) ))
		  dbshowerror($connection, "die");

		//
		// see doc above
		//
		// look through submit vars and set sort mode.  If set, edit is 3
		if ( $_POST[overall_save] == "Save-Edit" ) {$sort="overall"; $edit=3;}
		if ($_POST[pos1_save] == "Save-Edit") { $sort="pos1"; $edit=3;}
		if ($_POST[pos2_save] == "Save-Edit") { $sort="pos2"; $edit=3;}
		if ($_POST[pos3_save] == "Save-Edit") { $sort="pos3"; $edit=3;}
	}

	// abandon/cancel lock
	dblock($dblock,"abandon");

    // update completed
    if ($edit == 2) $edit = 0;
   }  // end of edit = 2

   // define lock phrase array
   // lock tables if in edit mode
   if ($edit) dblock($dblock,"lock");  // lock row with current user id

  //
  // loads rank values from a specifed type of ranking, allows the user to edit and resort the rankings
  //  overall, pos1, pos2, pos3

  //
  // load rank values
  //

  unset( $teamsrank);  // unsetting rank arry

  if ($sort) $orderby = " order by {$lsort} ";
  $query = "select teambot.teamnum teamnum, name, nickname, rank_overall, rating_overall,
  			rating_overall_off, rating_overall_def, rank_pos1, rating_pos1, rank_pos2, rating_pos2,
  			rank_pos3, rating_pos3
  			from teambot, team where teambot.teamnum=team.teamnum {$orderby}";

	// query and load
	if (! ($result = @ mysqli_query ($connection, $query)))
  		dbshowerror($connection, "die");

	// load teams
  	while($row = mysqli_fetch_array($result))
  	{
  		$teamnum=$row["teamnum"];

  		// load team array
		$team[$teamnum]=$row;

		// load sort array
		$teamsrank[$teamnum]=$row["rank_" . $sort];

	}


  if ($edit)
  {
    // if in edit mode, signal save with edit=2
  	print "<form method=\"POST\" action=\"/rank.php?edit=2&sort={$sort}\">\n";
  	// add hidden field for op
  	hiddenfield( "op", "Save");
  }

  // add edit link or submit button
  //
  //  this part is a little tricky:
  //    instead of using the normal post field of op for the Save button, we set a different name for each
  //    place the button is pressed. Then the results processing logic scans through the post fields and determines
  //    how to set the sort variable.  The normal "Save" is stored as a hidden value that is overwritten by a cancel operation.
  //
  $url_root="/rank.php?edit=${edit}&sort=";					// note the sort is adjustable

  // show edit
  print dblockshowedit($edit, $dblock, $url_root . $sort . "&lsort=" . $lsort) . "\n";
  // Return navigation
  print "<br><a href=\"/\">Return to Home</a>\n";


  // set up table heading
  print "
  <!--- table for display data --->
  <table valign=\"top\">
  <tr><th></th>
  <th>
  "; // end of print

  // if edit, show button otherwise show as link
  if ($edit)
    {
  		print "Overall Rank<br>\n<input type=\"submit\" name=\"overall_save\" value=\"Save-Edit\">\n";
        print "</th><th>Overall Rating</th>\n";
        print "<th>Offense Rating</th>\n";
        print "<th>Defense Rating</th>\n";
    }
  else
    {
    	print "<a href=\"{$url_root}overall&lsort=rank_overall\">Overall Rank</a>";
  		print "</th><th><a href=\"{$url_root}overall&lsort=rating_overall\">Overall Rating</a></th>\n";
  		print "<th><a href=\"{$url_root}overall&lsort=rating_overall_off\">Offense Rating</a></th>\n";
  		print "<th><a href=\"{$url_root}overall&lsort=rating_overall_def\">Defense Rating</a></th>\n";
	}

  // positions rank and rating
  if ($field_positions)  // if using field positions
  {
	  // loop through positions
	  for($i=1; $i<4; $i++)
	  {
		  // pos
		  print "<th>";
		    // if edit, show button otherwise show as link
			if ($edit)
			  {
				print "Position {$i} Rank<br>\n<input type=\"submit\" name=\"pos{$i}_save\" value=\"Save-Edit\">\n";
	  			print "</th><th>Position {$i} Rating</th>\n";
			  }
			else
			  {
				print "<a href=\"{$url_root}pos{$i}&lsort=rating_pos{$i}\">Position {$i} Rank</a>";
		  		print "</th><th><a href=\"{$url_root}pos{$i}&lsort=rating_pos{$i}\">Position {$i} Rating</a></th>\n";
		  	  }
	  }
  }
  // end heaing row
  print "</th></tr>\n";


  // loop through each entry
  foreach ($teamsrank as $teamnum=>$rank)
  {
    // set edit field values
    $editfield = "<input type=\"text\" name=\"{$teamnum}_rank_{$sort}\" size=4 maxlength=4 value=\"{$team[$teamnum]["rank_{$sort}"]}\">";

  	// display values
  	print "<tr>\n";

  	// print team num, name
    print "<td>" . teamhref($teamnum) . "{$teamnum} - {$team[$teamnum]["name"]}";
    // if nickname, print too
    if ($team[$teamnum]["nickname"]) print " ({$team[$teamnum]["nickname"]})";
    print "</a></td>\n";

    // overall rank
    print "\n<td align=\"center\">";
    if (($edit) && ($sort=="overall")) print $editfield; else print $team[$teamnum]["rank_overall"];
    print "</td>\n";
    // rating
    print "<td align=\"center\">{$team[$teamnum]["rating_overall"]}</td>";

    // offense rating
    print "<td align=\"center\">{$team[$teamnum]["rating_overall_off"]}</td>";

    // defense rating
    print "<td align=\"center\">{$team[$teamnum]["rating_overall_def"]}</td>";

    // positions rank and rating
    if ($field_positions === TRUE)  // if using field positions
    {
		// loop through positions
		for($i=1; $i<4; $i++)
		{
			// rank
			print "\n<td align=\"center\">";
			if (($edit) && ($sort=="pos" . $i)) print $editfield; else print $team[$teamnum]["rank_pos" . $i];
			print "</td><td align=\"center\">{$team[$teamnum]["rating_pos" . $i]}</td>";
		}
	}

    // close row
  	print "</tr>\n";
  }

  // close table
  print "</table>";


  $options["tr"] = 0;  // add tr tags


  // show edit at bottom
  print "<br>\n";
  print dblockshowedit($edit, $dblock, $url_root . $sort . "&lsort=" . $lsort) . "\n";


  // close the form if in edit mode
  if ($edit) print "\n</form>\n";




?>

<?php
   pfooter();
  ?>
