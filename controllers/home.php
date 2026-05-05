<?php

require_once 'models/article.php';

$latestArticles = getLatestArticles(6);

include 'views/home.php';