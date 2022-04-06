<?php include_once './database.php'; ?>
<?php
$guid = $_GET["id"];
$id = mysqli_fetch_array(get_order_id($conn, $guid))['placed_order_id'];

cancel_order($conn, $id);
header("Location: /order-status.php?id=$guid");
?>
