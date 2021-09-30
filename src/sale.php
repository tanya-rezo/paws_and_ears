<?php include './includes/header.php'; ?>

<?php
$pet = mysqli_fetch_array(get_pet_sale_name($conn, $_GET["pet"]));
?>

<div class="container container-fill">

  <div class="row">
    <div class="col-3"></div>
    <div class="col-9">
      <div class="lite-font-weight flex-row-container breadcrumbs">
        <h6>
          <a href="index.php">Главная</a>
        </h6>
        <h7 class="breadcrumbs-delimiter">></h7>
        <h6><?php echo $pet["pet_type"] ?></h6>
      </div>
    </div>
  </div>


  <div class="row">

    <?php include './includes/menu.php'; ?>

    <div class="col-9">
      <div class="flex-row-container mb-4">
        <h3><?php echo $pet["pet_type"] ?></h3>
      </div>
      <div class="product-grid mb-4">

        <?php
        $result = get_on_sale_by_pet_type($conn, $_GET["pet"]); // получаем акционные товары из БД по виду питомца

        while ($row = mysqli_fetch_array($result)) {
          echo "
            <a href='product.php?id={$row["id"]}'>
              <div class='grid-item'>
                <img src='products/{$row["image"]}' class='product-image' />
                <div class='name-and-price-container'>
                  <div class='name-container'>
                    <h8 class='name-text'>{$row["name"]}</h8>
                  </div>
                  <div class='price-container'>
                    <div class='sale-price'>{$row["price"]} ₽ </div>  
                    <div class=''>{$row["sale_price"]} ₽ </div>
                  </div>
                </div>
              </div>
            </a>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php include './includes/footer.php'; ?>