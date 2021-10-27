<?php
function print_catalog_item($row, $show_sale_banner, $is_sale)
{
  if ($is_sale == true) {

    $banner_class = "";

    if ($show_sale_banner == true) {
      $banner_class = "grid-item-sale";
    }

    echo "
            <a href='product.php?id={$row["id"]}' class='text-decoration-none'>
              <div class='grid-item flex-column-container {$banner_class}'>
                <div class='product-image' style='background-image: url(products/{$row["image"]})'></div>
                <div class='name-and-price-container flex-row-container'>
                  <div class='name-container'>
                    <h8 class='name-text'>{$row["name"]}</h8>
                  </div>
                  <div class='price-container'>
                    <div class='old-price'>{$row["price"]} ₽ </div>  
                    <div>{$row["sale_price"]} ₽ </div>
                  </div>
                </div>
              </div>
            </a>";
  } else {
    echo "
            <a href='product.php?id={$row["id"]}' class='text-decoration-none'>
              <div class='grid-item flex-column-container'>
                <div class='product-image' style='background-image: url(products/{$row["image"]})'></div>
                <div class='name-and-price-container flex-row-container'>
                  <div class='name-container'>
                    <h8 class='name-text'>{$row["name"]}</h8>
                  </div>
                  <div class='price-container'>
                    <div>{$row["price"]} ₽ </div>
                  </div>
                </div>
              </div>
            </a>";
  }
}
