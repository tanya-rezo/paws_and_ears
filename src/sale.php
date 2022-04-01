<?php include_once './database.php'; ?>
<?php
$pet = mysqli_fetch_array(get_pet_sale_name($conn, $_GET["pet"]));
?>
<?php
$title = $pet["pet_type"];
include './includes/header.php';
?>
<?php include './includes/top-bar.php'; ?>
<?php include './includes/menu.php'; ?>
<?php include './includes/catalog-item.php'; ?>

<div class="container menu-container" style="display: none;">
  <?php include './includes/menu-content-mobile.php'; ?>
</div>

<div class="container main-container">

  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-9">
      <div class="lite-font-weight flex-row-container breadcrumbs">
        <h6>
          <a href="/index.php">Главная</a>
        </h6>
        <img class="breadcrumbs-delimiter" src="img/breadcrumb-arrow.svg"></img>
        <h6><?php echo $pet["pet_type"] ?></h6>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="d-none d-lg-block col-3 catalog-container">
      <?php include './includes/menu-content-desktop.php'; ?>
    </div>

    <div class="col-12 col-lg-9">
      <div class="flex-row-container mb-4">
        <h3><?php echo $pet["pet_type"] ?></h3>
      </div>
      <div class="product-grid mb-4">

        <?php
        $result = get_on_sale_by_pet_type($conn, $_GET["pet"]); // получаем акционные товары из БД по виду питомца

        while ($row = mysqli_fetch_array($result)) {
          print_catalog_item($row, false, true);
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php include './includes/footer.php'; ?>