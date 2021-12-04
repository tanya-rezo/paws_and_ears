<?php include_once '../_base_classes.php'; ?>

<?php
class ClientManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            client.id as client_id,
            client.first_name as client_first_name,
            client.last_name as client_last_name,
            client.middle_name as client_middle_name,
            client.phone as client_phone
        FROM 
            client";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Client();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Client extends Entity
{
    public $name;

    public function load($row)
    {
        $this->id = $row["client_id"];
        $this->first_name = $row["client_first_name"];
        $this->last_name = $row["client_last_name"];
        $this->middle_name = $row["client_middle_name"];
        $this->phone = $row["client_phone"];
    }

    public function create($conn)
    {
    }
    public function save($conn)
    {
    }
    public function delete($conn)
    {
    }
}
