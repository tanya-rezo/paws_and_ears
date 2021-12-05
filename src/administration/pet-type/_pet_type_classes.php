<?php include_once '../_base_classes.php'; ?>
<?php
class PetTypeManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            pet_type.id as pet_type_id,
            pet_type.name as pet_type_name,
            pet_type.sale_name as pet_type_sale_name
        FROM 
            pet_type
        ORDER BY
            pet_type.id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new PetType();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class PetType extends Entity
{
    public $name;
    public $sale_name;

    public function load($row)
    {
        $this->id = $row["pet_type_id"];
        $this->name = $row["pet_type_name"];
        $this->sale_name = $row["pet_type_sale_name"];
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            pet_type.id as pet_type_id,
            pet_type.name as pet_type_name,
            pet_type.sale_name as pet_type_sale_name
        FROM 
            pet_type
        WHERE
            pet_type.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `pet_type` (`id`, `name`, `sale_name`)
        VALUES (NULL, '{$this->name}', '{$this->sale_name}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            pet_type 
        SET 
            pet_type.name = '{$this->name}', 
            pet_type.sale_name = '{$this->sale_name}'
        WHERE 
            pet_type.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM pet_type WHERE pet_type.id={$this->id}";
        $conn->query($query);
    }
}
