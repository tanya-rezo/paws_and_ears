<?php include_once '../_base_classes.php'; ?>
<?php
class BrandManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            brand.id as brand_id,
            brand.name as brand_name
        FROM 
            brand
        ORDER BY
            brand.id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Brand();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Brand extends Entity
{
    public $name;


    public function load($row)
    {
        $this->id = $row["brand_id"];
        $this->name = $row["brand_name"];
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            brand.id as brand_id,
            brand.name as brand_name
        FROM 
            brand
        WHERE
            brand.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `brand` (`id`, `name`)
        VALUES (NULL, '{$this->name}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            brand 
        SET 
            brand.name = '{$this->name}'
        WHERE 
            brand.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM brand WHERE brand.id={$this->id}";
        $conn->query($query);
    }
}
