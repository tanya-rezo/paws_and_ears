<?php include './includes/header.php'; ?>
<div class="container container-fill">
  <div class="row">

    <?php include './includes/menu.php'; ?>

    <div class="col-9">
      <?php
      $pet = mysqli_fetch_array(get_pet_sale_name($conn, $_GET["pet"]));
      ?>

      <div class="lite-font-weight flex-row-container breadcrumbs">
        <h5>
          <a href="index.php">Главная</a>
        </h5>
        <h6 class="mt-1 ml-2 mr-2">></h6>
        <h5><?php echo $pet["pet_type"] ?></h5>
      </div>

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
                  <div class='price-container'>{$row["price"]} ₽</div>
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