<?php
//
// $Revision: 1.4 $
// $Date: 2011/04/11 04:05:50 $
//
//
// Contains names and sizes of different data fields accessed so less hard coding is needed
// Include 2 arrays with the same keys: one with names and one with sizes of inputs
//
// Notes:
//  - General params are in first section

//require "page.inc";

// jlv doesn't understand??

// if fields positions matter, start with position
if ($field_positions === TRUE)
{
	$match_team_name = array(position=>"Position");
	$match_team_size = array(position=>1);
}
else
{
	$match_team_name = array();
	$match_team_size = array();
}

$match_team_name = array_merge ( $match_team_name, array(rating_offense=>"Offense Rating (0-9)", 
	rating_defense=>"Defense Rating (0-9)", raw_points=>"Raw Points", penalties=>"Penalties"));
$match_team_size = array_merge ( $match_team_size, array(position=>1, rating_offense=>1, 
	rating_defense=>1, raw_points=>2, penalties=>2, MatchField_0=>10));


	
function list_fields($names)
{
	$toreturn="";
	$total=0;
	foreach($names as $key)
		$total++;
	$counter=0;
	foreach($names as $key=>$value)
	{
		$counter++;
		$toreturn=$toreturn.$key;
		if($counter!=$total)
			$toreturn=$toreturn.", ";
	}
	return $toreturn;
}

function fill_tab_text_field($edit, $options, $data, $displayarray, $sizearray)
{
	$toreturn = "";
	foreach($displayarray as $myname=>$display)
		$toreturn=$toreturn.tabtextfield($edit, $options, $data, $myname, 
			$displayarray[$myname], $sizearray[$myname], $sizearray[$myname]);
	return $toreturn;
}