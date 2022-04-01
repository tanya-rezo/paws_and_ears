<?php include_once '../_base_classes.php'; ?>
<?php
class RoleManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            role.id as role_id,
            role.name as role_name,
            role.description as role_description
        FROM 
            role";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Role();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Role extends Entity
{
    public $name;
    public $description;

    public function load($row)
    {
        $this->id = $row["role_id"];
        $this->name = $row["role_name"];
        $this->description = $row["role_description"];
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
