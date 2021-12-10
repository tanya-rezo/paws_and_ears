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
            client
        ORDER BY
            client.id";

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
    public $first_name;
    public $last_name;
    public $middle_name;
    public $phone;

    public function get_full_name_with_id()
    {
        return "{$this->id} - {$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function load($row)
    {
        $this->id = $row["client_id"];
        $this->first_name = $row["client_first_name"];
        $this->last_name = $row["client_last_name"];
        $this->middle_name = $row["client_middle_name"];
        $this->phone = $row["client_phone"];
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            client.id as client_id,
            client.first_name as client_first_name,
            client.last_name as client_last_name,
            client.middle_name as client_middle_name,
            client.phone as client_phone
        FROM 
            client
        WHERE
            client.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `client` (`id`, `first_name`, `last_name`, `middle_name`, `phone`)
        VALUES (NULL, '{$this->first_name}', '{$this->last_name}', '{$this->middle_name}', '{$this->phone}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            client 
        SET 
            client.first_name = '{$this->first_name}',
            client.last_name = '{$this->last_name}',
            client.middle_name = '{$this->middle_name}',
            client.phone = '{$this->phone}'
        WHERE 
            client.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM client WHERE client.id={$this->id}";
        $conn->query($query);
    }
}
