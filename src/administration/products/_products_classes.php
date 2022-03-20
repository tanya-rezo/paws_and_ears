<?php include_once '../_base_classes.php'; ?>
<?php include_once '../categories/_categories_classes.php'; ?>
<?php include_once '../brands/_brands_classes.php'; ?>
<?php include_once '../manufacturing-countries/_manufacturing_countries_classes.php'; ?>
<?php
class ProductManager extends EntityManager
{
    public function getAll($conn)
    {
        $query = "
        SELECT 
            product.id as product_id,
            product.name as product_name, 
            product.price as product_price,
            product.image as product_image,
            product.description as product_description,
            product.is_sale as product_is_sale,
            product.sale_price as product_sale_price,
            category.id as category_id,
            category.display_name as category_display_name,
            category.full_name as category_full_name,
            brand.id as brand_id,
            brand.name as brand_name,
            manufacturer_country.id as manufacturer_country_id,
            manufacturer_country.name as manufacturer_country_name
        FROM 
            product
        LEFT JOIN
            category ON category.id = product.category_id
        LEFT JOIN
            brand ON brand.id = product.brand_id
        LEFT JOIN
            manufacturer_country ON manufacturer_country.id = product.manufacturer_country_id
        ORDER BY
            product.id";

        $array = [];
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $item = new Product();
            $item->load($row);
            array_push($array, $item);
        }

        return $array;
    }
}

class Product extends Entity
{
    public $name;
    public $price;
    public $image;
    public $description;
    public $is_sale;
    public $sale_price;

    public $category;
    public $brand;
    public $manufacturer_country;

    public function load($row)
    {
        $this->id = $row["product_id"];
        $this->name = $row["product_name"];
        $this->price = $row["product_price"];
        $this->image = $row["product_image"];
        $this->description = $row["product_description"];
        $this->is_sale = $row["product_is_sale"] == "1";
        $this->sale_price = $row["product_sale_price"];

        $this->category = new Category();
        $this->category->load($row);

        $this->brand = new Brand();
        $this->brand->load($row);

        $this->manufacturer_country = new ManufacturingCountry();
        $this->manufacturer_country->load($row);
    }

    public function refresh($conn)
    {
        $query = "
        SELECT 
            product.id as product_id,
            product.name as product_name, 
            product.price as product_price,
            product.image as product_image,
            product.description as product_description,
            product.is_sale as product_is_sale,
            product.sale_price as product_sale_price,
            category.id as category_id,
            category.display_name as category_display_name,
            brand.id as brand_id,
            brand.name as brand_name,
            manufacturer_country.id as manufacturer_country_id,
            manufacturer_country.name as manufacturer_country_name
        FROM 
            product
        LEFT JOIN
            category ON category.id = product.category_id
        LEFT JOIN
            brand ON brand.id = product.brand_id
        LEFT JOIN
            manufacturer_country ON manufacturer_country.id = product.manufacturer_country_id
        WHERE
            product.id = {$this->id}";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $this->load($row);
    }
    public function create($conn)
    {
        $query = "
        INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`, `is_sale`, `sale_price`, `category_id`, `brand_id`, `manufacturer_country_id`)
        VALUES (NULL, '{$this->name}', '{$this->price}', '{$this->image}', '{$this->description}', '{$this->is_sale}', '{$this->sale_price}','{$this->category->id}','{$this->brand->id}','{$this->manufacturer_country->id}')";

        $conn->query($query);
    }
    public function save($conn)
    {
        $query = "
        UPDATE 
            product 
        SET 
            product.name = '{$this->name}', 
            product.price = '{$this->price}',
            product.image = '{$this->image}',
            product.description = '{$this->description}',
            product.is_sale = '{$this->is_sale}',
            product.sale_price = '{$this->sale_price}',
            product.category_id = {$this->category->id},
            product.brand_id = {$this->brand->id},
            product.manufacturer_country_id = {$this->manufacturer_country->id}
        WHERE 
            product.id = {$this->id}";

        $conn->query($query);
    }
    public function delete($conn)
    {
        $query = "DELETE FROM product WHERE product.id={$this->id}";
        $conn->query($query);
    }
}
