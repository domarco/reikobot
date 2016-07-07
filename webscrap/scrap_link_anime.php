<?php

function scrap_link_anime($url, $save_file) {

    $static_url = $url; 
    $loop = 0;
    $continue = TRUE;  
    $page_show = 0;

    while ($continue == true) {
        set_time_limit(180);    
        $results_page = curl($url);
        
        $results_page = scrape_between($results_page, "<div class=\"js-categories-seasonal js-block-list list\">", "<div class=\"mauto clearfix pt24\""); // Scraping out only the middle section of the results page that contains anime info results
        
        $separate_results = explode("<div class=\"picSurround\">", $results_page);   // Separate each anime links into parts of array
        //print_r($separate_results); break;
        $flag = false;
        foreach ($separate_results as $separate_result) {
            //creating url for each anime
            if ($separate_result != "" && $flag == true) {
                $results_urls[] = scrape_between($separate_result, "href=\"", "\"");         
            }
            else {
                $flag = true; // eliminating 1st element which always an unnecessarry link (look at mal table structure :)
            }
        }

        // Searching for a 'Next' link.
        if (strpos($results_page, "Next")) {
            $continue = TRUE;
            $page_show += 50;
            $url = $static_url."&show=".$page_show;
            $loop++;
        } 
        else {
            $continue = FALSE;
            echo "No Next value";
        }
        
        sleep(rand(3,5));  
    } 

    if ($results_urls != "") {
        $s_results_urls = serialize($results_urls);
        
        file_put_contents("./scrapdata/".$save_file, $s_results_urls);

        //echo "loop ".$loop." : ".$url."<br>Scrape Success!!";
        //print_r($results_urls);        
    }

}

?>