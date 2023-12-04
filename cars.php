<?php

require_once('csv-tools.php');
ini_set('memory_limit', '-1');

$filename = "car-db.csv";
$csvData = getCsvData($filename);
if (empty($csvData)) {
    echo 'A fájl nem található';
    return false;
}

/*
$header = $csvData[0];
$idxMaker = array_search('make', $header);
$idxModel = array_search('model', $header);

$isHeader = true;

$result = [];
$maker = '';
$model = '';
foreach ($csvData as $data) {
    if (!is_array($data)) {
        continue;
    }
    if ($isHeader) 
    {
        $isHeader = false;
        continue;    
    }
    if ($maker != $data[$idxMaker]) {
        $maker = $data[$idxMaker];
    }
    if ($model != $data[$idxModel]) {
        $model = $data[$idxModel];
        $result[$maker][] = $model;
    }
}
print_r($result);
*/



$mysqli = new mysqli("localhost","root",null,"cars");
//check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL " . $mysqli -> connect_errno;
    exit();
}

echo "connected\n";


$makers = getMakers($csvData);

print_r($makers);

$errors = [];

foreach ($makers as $maker) {
    $result = createMaker($mysqli, $maker);
    //$mysqli->query("INSERT INTO cars (name) VALUES ($maker)");
    if (!$result) {
        $errors[] = $maker;
    }
    echo "$maker\n";
}

$makers = getAllMakers($mysqli);
$cnt = count($makers);
echo "$cnt sor van;\n"; 
echo $cnt . "sor van\n";
echo sprintf("%d sor van\n",$cnt);

$mysqli->close();


?>