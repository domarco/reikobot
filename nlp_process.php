<?php
require 'nlp_library.php';
include 'pattern.php';

$message = $_POST['userMessage']; // contain user message that send from jquery AJAX
/*
if ($message == "tes"); {
	$message = "What! is the most popular @ANIME... ?";
}
*/
/*
echo $message."<br>";
*/

$message = strip_punctuation($message);

/*
echo "strip_punctuation: ".$message."<br>";
*/

$message = stop_words($message);

/*
echo "stop_words: ";
print_r($message);
echo "<br>";
*/

$message = regex_tokenizer($message);

/*
echo "regex_tokenizer: ";
print_r($message);
echo "<br>";
*/

print_r($message);
?>