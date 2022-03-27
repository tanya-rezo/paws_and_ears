<?php include_once '../_base_classes.php'; ?>
<?php
class OrderStatusManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            order_status.id as order_status_id,
            order_status.name as order_status_name,
            order_status.message as order_status_message
        FROM 
            order_status";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new OrderStatus();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class OrderStatus extends Entity
{
    public $name;
    public $message;

    public function load($row)
    {
        $this->id = $row["order_status_id"];
        $this->name = $row["order_status_name"];
        $this->message = $row["order_status_message"];
    }

    public function refresh($conn)
    {
        // не реализуется в соответствии с бизнес требованиями
    }
    public function create($conn)
    {
        // не реализуется в соответствии с бизнес требованиями
    }
    public function save($conn)
    {
        // не реализуется в соответствии с бизнес требованиями
    }
    public function delete($conn)
    {
        // не реализуется в соответствии с бизнес требованиями
    }
}
