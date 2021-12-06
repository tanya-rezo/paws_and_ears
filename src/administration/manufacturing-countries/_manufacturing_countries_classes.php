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
            manufacturer_country
        ORDER BY
            manufacturer_country.id";

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

    public function refresh($conn)
    {
        $query = "
        SELECT 
            manufacturer_country.id as manufacturer_country_id,
            manufacturer_country.name as manufacturer_country_name
        FROM 
            manufacturer_country
        WHERE
            manufacturer_country.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `manufacturer_country` (`id`, `name`)
        VALUES (NULL, '{$this->name}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            manufacturer_country 
        SET 
            manufacturer_country.name = '{$this->name}'
        WHERE 
            manufacturer_country.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM manufacturer_country WHERE manufacturer_country.id={$this->id}";
        $conn->query($query);
    }
}
