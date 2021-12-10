<?php include_once '../_base_classes.php'; ?>
<?php include_once '../products/_products_classes.php'; ?>
<?php
class OrderItemManager extends EntityManager
{
    public function getAll($conn)
    {
        // не реализуется в соответствии с бизнес требованиями 
    }

    public function getById($conn, $id)
    {
        settype($id, 'integer');

        $query = "
        SELECT 
            placed_order_item.cost_per_item as placed_order_item_cost_per_item,
            placed_order_item.discount_per_item as placed_order_item_discount_per_item,
            placed_order_item.count as placed_order_item_count,
            product.id as product_id,
            product.name as product_name, 
            product.price as product_price,
            product.image as product_image,
            product.description as product_description,
            product.is_sale as product_is_sale,
            product.sale_price as product_sale_price
        FROM 
            placed_order_item
        LEFT JOIN
            product ON product.id = placed_order_item.product_id
        WHERE 
            placed_order_item.placed_order_id = $id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new OrderItem();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class OrderItem extends Entity
{
    public $cost_per_item;
    public $discount_per_item;
    public $count;

    public $product;

    public function load($row)
    {
        $this->cost_per_item = $row["placed_order_item_cost_per_item"];
        $this->discount_per_item = $row["placed_order_item_discount_per_item"];
        $this->count = $row["placed_order_item_count"];

        $this->product = new Product();
        $this->product->load($row);
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
