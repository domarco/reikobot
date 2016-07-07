<?php
require './webscrap/db_connect.php';
require './nlp_library.php';
require './tagger.php';

$message = "tell me about kyoukai senjou.";

//$message = strip_punctuation($message);
$message = stop_words($message);
$message = regex_tokenizer($message);

$tagger = new PosTagger('./corpus/lexicon.txt');
$results_tag = $tagger->tag($message);

//$keywords = array_values($message);

//$results_title = new_ztable(1); // 1 = title, see documentation inside the function
//$results_hunt = hunting_titles($keywords, $results_title); // retrieve possible match anime

print("<pre>".print_r($result_tags, true)."</pre>");



function hunting_titles ($keywords, $list_of_titles) {
	// Let the hunt begin 
	$count = 0;

	foreach($list_of_titles as $title){ // loop all anime title entry
		$flag = false;	// controlling the new array that got priority match
		
		foreach($keywords as $word) {
		
			$word = "/(".$word.")/"; // turned word into a regex pattern
			
			if (preg_match($word, $title)) {
				if ( empty($hunt_results[$count]['score']) ) {
					$hunt_results[$count]['score'] = 0;	
				}
				$hunt_results[$count]['score'] += 1; // how  many hit in the hunt		
				$flag = true;
			}
		}
		if ($flag) {
			$hunt_results[$count]['title'] = $title;
			$count++;
		}
	}
	return $hunt_results;
} 

function new_ztable ($column) {
	//0 key, 1 title, 2 desc, 3 type, 4 episodes, 5 status, 6 startDate, 7 endDate, 8 season, 9 studio, 10 source, 11 genre, 12 ranked, 13 popularity, 14 url 
	$load_file = 'mal_anime_list_1961_2016.txt';

	$open_mal_anime_list = file_get_contents("../webscrap/scrapdata/".$load_file);
	$uns_mal_anime_list = unserialize($open_mal_anime_list);

	foreach($uns_mal_anime_list as $anime) {
		$lower_text= strtolower($anime[$column]);
		$results_title[] = $lower_text; 
	}	
	sort($results_title);
	return $results_title;
}

?>