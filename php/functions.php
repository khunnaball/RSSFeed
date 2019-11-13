<?php

// Check if the AJAX data has been recieved if so setup variables with the correct data and call the getFeed function.
if (isset($_POST["limit"]) && !empty($_POST['limit'])) {
    $feedURL = $_POST['feedURL'];
    // Set $limit to the value from the AJAX request + 5.
    $limit = $_POST['limit'] += 5;
    getFeed($feedURL, $limit);
}

// Create a new function called getFeed and let it take 2 arguments for the URL of the RSS feed and the limit of articles on the page.
function getFeed($feed_url, $limit)
{
    // Create a new DOMDocument object.
    $rss = new DOMDocument();

    // Load the XML from the $feed_url.
    $rss->load($feed_url);

    $feed = array();

    // Fetch all of the required data and add them to an array for each article.
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array(
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        // Add the data from $items onto the $feed array.
        array_push($feed, $item);
    }

    //Iterate over the data to display the 5 articles with their titles, descriptions, date created, thumbnail and the link to view it.
    for ($i = 0; $i < $limit; $i++) {

        // Setup variables for each to get all of the correct, properly formatted data and be able to echo them out.
        $title = str_replace(' & ', ' &amp; ', $feed[$i]['title']);
        $link = $feed[$i]['link'];
        $description = $feed[$i]['desc'];
        $date = date('l F d, Y', strtotime($feed[$i]['date']));

        /* Get the url of the thumbnail image of the article by using the $link to load the HTML
        then use DOMXPath to retrieve the HTML data we need, which is the src of the images on the page.
        */
        $html = file_get_contents($link);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $images = $xpath->query('//img/@src');
        $img = array();

        // Loop through the image url's and assign them to the $img array.
        foreach ($images as $image) {
            $img[] = $image->nodeValue;
        }

        // Echo out all of the content for each article to display in on the page.
        echo '<div id="media-border">';
        echo '<h5 class="mt-0"><a href="' . $link . '" target="_blank" title="' . $title . '">' . $title . '</a><br />';
        echo '<small><em>Posted on ' . $date . '</em></small></h5>';
        echo '<img class="mr-3" src="' . $img[1] . '" width="250" height="150"><br />';
        echo '<p>' . $description . '</p>';
        echo '</div>';
    }
}
