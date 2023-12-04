<?php
$array = [];
$result = [];
$file = "car-db.csv";
ini_set('memory_limit', '1000M');

if (file_exists($file)) {
    $csvFile = fopen($file,"r");
    while (!feof($csvFile)) {
        $line = fgetcsv($csvFile);
        $array[] = $line;
        //print_r($data);
    }
}
$sv = count($array);
$maker = "";
$model = "";
for ($i=0; $i < $sv; $i++) { 
    if ($maker != $array[$i][1]) {
        $maker = $array[$i][1];
    }
    if ($model != $array[$i][2]) {
        $result[$maker][]=$model;
    }
    /*$result[$i][0]=$array[$i][1];
    $result[$i][1]=$array[$i][2];*/
}
//print_r($array);
print_r($result);






?>