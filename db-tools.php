<?php
function insertMakers($mysqli, $makers, $truncate = false){
    if($truncate) {
        $mysqli->query("TRUNCATE TABLE makers");
    }
    foreach ($makers as $maker) {
        $result = $mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
    }
    if (!$result){
        echo "Hiba történt a $maker beszúrása közben";
    }
    return $result;
}

function updateMaker($mysqli, $data){
    $makerName = $data['name'];

    $result = $mysqli->query("UPDATE makers SET name=$makerName");

    if (!$result){
        echo "Hiba történt a $makerName beszúrása közben";
    }
    $maker = getMakerByName($mysqli, $makerName);
    return $result;
}

function getMaker($mysqli, $id){
    $result = $mysqli->query("SELECT * FROM makers WHERE id=$id");
    $maker = $result->fetch_assoc();

    return $maker;
}

function getMakerByName($mysqli, $name){
    $result = $mysqli->query("SELECT * FROM makers WHERE name=$name");
    $maker = $result->fetch_assoc();

    return $maker;
}

function delMaker($mysqli, $id){
    $result = $mysqli->query("DELETE makers WHERE id=$id");
    return $result;
}

function getAllMakers($mysqli){
    $result = $mysqli->query("SELECT * FROM makers");
    $makers = $result->fetch_assoc();

    return $makers;
}