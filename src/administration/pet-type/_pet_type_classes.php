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
            pet_type";

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

    public function load($db_data)
    {
        $this->id = $db_data["pet_type_id"];
        $this->name = $db_data["pet_type_name"];
        $this->sale_name = $db_data["pet_type_sale_name"];
    }
}
