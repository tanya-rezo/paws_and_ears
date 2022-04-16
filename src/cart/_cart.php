<?php
class Cart
{
    public $session;

    public $total_cost;
    public $total_discount;
    public $cart_count;

    public $items;

    function __construct($session)
    {
        $this->session = $session;
    }

    function load($conn)
    {
        $this->items = [];

        $total_cost = 0;
        $total_discount = 0;
        $cart_count = array_sum($this->session);

        foreach ($this->session as $product_id => $count) {
            if (substr($product_id, 0, 8) == "product_") {
                // обрезаем имя переменной сессии чтобы получить id товара
                // "product_3" -> "3"
                $id = substr($product_id, 8);

                // получаем данные о продукте для корзины
                $product = mysqli_fetch_array(get_product_for_cart($conn, $id));

                // подсчитываем общую скидку
                if ($product["is_sale"] == "1") {
                    $total_discount = $total_discount + (($product["price"] - $product["sale_price"]) * $count);
                }

                // подсчитываем общую стоимость
                if ($product["is_sale"] == "1") {
                    $total_cost = $total_cost + ($product["sale_price"] * $count);
                } else {
                    $total_cost = $total_cost + ($product["price"] * $count);
                }

                $product_obj = new Product();

                $product_obj->id = $product["id"];
                $product_obj->name = $product["name"];
                $product_obj->price = $product["price"];
                $product_obj->sale_price = $product["sale_price"];
                $product_obj->is_sale = ($product["is_sale"] == "1");
                $product_obj->image = $product["image"];
                $product_obj->count = $count;

                array_push($this->items, $product_obj);
            }
        }

        $this->total_cost = $total_cost;
        $this->total_discount = $total_discount;
        $this->cart_count = $cart_count;
    }
}

class Product
{
    public $id;
    public $name;
    public $price;
    public $sale_price;
    public $is_sale;
    public $image;
    public $count;

    function get_discount()
    {
        if ($this->is_sale == true) {
            return $this->price - $this->sale_price;
        } else {
            return 0;
        }
    }
}
