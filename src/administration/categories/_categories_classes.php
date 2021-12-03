<?php include_once '../_base_classes.php'; ?>
<?php include_once '../pet-type/_pet_type_classes.php'; ?>
<?php
class CategoryManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            category.id as category_id,
            category.url_name as category_url_name, 
            category.display_name as category_display_name,
            category.full_name as category_full_name,
            pet_type.id as pet_type_id,
            pet_type.name as pet_type_name,
            pet_type.sale_name as pet_type_sale_name
        FROM 
            category
        LEFT JOIN
            pet_type 
                ON pet_type.id = category.pet_type_id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Category();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Category extends Entity
{
    public $url_name;
    public $display_name;
    public $full_name;

    public $pet_type;

    public function load($row)
    {
        $this->id = $row["category_id"];
        $this->url_name = $row["category_url_name"];
        $this->display_name = $row["category_display_name"];
        $this->full_name = $row["category_full_name"];

        $this->pet_type = new PetType();
        $this->pet_type->load($row);
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
