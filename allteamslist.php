<?php
  // $Revision: 2.2 $
  // $Date: 2010/04/22 03:27:54 $
  //
  // Competition System - All Teams List
  //
  require "page.inc";
  pheader("All Teams List - Competition System - " . $host_team_name);
  $connection = dbsetup();
  ?>


<a href="/">Return to Home</a>
<table valign="top">
<tr valign="top">
<td>

<!--- Teams Section --->
<table valign="top">

<tr valign="top">
<td>
<table border="2">

<?php

  // find total team count and set page break
  if (!($result = @ mysqli_query ($connection, "select count(*) total from team")))
    dbshowerror($connection);
  $row = mysqli_fetch_array($result);
  $total = $row["total"];
  $pagebreak = ceil ($total / 3);   	// ceil rounds up


  // define result set
  if (!($result = @ mysqli_query ($connection, "select teamnum, name, nickname from team order by teamnum")))
    dbshowerror($connection);

  $rowcnt=1;
  while ($row = mysqli_fetch_array($result))
   {
    // print each row with href
    print "<tr><td><a href=\"/teamdetails.php?teamnum={$row["teamnum"]}\">{$row["teamnum"]} - {$row["name"]} ";
     // add nickname if it exists
     // if ($row["nickname"]) print "({$row["nickname"]})";
     print "</a></td></tr>\n";

    // if more than pagebreak rows, pagenate
    if (! ($rowcnt++  % $pagebreak  ))

      {
        // end last table, move next cell, start another table
        print "</table></td><td><table border=\"2\">\n";
        //$rowcnt = 0;
      }
    }
?>
</table>
</td>
</tr>
</table>


<?php
   pfooter();
 ?>
