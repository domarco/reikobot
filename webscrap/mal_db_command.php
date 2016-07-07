<?php
require 'db_connect.php';

function insert_mal_database($load_file) {
	$conn = db_connect();

	if ($conn) {
		//echo "success";
		//get anime data from text file
		$open_mal_anime_list = file_get_contents("./scrapdata/".$load_file);
		$uns_mal_anime_list = unserialize($open_mal_anime_list);
		
		$anime_arr = array();
		$i = 0; 
		//build multiple VALUES
		foreach($uns_mal_anime_list as $anime) {
			$index = 0;
			$number			= $anime[$index++];
			$title 			= $conn->real_escape_string($anime[$index++]); // handling the apostrophe in title
			$description 	= $conn->real_escape_string($anime[$index++]); // handling the apostrophe in description
			$type 			= $anime[$index++];
			$episodes 		= $anime[$index++];
			$status 		= $anime[$index++];
			$aired_date 	= convert_to_date($anime[$index++]); // convert string to acceptable DATE type
			$aired_end_date = convert_to_date($anime[$index++]);
			$season 		= $anime[$index++];
			$studio 		= $anime[$index++];
			$source 		= $anime[$index++];
			$genre 			= $anime[$index++];
			$ranked 		= $anime[$index++];
			$popularity 	= $anime[$index++];
			$url 			= $anime[$index++];

			$anime_arr[] = "(
				'$number', 
				'$title', 
				'$description', 
				'$type', 
				'$episodes',
				'$status', 
				'$aired_date', 
				'$aired_end_date', 
				'$season', 
				'$studio', 
				'$source', 
				'$genre', 
				'$ranked', 
				'$popularity', 
				'$url')
			";
			//if($i == 1) break;
			//$i++;
		}
		$sql = "
			INSERT IGNORE INTO anime_tvseries (
				number, 
				title,
				description,
				type,
				episodes,
				status,
				aired_date,
				aired_end_date,
				season,
				studio,
				source,
				genre,
				ranked,
				popularity,
				url)
			VALUES ";
		
		$sql .= implode(',', $anime_arr); // append value of array as insert command VALUES
		
		if ($conn->query($sql)) {
		    echo "Anime records created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();		
	}
}

function convert_to_date($date) {

	$yyyy = substr($date, -4); //last 4 character
	$mm = substr($date, 0, 3); //first 3 character
	$dd = substr($date, 4, -6);//stript first 4 and strip last 6 char

	$mm = convert_month($mm);

	return $yyyy."-".$mm."-".$dd;
}

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
?>