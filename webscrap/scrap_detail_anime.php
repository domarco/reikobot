<?php

function scrap_detail_anime($load_file, $save_file) {

	$content_urls = file_get_contents('./scrapdata/'.$load_file);
	$uns_content_urls = unserialize($content_urls);

	//echo count($uns_mal_anime);
	$mal_anime_list = array();
	$count = 0;
	$loop = 0;

	foreach($uns_content_urls as $content_url) {
	 	set_time_limit(180);  
	 	
	 	$content_page = curl($content_url);    // Retrieving each anime page from urls

	    $title = scrape_between($content_page, "<span itemprop=\"name\">", "</span>");
	    $synopsis = scrape_between($content_page, "<span itemprop=\"description\">", "</span>");
		$synopsis = scrape_synopsis($synopsis);
		//echo $synopsis; break;
		$left_content_page = scrape_between($content_page, "<div class=\"js-scrollfix-bottom\"", "<div class=\"js-scrollfix-bottom-rel\"");
	 	
	 	
	    //information_content contains; type, episodes, status, start&end date, studio, and source
		$information_content = scrape_between($left_content_page, "<h2>Information</h2>", "<h2>Statistics</h2>");
		$separate_information = explode("<span class=\"dark_text\">", $information_content);   // Separate each anime links into parts of array

		//statistics_content contains: ranked and popularity
		$statistics_content = scrape_between($left_content_page, "<h2>Statistics</h2>", "<div class=\"clearfix mauto mt16\"");
		$separate_statistics = explode("<span class=\"dark_text\">", $statistics_content);  

		// Fill each anime info into multidimensional array
		$mal_anime_list[$count][] = scrape_between($content_url, "anime/", "/");
		$mal_anime_list[$count][] = $title;	
		$mal_anime_list[$count][] = $synopsis;
		$type 		= scrape_between($separate_information[1], "\">", "</a>");			$mal_anime_list[$count][] = $type;
		$episodes 	= scrape_between($separate_information[2], " ", "</div>");				
		$episodes 	= substr($episodes, 1, -3);											$mal_anime_list[$count][] = $episodes;
		$status 	= scrape_between($separate_information[3], " ", "</div>");				
		$status 	= substr($status, 1, -3);											$mal_anime_list[$count][] = $status;
		$aired_date = scrape_between($separate_information[4], " ", "to");					
		$aired_date	= substr($aired_date, 1, -1);										$mal_anime_list[$count][] = $aired_date;
		$aired_end_date = scrape_between($separate_information[4], "to ", "</div>");	
		$aired_end_date	= substr($aired_end_date, 0, -3);								$mal_anime_list[$count][] = $aired_end_date;
		$season 	= scrape_between($separate_information[5], "\">", "</a>");			$mal_anime_list[$count][] = $season;
		$studio 	= scrape_between($separate_information[9], "\">", "</a>");			$mal_anime_list[$count][] = $studio;
		$source 	= scrape_between($separate_information[10], " ", "</div>");					
		$source		= substr($source, 1, -3);											$mal_anime_list[$count][] = $source;
		$genre 		= scrape_between($separate_information[11], " ", "</div>");			
		$results_genre = scrape_genre($genre);											$mal_anime_list[$count][] = $results_genre;
		$ranked		= scrape_between($separate_statistics[2], "#", "<sup>");			$mal_anime_list[$count][] = $ranked;
		$popularity	= scrape_between($separate_statistics[3], "#", "</div>");			
		$popularity	= substr($popularity, 0, -3);										$mal_anime_list[$count][] = $popularity;
		$mal_anime_list[$count][] = $content_url;

	    //if ($loop == 5) break;
	    sleep(rand(3,5));
	    $count++;
		$loop++;
	}

	if ($mal_anime_list != "") {
		$s_mal_anime_list = serialize($mal_anime_list);
		file_put_contents("./scrapdata/".$save_file, $s_mal_anime_list); // put the anime results to text file
		//echo $count."<br>";
	}
	//show_detail_anime($save_file);
}

function scrape_genre($string) {
    $genre_arr  = explode("</a>", $string);
    $results_genre = "";
    foreach ($genre_arr as $arr) {
        if ($arr != "") {   // if array contain genre text  
            if ($results_genre != "")   // to maintain koma in $results_genre
                $results_genre = $results_genre.",";
            
            $result_genre = scrape_between($arr, "title=\"", "\""); // scrape: genre description in title="<genre>"
            $results_genre = $results_genre.$result_genre; 
        }
    }
    return $results_genre;
}

function scrape_synopsis($string) {
    $string = strip_tags($string);
    $string = preg_replace("/\([^)]+\)/","",$string); 
    $string = preg_replace("/\[[^\]]+\]/","",$string); 
    $string = preg_replace("/\{[^}]+\}/","",$string); 
    $string = substr($string, 0, -5);
    return $string; 
}

function show_detail_anime($file) {
	$open_mal_anime_list = file_get_contents("./scrapdata/".$file);
	$uns_mal_anime_list = unserialize($open_mal_anime_list);
	print("<pre>".print_r($uns_mal_anime_list, true)."</pre>");
}
?>