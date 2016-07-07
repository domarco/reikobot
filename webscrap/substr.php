<?php
	//$episodes = " 40 ";
	//echo substr($episodes, 1, -1)."TV";	
/*
	$string = "ABC (Test1) [test2] {test3}";
	$string = preg_replace("/\([^)]+\)/","",$string); 
	$string = preg_replace("/\[[^\]]+\]/","",$string); 
	$string = preg_replace("/\{[^}]+\}/","",$string); 
	echo $string."<br>";
*/	
	//echo preg_replace("/\\[[^\\]]*\\]/", "", $string);

/* tes array
	$cars = array
  (
	  array("Volvo",22,18),
	  array("BMW",15,13),
	  array("Saab",5,2),
	  array("Land Rover",17,15)
  );
  $i = 0;
  foreach ($cars as $car) {
  	$j = 0;
  	echo $car[$j++].",";
  	echo $car[$j++]."<br>";
  	$i++;
  }
  */
/*
function convert_to_date($date) {

	$yyyy = substr($date, -4);
	$mm = substr($date, 0, 3);
	$dd = substr($date, 4, -6);

	$mm = convert_month($mm);

	return $yyyy."-".$mm."-".$dd;
}
$date1 = 'May 1, 1986';
$date2 = 'Feb 25, 2016';

$date1 = convert_to_date($date1);
$date2 = convert_to_date($date2);

echo $date1." ".$date2;


function convert_month($mm) {
	$mm = strtolower($mm);

	if ($mm == "jan") $mm = '01';
	else if ($mm == "feb") $mm = '02';
	else if ($mm == "mar") $mm = '03';
	else if ($mm == "apr") $mm = '04';
	else if ($mm == "may") $mm = '05';
	else if ($mm == "jun") $mm = '06';
	else if ($mm == "jul") $mm = '07';
	else if ($mm == "aug") $mm = '08';
	else if ($mm == "sep") $mm = '09';
	else if ($mm == "oct") $mm = '10';
	else if ($mm == "nov") $mm = '11';
	else if ($mm == "dec") $mm = '12';
	 
	return $mm;
}
*/
/*
require 'db_connect.php';
$description = "The hawk eye's. was an irregular who have the biggest cars inside's.";
$conn = db_connect();
$text = mysqli_real_escape_string($conn, $description);
mysqli_close($conn);
echo $text;
*/
require 'scrap_mal_lib.php';

$string = "http://myanimelist.net/anime/1745/Wild_7_Another_Bouryaku_Unga";
$string = scrape_between($string, "anime/", "/");
echo $string;


?>