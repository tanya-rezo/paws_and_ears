<?php include './includes/header.php'; ?>
<?php include './includes/top-bar.php'; ?>
<?php include './includes/menu.php'; ?>
<?php include './includes/catalog-item.php'; ?>

<div class="container menu-container" style="display: none;">
  <?php include './includes/menu-content-mobile.php'; ?>
</div>

<div class="container main-container">
  <div class="row breadcrumbs-space">
    <div class="d-none d-lg-block col-3 catalog-container">
      <?php include './includes/menu-content-desktop.php'; ?>
    </div>

    <div class="col-12 col-lg-9">

      <div class="flex-row-container mb-4">
        <h3 class="title-text-sale">Акции для кошек</h3>
        <a class="link-sale" href="sale.php?pet=1">
          <h6>Смотреть все</h6>
        </a>
      </div>

      <div class="product-grid">

        <?php
        $result = get_on_sale_top_6($conn, 1); // получаем 6 рандомных акционных товаров для кошек

        while ($row = mysqli_fetch_array($result)) {
          print_catalog_item($row, false, true);
        }
        ?>
      </div>

      <div class="flex-row-container mt-4 mb-4">
        <h3 class="title-text-sale">Акции для собак</h3>
        <a class="link-sale" href="sale.php?pet=2">
          <h6>Смотреть все</h6>
        </a>
      </div>

      <div class="product-grid mb-4">

        <?php
        $result = get_on_sale_top_6($conn, 2); // получаем 6 рандомных акционных товаров для собак

        while ($row = mysqli_fetch_array($result)) {
          print_catalog_item($row, false, true);
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php include './includes/footer.php'; ?>