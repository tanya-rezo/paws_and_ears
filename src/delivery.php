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
      <div class="flex-row-container mb-2 mb-lg-4">
        <h3 class="title-text-sale">Доставка и оплата</h3>
      </div>

      <img src="/img/car.svg" class="mb-4"></img>

      <p>После поступления заявки с клиентом связывается оператор для уточнения информации.</p>
      <p>Заказ считается принятым после подтверждения его оператором. В случае невозможности по каким-либо причинам связаться с клиентом, ему отправляется смс с просьбой связаться с операторами интернет-магазина самостоятельно и подтвердить свой заказ.</p>

      <p>Отслеживать статус заказа можно на странице отслеживания заказа, ссылка на которую генерируется при оформлении заказа.</p>
      <p>Так как все заказы обрабатываются в порядке общей очереди, на момент сбора заказа нужного товара может не оказаться в наличии. В таком случае оператор с вами свяжется.</p>

    </div>
  </div> 
</div>

<?php include './includes/footer.php'; ?>