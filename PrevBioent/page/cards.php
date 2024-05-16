<div class="container-lg d-flex flex-column justify-content-around flex-wrap h-auto">
    <h1 class="w-100 text-center my-3">Каталог витаминов</h1>
    <?php
    require 'connect.php';
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn_sql, $sql);
    if (!$result) {
        die('Could not query the database: ' . mysqli_error($conn_sql));
    }
    ?>
    <div class="container d-flex flex-row justify-content-center gap-5 flex-wrap">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id'];
        if (!isset($_SESSION['user_id'])) {
            echo '<p>Для просмотра каталога пожалуйста войдите в аккаунт</p>';
            exit();
        } else {
            $user_id = $_SESSION['user_id'];
        }
        $sql_check_cart = "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'";
        $result_check_cart = mysqli_query($conn_sql, $sql_check_cart);
        $is_in_cart = mysqli_num_rows($result_check_cart) > 0;
        echo '<div class="card mb-3" style="max-width: 540px;">';
        echo '<div class="row g-0">';
        echo '<div class="col-md-4">';
        echo '<img src="' . $row['image'] . '" class="img-fluid rounded-start" alt="...">';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '<p class="card-text">' . $row['price'] . '₽' . '</p>';
        echo '<p class="card-text" xmlns="http://www.w3.org/1999/html"><small class="text-body-secondary">НЕ ЯВЛЯЕТСЯ ЛЕКАРСТВЕННЫМ СРЕДСТВОМ.</br>ПРОКОНСУЛЬТИРУЙТЕСЬ СО СПЕЦИАЛИСТОМ</small></p>';
        if ($is_in_cart) {
            echo '<button class="btn btn-secondary disabled">В корзине</button>';
        } else {
            echo '<button name="recipe_id" class="btn btn-success" value="' . $product_id . '" onclick="window.location.href=\'add_to_cart.php?id=' . $product_id . '&quantity=1\'">В корзину</button>';
        }
        echo '<button class="btn btn-info" onclick="window.location.href=\'reviews.php?id=' . $row['id'] . '\'">Просмотреть отзывы</button>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
    </div>
</div>