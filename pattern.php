<?php

$conversation_pattern = array (
	"/((selamat)|(good)) *((pagi)|(morning)|(siang)|(afternoon)|(sore)|(evening)|(malem)|(night)) *((sophia)|(sofia)|(sopia))?/"	
);	

$ask_pattern = array (
	"/((what )|(who )|(when )|(why )|(where )|(how ))/"
);

foreach ($ask_pattern as $pattern) {
	//echo $pattern;
	if (preg_match($pattern, "how is the popular anime")) {
		//echo "match";
		break;
	}	
	else {
		//echo "not match";
		break;
	}
}

?>