<?php include_once '../_base_classes.php'; ?>

<?php
class ManufacturingCountriesManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            manufacturer_country.id as manufacturer_country_id,
            manufacturer_country.name as manufacturer_country_name
        FROM 
            manufacturer_country";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new ManufacturingCountry();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class ManufacturingCountry extends Entity
{
    public $name;

    public function load($row)
    {
        $this->id = $row["manufacturer_country_id"];
        $this->name = $row["manufacturer_country_name"];
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
