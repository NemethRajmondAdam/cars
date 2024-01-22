<?php 

require_once("DBMaker.php");

function getCsvData($fileName) {
	if (!file_exists($fileName)) {
		echo "$fileName nem taláható";
		return false;
	}
	$csvFile = fopen($fileName, 'r');
    $lines = [];	
	while (! feof($csvFile)) {
		$line = fgetcsv($csvFile);
		$lines[] = $line;
	}
	fclose($csvFile);
	
	return $lines;
}

function getMakers($csvData)
{
    $idxMaker = array_search('make', $csvData[0]);
    $makers = [];
    $isHeader = true;
    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        $maker = $data[$idxMaker];
        if (!in_array($maker, $makers)) {
            $makers[] = $maker;
        }
    }

    return $makers;
}

function getModels($csvData)
{
    $idxMaker = array_search('make', $csvData[0]);
    $idxModel = array_search('model', $csvData[0]);

    $models = [];
    $isHeader = true;
    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }
        $dbMaker = new DBMaker();

        $maker = $dbMaker->getByName($data[$idxMaker]);
        $idMaker = $maker['id'];
        $model = [
            'name' => $data[$idxModel],
            'id_make' => $maker['id'],
        ];

        if (!in_array($model, $models)) {
            $models[] = $model;
        }
    }

    return $models;
}