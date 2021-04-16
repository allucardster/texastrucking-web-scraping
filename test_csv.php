<?php


require 'vendor/autoload.php';

use Texastrucking\WebScraping\CoMemSearchCrawler;

$crw = new CoMemSearchCrawler(__DIR__ . '/source.html');

$csvFile = __DIR__ . '/source.csv';
$crw->createCsv($csvFile);