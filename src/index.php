<?php include './includes/header.php'; ?>
<div class="container container-fill">
  <div class="row mt-12px">

    <?php include './includes/menu.php'; ?>

    <div class="col-12 col-lg-9">

      <div class="flex-row-container mb-4">
        <h3>Акции для кошек</h3>
        <a class="link-sale" href="sale.php?pet=1">
          <h6>Смотреть все</h6>
        </a>
      </div>

      <div class="product-grid">

        <?php
        $result = get_on_sale_top_6($conn, 1); // получаем 6 рандомных акционных товаров для кошек

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

      <div class="flex-row-container mt-4 mb-4">
        <h3>Акции для собак</h3>
        <a class="link-sale" href="sale.php?pet=2">
          <h6>Смотреть все</h6>
        </a>
      </div>

      <div class="product-grid mb-4">

        <?php
        $result = get_on_sale_top_6($conn, 2); // получаем 6 рандомных акционных товаров для собак

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