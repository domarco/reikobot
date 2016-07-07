<?php
include_once("scrap_mal_lib.php");

$file = 'tes_anime.txt';

$left_content_page = file_get_contents("./scrapdata/".$file);
$count = 0;
$information_content = scrape_between($left_content_page, "<h2>Information</h2>", "<h2>Statistics</h2>");
$separate_information = explode("<span class=\"dark_text\">", $information_content);   // Separate each anime links into parts of array

$statistics_content = scrape_between($left_content_page, "<h2>Statistics</h2>", "<div class=\"clearfix mauto mt16\"");
$separate_statistics = explode("<span class=\"dark_text\">", $statistics_content);  

print_r($separate_information);
$anime_list = array();
//$episodes = preg_replace("/[^0-9,.]/", "", $separate_information[2]);			$anime_list[$count][] = $episodes;
//getting anime detail info
$type 		= scrape_between($separate_information[1], "\">", "</a>");			$anime_list[$count][] = $type;
$episodes 	= scrape_between($separate_information[2], " ", "</div>");				
$episodes 	= substr($episodes, 1, -3);												$anime_list[$count][] = $episodes;
$status 	= scrape_between($separate_information[3], " ", "</div>");				
$status 	= substr($status, 1, -3);												$anime_list[$count][] = $status;
$aired_date = scrape_between($separate_information[4], " ", "to");					
$aired_date	= substr($aired_date, 1, -1);											$anime_list[$count][] = $aired_date;
$aired_end_date = scrape_between($separate_information[4], "to ", "</div>");	
$aired_end_date	= substr($aired_end_date, 0, -3);										$anime_list[$count][] = $aired_end_date;
$season 	= scrape_between($separate_information[5], "\">", "</a>");			$anime_list[$count][] = $season;
$studio 	= scrape_between($separate_information[9], "\">", "</a>");			$anime_list[$count][] = $studio;
$source 	= scrape_between($separate_information[10], " ", "</div>");					
$source		= substr($source, 1, -3);												$anime_list[$count][] = $source;
$genre 		= scrape_between($separate_information[11], " ", "</div>");			
$results_genre = scrape_genre($genre);											$anime_list[$count][] = $results_genre;
$ranked		= scrape_between($separate_statistics[2], "#", "<sup>");			$anime_list[$count][] = $ranked;
$popularity	= scrape_between($separate_statistics[3], "#", "</div>");			
$popularity	= substr($popularity, 0, -3);										$anime_list[$count][] = $popularity;
$count++;

//$genre 		= scrape_between($separate_information[5], "\">", "</a>");		$anime_list[$count][] = $genre;
//echo "<br>".$results_genre;
$s_anime_list = serialize($anime_list);
file_put_contents("./scrapdata/s_anime_list.txt", $s_anime_list);

$open_anime_list = file_get_contents("./scrapdata/s_anime_list.txt");
$uns_anime_list = unserialize($open_anime_list);

print("<pre>".print_r($uns_anime_list, true)."</pre>");
//echo $anime_list[0][1].$anime_list[0][0].$anime_list[0][2];

function scrape_genre($data) {
	$genre_arr	= explode("</a>", $data);
	$results_genre = "";
	foreach ($genre_arr as $arr) {
		if ($arr != "") {	// if array contain genre text	
			if ($results_genre != "") 	// to maintain koma in $results_genre
				$results_genre = $results_genre.",";
			
			$result_genre = scrape_between($arr, "title=\"", "\""); // scrape: genre description in title="<genre>"
			$results_genre = $results_genre.$result_genre; 
		}
	}
	return $results_genre;
}
?>