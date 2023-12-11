<?php
//namespace Cars;

require_once 'CarsInterface.php';
require_once 'DB.php';

class DBMaker extends DB implements CarsInterface
{
    public function create(array $data) : ?int
    {
        $sql = "INSERT INTO makers $data";
        $this->mysqli->query($sql);

        $lastInserted = $this->mysqli->query("SELECT LAST_INSERT_ID() id;")->fetch_assoc();

        return $lastInserted['id'];
    }

    public function get(int $id): array
    {
        $query = "SELECT * FROM makers WHERE id = $id";

        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM makers ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function update(int $id, array $data)
    {
        $query = "UPDATE makers SET $data WHERE id = $id";
        $this->mysqli->guery($query);

        return $this->get($id);
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM makers WHERE id = $id";

        return $this->mysqli->query($query);
    }

    public function getAbc(): array
    {
        $query = "SELECT DISTINCT LEFT(name,1) as L FROM makers ORDER BY L";
        
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getByFirstCh($ch)
    {
        $query = "SELECT * FROM makers WHERE name LIKE '$ch%' ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    
}
?>