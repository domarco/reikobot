<?php

include_once("scrap_mal_lib.php");      

// <= PHP 5
//$file = file_get_contents('./people.txt', true);
// > PHP 5
//$file = 'mal_tvseries_1961_2016.txt';
$file = 'mal_anime_list_1961_2016.txt';
$open_mal_anime_list = file_get_contents("./scrapdata/".$file);
$uns_mal_anime_list = unserialize($open_mal_anime_list);
print("<pre>".print_r($uns_mal_anime_list, true)."</pre>");
//echo count($uns_mal_anime_list);
?>