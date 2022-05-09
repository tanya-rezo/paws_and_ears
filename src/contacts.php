<?php include './includes/header.php'; ?>
<?php include './includes/top-bar.php'; ?>
<?php include './includes/menu.php'; ?>

<div class="container menu-container" style="display: none;">
  <?php include './includes/menu-content-mobile.php'; ?>
</div>

<div class="container main-container">
  <div class="row breadcrumbs-space">
    <div class="d-none d-lg-block col-3 catalog-container">
      <?php include './includes/menu-content-desktop.php'; ?>
    </div>

    <div class="col-12 col-lg-9">
      <div class="flex-row-container mb-lg-2">
        <h3 class="title-text-sale">Контакты</h3>
      </div>

      <p>42069, г. Котка, Фиолетовая ул., д. 42</p>
      <p>Контакт-центр: <a href="tel:74953566846">+7 495 356 68 46</a></p>

      <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2968d98f0697fc53ba87bd0d501827f8c095340b796a73b37035737ea9c93c58&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
  </div>
</div>

<?php include './includes/footer.php'; ?>