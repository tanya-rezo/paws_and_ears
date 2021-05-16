<?php include './includes/header.php'; ?>
<div class="container container-fill">
  <div class="row">

    <?php include './includes/menu.php'; ?>

    <div class="col-9">
      <h3 class="mb-4">Акции</h3>
      <div class="product-grid">

        <?php
        $result = get_on_sale($conn); // получаем акционные товары

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