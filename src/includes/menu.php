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
                <h6 class='d-none d-lg-block'>{$category['display_name']}</h6>
                <div class='d-lg-none'>
                    <div class='xs-menu-line'></div>
                    <div class='xs-menu-text'>{$category['display_name']}<img src='img/menu-arrow.svg'></div>
                </div>
              </a>";
    }
}
