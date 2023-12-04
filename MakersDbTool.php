<?php
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

    function createMaker($mysqli,$maker)
    {
        $result = $this->query("INSERT INTO makers (name) VALUES ('$maker')");
        if(!$result){
            echo "Hiba történt a $maker beszúrása közben";
        }

        return $result;
    }

    function getAllMakers($mysqli)
    {
        $result = $mysqli->query("SELECT * FROM maker");
        $makers = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();

        return $makers;
    }

        function delMaker($mysqli,$id) 
    {
        $result = $mysqli->query("DELETE makers WHERE id=$id");

        return $result;
    }

    function getMakerByName($mysqli, $name)
    {
        $result = $mysqli->query("SELECT * FROM makers WHERE name=$name");
        $maker = $result->fetch_assoc();

        return $maker;
    }

        function getMaker($myqli, $id)
    {
        $result = $mysqli->query("SELECT * FROM makers WHERE id=$id");
        $maker = $result->fetch_assoc();
        $result->free_result();

        return $maker;
    }

    function updateMaker($mysqli,$data)
    {
        $makerName = $data['name'];
        $result = $mysqli->query("UPDATE makers SET name=$makerName");

        if (!$result){
            echo "Hiba történt a $makerName beszúrása közben";
            return $result;
        }
        $maker = getMakerByName($mysqli,$makerName);
        return $maker;
    }
}

?>