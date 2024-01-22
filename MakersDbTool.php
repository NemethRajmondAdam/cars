<?php
//use Exception;

class MakersDbTools{
    const DBTABLE = 'makers';

    private $mysqli;

    function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'cars')
    {
        $this->mysqli = new mysqli($host, $user, $password, $db);
        if ($this->mysqli->connect_errno) {
            throw new Exception($this->mysqli->connect_errno);
        }
    }

    function __destruct()
    {
        $this->mysqli->close();
    }

    function createMaker($maker)
    {
        $result = $this->mysqli->query("INSERT INTO {self::DBTABLE} (name) VALUES ('$maker')");
        if(!$result){
            echo "Hiba történt a $maker beszúrása közben";
        }

        return $result;
    }

    function getAllMakers()
    {
        $result = $this->mysqli->query("SELECT * FROM {self::DBTABLE}");
        $makers = $result->fetch_assoc();
        //$result->free_result();

        return $makers;
    }

        function delMaker($id) 
    {
        $result = $mysqli->query("DELETE {self::DBTABLE} WHERE id=$id");

        return $result;
    }

    function getMakerByName($name)
    {
        $result = $mysqli->query("SELECT * FROM {self::DBTABLE} WHERE name=$name");
        $maker = $result->fetch_assoc();

        return $maker;
    }

        function getMaker($id)
    {
        $result = $mysqli->query("SELECT * FROM {self::DBTABLE} WHERE id=$id");
        $maker = $result->fetch_assoc();
        $result->free_result();

        return $maker;
    }

    function updateMaker($data)
    {
        $makerName = $data['name'];
        $result = $mysqli->query("UPDATE {self::DBTABLE} SET name=$makerName");

        if (!$result){
            echo "Hiba történt a $makerName beszúrása közben";
            return $result;
        }
        $maker = getMakerByName($mysqli,$makerName);
        return $maker;
    }
}

?>