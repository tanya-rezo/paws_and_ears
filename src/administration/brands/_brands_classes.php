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
            brand";

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
