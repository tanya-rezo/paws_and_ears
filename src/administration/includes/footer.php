<div class="container">
  <span class="float-left mb-3">
    <?php if (isset($_SESSION['user_login'])) : ?>
      Привет, <?= $_SESSION['user_login'] ?>! <a href="/administration/logout.php">Выйти</a>
    <?php endif  ?>
  </span>
</div>
<footer class="footer">
  <div class="container flex-row-container">
    © <?= date("Y") ?> Зоомагазин «Лапки и ушки»
  </div>
</footer>
<script src="/js/bundle.js"></script>
</body>

</html>
<?php disconnect_db($conn); ?>