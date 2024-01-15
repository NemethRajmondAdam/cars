<?php
require_once('cars.php');
ini_set('memory_limit','560M');

$fileName = 'car-db.csv';
$csvData = getCsvData($fileName);

$header = $csvData[0];
$keyMaker = array_search('make',$header);

print_r($keyMaker);