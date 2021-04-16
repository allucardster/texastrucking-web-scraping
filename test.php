<?php

require 'vendor/autoload.php';

use Texastrucking\WebScraping\CoMemSearchCrawler;

$crw = new CoMemSearchCrawler(__DIR__ . '/source.html');
$data = $crw->getJsonData(true);
echo $data;