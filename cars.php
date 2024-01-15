<?php
ini_set('memory_limit','-1');
$array = [];

$file = "car-db.csv";
function getCsvData($file){
    if(!file_exists($file)){
        echo "$file nem található";
        return false;
    }
    $csv = fopen($file, 'r');
    while (!feof($csv)) {
        $line = fgetcsv($csv);
        $array[] = $line;
    }
    fclose($csv);
    return $array ;    
}

$csvData = getCsvData($file);
//print_r($csvData);

//$sv = count($csvData);
function getMakers($csvData){
    $header = $csvData[0];
    $makerKey = array_search('make',$header);
    //$modelKey = array_search('model',$header);

    $maker ="";
    //$model = "";
    $isHeader = true;
    $makers = [];
    //$result = [];

    foreach ($csvData as $data) {
        if (!is_array($data)){
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }
        if ($maker != $data[$makerKey]) {
            $maker = $data[$makerKey];
            $makers[] = $maker;
        }
        /*
        if ($model != $data[$modelKey]) {
            $model = $data[$modelKey ];
            $result[$maker][] = $model;
        }
        */
    }
    return $makers;
}

$mysqli = new mysqli("localhost","root",null,"cars");

//Check connection
if($mysqli->connect_errno) {
    echo "Failed to connect to MySql: " . $mysqli -> connect_error;
    exit();
}
echo "connected\n";

$makers = getMakers($csvData);

$result = insertMarkes($mysqli, $makers, true);

$mysqli->close();