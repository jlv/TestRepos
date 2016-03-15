<?php
//
// $Revision: 2.5 $
// $Date: 2011/04/08 07:17:46 $
//
// params.inc
//
// Contains all user and admin settable parameters needed by the competition system
//
// Notes:
//  - General params are in first section
//  
//  - 

// 
// Nationals / Regionals
//
// Set to specify regional
$default_league = "Reg";   // Reg for regional

//
// Host team - Team that uses this db
$host_teamnum=3006;
$host_team_name="Red Rock Robotics";


// 
// Field positions
//
// Set to TRUE if field positions (where a robot starts and plays) matter in the analysis.  Some years very important, 
//   some years not important at all.  Set to false to skip and field positions will not be used in analysis forms
//
//$field_positions = TRUE;
$field_positions = FALSE;

//
// Field parameters
//
// Notes:
//  Field parameters are intended to be changed every year for a given game
//  
// Should we create a "alliance position" switch too?  (for later)

// Comment out unsed params or set used to FALSE

//
// Pit Fields -- can be analyzed from pit discussions
// DEPRICATE:  will need to edit out of references.  DO NOT comment out all lines until you fix.
//
$dispfields["Pit"][0] = array("used"=>TRUE, "display"=>"Kicker type", "inputlen"=>10, "maxlen"=>14, "default_value"=>"");
$dispfields["Pit"][1] = array("used"=>TRUE, "display"=>"Drive-Wheels", "inputlen"=>3, "maxlen"=>3, "default_value"=>"");
$dispfields["Pit"][2] = array("used"=>TRUE, "display"=>"Drive-Wheel-type ", "inputlen"=>15, "maxlen"=>20, "default_value"=>"");
//  $dispfields["Pit"][3] = array("used"=>TRUE, "display"=>"Wide/Narrow Forward (W/N)", "inputlen"=>5, "maxlen"=>10, "default_value"=>"");
//  $dispfields["Pit"][4] = array("used"=>TRUE, "display"=>"Drive-type", "inputlen"=>12, "maxlen"=>18, "default_value"=>"");
//  $dispfields["Pit"][5] = array("used"=>TRUE, "display"=>"Roll Cage", "inputlen"=>10, "maxlen"=>15, "default_value"=>"");
//  $dispfields["Pit"][6] = array("used"=>TRUE, "display"=>"Tunnel", "inputlen"=>10, "maxlen"=>15, "default_value"=>"");
//  $dispfields["Pit"][7] = array("used"=>TRUE, "display"=>"Bump", "inputlen"=>15, "maxlen"=>15, "default_value"=>"");
//  $dispfields["Pit"][8] = array("used"=>TRUE, "display"=>"Omni Wheels", "inputlen"=>15, "maxlen"=>15, "default_value"=>"");
//  $dispfields["Pit"][9] = array("used"=>TRUE, "display"=>"End Game", "inputlen"=>12, "maxlen"=>12, "default_value"=>"");
// $dispfields["Pit"][10] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Pit"][11] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Pit"][12] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Pit"][13] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Pit"][14] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Pit"][15] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");



//
// Play Fields -- analyzed from field play, pit, or other analysis of robot
//
$dispfields["Play"][0] = array("used"=>TRUE, "display"=>"Arm/Grabber Type", "inputlen"=>10, "maxlen"=>14, "default_value"=>"");
$dispfields["Play"][1] = array("used"=>TRUE, "display"=>"Post Heights Accessible", "inputlen"=>6, "maxlen"=>6, "default_value"=>"");
$dispfields["Play"][2] = array("used"=>TRUE, "display"=>"Grabber Reliability (0-5)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][3] = array("used"=>TRUE, "display"=>"Hang Success", "inputlen"=>15, "maxlen"=>20, "default_value"=>"");
$dispfields["Play"][4] = array("used"=>TRUE, "display"=>"End Game (Y/N)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"N");
$dispfields["Play"][5] = array("used"=>TRUE, "display"=>"End Game Speed", "inputlen"=>2, "maxlen"=>2, "default_value"=>"00");
$dispfields["Play"][6] = array("used"=>TRUE, "display"=>"Arm Speed (0-5)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"0");
$dispfields["Play"][7] = array("used"=>TRUE, "display"=>"Drive-type", "inputlen"=>12, "maxlen"=>18, "default_value"=>"");
$dispfields["Play"][8] = array("used"=>TRUE, "display"=>"Drive Manueverability", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][9] = array("used"=>TRUE, "display"=>"Drive Speed", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][10] = array("used"=>TRUE, "display"=>"Drive-Wheels", "inputlen"=>3, "maxlen"=>3, "default_value"=>"");
$dispfields["Play"][11] = array("used"=>TRUE, "display"=>"Drive-Wheel-type", "inputlen"=>15, "maxlen"=>20, "default_value"=>"");
$dispfields["Play"][12] = array("used"=>TRUE, "display"=>"Stability", "inputlen"=>10, "maxlen"=>15, "default_value"=>"");
$dispfields["Play"][13] = array("used"=>TRUE, "display"=>"Picks Tubes Off Floor", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][14] = array("used"=>TRUE, "display"=>"Operator Skill", "inputlen"=>15, "maxlen"=>15, "default_value"=>"");
$dispfields["Play"][15] = array("used"=>TRUE, "display"=>"Driver Skill", "inputlen"=>15, "maxlen"=>15, "default_value"=>"");
$dispfields["Play"][16] = array("used"=>TRUE, "display"=>"Y Autonomous Mode", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][17] = array("used"=>TRUE, "display"=>"Autonomous mode rating (0-4)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][18] = array("used"=>TRUE, "display"=>"Autonomous height (0-3)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Play"][19] = array("used"=>TRUE, "display"=>"Reliability", "inputlen"=>10, "maxlen"=>20, "default_value"=>"");
// $dispfields["Play"][20] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][21] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][22] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][23] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][24] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][25] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][26] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][27] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][28] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][29] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][30] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][31] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][32] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][33] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][34] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Play"][35] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");


//
// Match Fields -- analyzed in each match.  Data specific to that match
//
$dispfields["Match"][0] = array("used"=>TRUE, "display"=>"Gets pinned", "inputlen"=>12, "maxlen"=>20, "default_value"=>"");
$dispfields["Match"][1] = array("used"=>TRUE, "display"=>"Autonomous mode", "inputlen"=>8, "maxlen"=>15, "default_value"=>"");
$dispfields["Match"][2] = array("used"=>TRUE, "display"=>"Autonomous height (0-3)", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
$dispfields["Match"][3] = array("used"=>TRUE, "display"=>"Endgame speed", "inputlen"=>10, "maxlen"=>10, "default_value"=>"");
$dispfields["Match"][4] = array("used"=>TRUE, "display"=>"Endgame Rank", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][5] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][6] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][7] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][8] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][9] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][10] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][11] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][12] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][13] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][14] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][15] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][16] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][17] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][18] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");
// $dispfields["Match"][19] = array("used"=>TRUE, "display"=>"", "inputlen"=>1, "maxlen"=>1, "default_value"=>"");



//
// function that returns the seed score for a match
// give raw scores (startine with mine), penalty points, and other
function seedscore($my_raw_score, $their_raw_score, $my_penalties, $their_penalties, $my_other, $their_other)
{
   $my_score=$my_raw_score-$mypenalties;
   $their_score=$their_raw_score-$their_penalties;

   if($my_score>$their_score)
      $seed=$my_score+2*($their_score)+5;//winner's seed
   else if($my_score<$their_score)
      $seed=$their_raw_score;//looser's seed
   else
      $seed=3*$my_score;//tie
   return($seed);
}

//
// Database parameters
//

$dbname = "competition";

$dbuser = "compuser";

$dbpass = "3006redrock";

$dbhost = "localhost";


//
// Schedule files and documentation
//
$schedule_xls = "doc/qualification_schedule.xls";
$schedule_csv = "doc/qualification_schedule.csv";


//
// Message  timing for message recv application
//

$message_refresh = 8;


// ***************************
//
// Security
//
//

// default user password (filled in)
$default_password = "redrock";

// administrator users
$admins = array("jlv", "conrad", "nichols", "kasper");

// location of security files and routines

$htpasswdfile = "C:\Program Files\Apache Software Foundation\Apache2.2\admin\htpasswd.master";
$htpasswdexe = "..\bin\htpasswd.exe";
// $htpasswdexe = "C:\Program Files\Apache Software Foundation\Apache2.2\bin\htpasswd.exe";


// ***************************
//
// Misc App Configuration
//

// background colors used for red and blue teams
$background_colors = array ("R"=>"#ffaaaa", "Red"=>"#ffaaaa", "B"=>"#aaaaff", "Blue"=>"#aaaaff");

// background colors for other areas
$lyellow = '#ffff66';
$lgreen = '#ccffcc';
$lblue = '#ccccff';
$lred = '#ffcccc';

//length of the updated by field
$maxlengthchangeby=200;

//
// end of params.inc -- do not leave any lines under the end of this closure or html is not well-formed with top header line
//
?>