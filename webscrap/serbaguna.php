<?php
require 'db_connect.php';
require 'scrap_mal_lib.php';

$conn = db_connect();

//$s_results_urls = serialize($results_urls);
//file_put_contents("serbagna.txt");

// Perbaikan key yg salah akibat preg_replace, seperti yg dibawah ini:
// http://myanimelist.net/anime/1234/12-sai => 123412 (<= preg_replace) seharusnya 1234,
/*
$count = 0;
if ($conn) {
	$sql = "SELECT ani_key, url FROM anime_tvseries";

	if ($results = $conn->query($sql)) {
		//echo "query sukses";
		// fetch associative array 
	    while ($row = $results->fetch_assoc()) {
	    	
			set_time_limit(120);
	    	$url = scrape_between($row['url'], "anime/", "/");
	    	//print("%s (%s)\n", $row['ani_key'], $url);
	    	if ($url != $row['ani_key']) {
	    		$results_urls[$count]['ani_key'] = $row['ani_key']; 
		    	$results_urls[$count]['url'] = $url;
	    		$count++;
	    		
	    		$sql_update = "
	    			UPDATE anime_tvseries 
	    			SET ani_key = '".$url."'
	    			WHERE ani_key = '".$row['ani_key']."' ";

	    		if ($conn->query($sql_update)) {
	    			echo $sql_update;
	    			echo "| update ".$row['ani_key']." to ".$url." success.<br>";
	    		}
				else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				} 	
	    	}
	    }
	    
	}
	else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	print("<pre>".print_r($results_urls, true)."</pre>");

}

//print("<pre>".print_r($hunt_results, true)."</pre>");

*/
?>