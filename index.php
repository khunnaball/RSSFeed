<!DOCTYPE html>
<html>

<head>
    <title>RSS Feed</title>
    <!-- CSS Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="css/default.css" />
</head>

<body>
    <!-- Includes the functions.php file to allows us to call the getFeed function. -->
    <?php require_once "php/functions.php"; ?>

    <div class="container">
        <div class="row">
            <div class="panel panel-default col-md-6 col-md-offset-3">
                <div id="header">
                    <h1>RSS Feed</h1>
                    <p><small><em>Check out the latest articles from the BBC News.</em></small></p>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div id="feed">
                            <div class="media-body">
                                <!-- 
                                Setup the limit value which is the number of articles shown and the feedURL is the URL of the RSS feed.
                                Call the getFeed() function and  pass the $feedURL variable which is the RSS feed (to allow for re-usablity of code and to add different/multiple feeds) URL
                                and the $limit variable which is the number of articles you want to show as an argument to the function. 
                            -->
                                <?php
                                $limit = 5;
                                $feedURL = "http://feeds.bbci.co.uk/news/rss.xml";
                                getFeed($feedURL, $limit); ?>
                            </div>
                        </div>
                        <div id="loading">
                            <img src="resources/loading_spinner.gif">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Show more button shows more articles when clicked. -->
                        <div class="showMore text-center">
                            <button id="showMore" type="button" class="btn btn-info">Show More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hidden inputs to store the value of $feedURL and $limit to pass them to the JS. -->
    <input type="hidden" id="feedURL" value="<?php echo $feedURL; ?>">
    <input type="hidden" id="limit" value="<?php echo $limit; ?>">
</body>

<!-- JS Links -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="js/feed.js"></script>

</html>