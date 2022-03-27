<?php include_once '../_base_classes.php'; ?>
<?php include_once '../clients/_clients_classes.php'; ?>
<?php include_once '../order-status/_order_status_classes.php'; ?>
<?php
class OrderManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            placed_order.id as placed_order_id,
            client.id as client_id,
            client.first_name as client_first_name,
            client.last_name as client_last_name,
            client.middle_name as client_middle_name,
            placed_order.total_product_count as placed_order_total_product_count,
            placed_order.total_cost as placed_order_total_cost,
            placed_order.order_date as placed_order_order_date,
            order_status.id as order_status_id,
            order_status.name as order_status_name
        FROM 
            placed_order
        LEFT JOIN
            client ON client.id = placed_order.client_id
        LEFT JOIN
            order_status ON order_status.id = placed_order.order_status_id
        ORDER BY
            placed_order.id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Order();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Order extends Entity
{
    public $total_product_count;
    public $total_cost;
    public $order_date;

    public $client;
    public $order_status;

    public function load($row)
    {
        $this->id = $row["placed_order_id"];
        $this->total_product_count = $row["placed_order_total_product_count"];
        $this->total_cost = $row["placed_order_total_cost"];
        $this->order_date = $row["placed_order_order_date"];

        $this->client = new Client();
        $this->client->load($row);

        $this->order_status = new OrderStatus();
        $this->order_status->load($row);
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            placed_order.id as placed_order_id,
            client.id as client_id,
            client.first_name as client_first_name,
            client.last_name as client_last_name,
            client.middle_name as client_middle_name,
            client.phone as client_phone,
            placed_order.total_product_count as placed_order_total_product_count,
            placed_order.total_cost as placed_order_total_cost,
            placed_order.order_date as placed_order_order_date,
            order_status.id as order_status_id,
            order_status.name as order_status_name
        FROM 
            placed_order
        LEFT JOIN
            client ON client.id = placed_order.client_id
        LEFT JOIN
            order_status ON order_status.id = placed_order.order_status_id
        WHERE
            placed_order.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }

    public function create($conn)
    {
        // не реализуется в соответствии с бизнес требованиями (в текущей версии нельзя создавать и менять заказы)
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            placed_order 
        SET 
            placed_order.order_status_id = {$this->order_status->id}
        WHERE 
            placed_order.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM placed_order_item WHERE placed_order_item.placed_order_id={$this->id}";
        $conn->query($query);
        $query = "DELETE FROM placed_order WHERE placed_order.id={$this->id}";
        $conn->query($query);
    }
}
