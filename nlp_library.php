<?php
include("php-nlp-tools-master/autoloader.php");

//Normalizer
use NlpTools\Utils\Normalizers\Normalizer;

//Tokenizer
use NlpTools\Tokenizers\RegexTokenizer;
use NlpTools\Documents\TokensDocument;

//Stop Words
use NlpTools\Utils\StopWords;

function strip_punctuation($string) {
    $string = strtolower($string);
    $string = preg_replace("/[[:punct:]]+/", " ", $string);
    $string = str_replace(" +", " ", $string);
    
	return $string;
}

function regex_tokenizer($string) {
	$rtok = new RegexTokenizer(array(
		array("/\s+/"," "),              // replace many spaces with a single space
		array("/'(m|ve|d|s)/", " '\$1"), // split I've, it's, we've, we'd, ...
		"/ /"                            // split on every space
	));

	return $rtok->tokenize($string);
}

function stop_words($string) {	 
	$stop = new StopWords(array(
		"are", "is", "were", "was",
		"'re",
		"a", "an",
		"in", "on"
	));
	
	$string = new TokensDocument(explode(" ", $string));
	$string->applyTransformation($stop);
	$string = $string->getDocumentData();
	
	$stop_words = "";
	foreach ($string as $str) {
		$stop_words = $stop_words." ".$str;
	}
	return $stop_words;
}

function normalizer($string, $lang) {
	
	if ($lang == "") {
		$lang = "English";
	}
	$norm = Normalizer::factory($lang);
	
	$string = new TokensDocument(explode(" ", $string));
	$string->applyTransformation($norm);
	return $string->getDocumentData();
}
?>