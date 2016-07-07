<?php
require 'scrap_mal_lib.php';            
require 'scrap_link_anime.php';
require 'scrap_detail_anime.php';
require 'mal_db_command.php';

$url = "http://myanimelist.net/anime.php?q=&type=1&score=0&status=0&p=0&r=0&sm=1&sd=1&sy=1917&em=12&ed=31&ey=2016&c[0]=d&c[1]=e&gx=0&o=2&w=1&o=2&w=2"; // anime type: tv 1917-2016

$header_file = 'mal_tvseries_1961_2016.txt';
$detail_file = 'mal_anime_list_1961_2016.txt';

//scrap_link_anime($url, $header_file);
//scrap_detail_anime($header_file, $detail_file);
insert_mal_database($detail_file);

?>