<?php

$all_categories = get_menu($conn);
$cat_categories = [];
$dog_categories = [];
while ($row = mysqli_fetch_array($all_categories)) {
    if ($row['pet_type_id'] == 1) {
        array_push($cat_categories, $row);
    }
    if ($row['pet_type_id'] == 2) {
        array_push($dog_categories, $row);
    }
}

function print_categories($categories)
{
    foreach ($categories as $category) {
        echo "<a href='catalog.php?category={$category['url_name']}'>
                <h6>{$category['display_name']}</h6>
              </a>";
    }
}
?>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php include './includes/menu-content.php'; ?>
</div>
<div class="d-none d-lg-block col-3 catalog-container">
    <?php include './includes/menu-content.php'; ?>
</div>