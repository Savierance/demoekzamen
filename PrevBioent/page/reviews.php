<?php
require '../page/connect.php';
session_start();

$user_id = $_SESSION['user_id'];

$strSQL = "SELECT * FROM users WHERE id={$user_id}";



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Витамины</title>
</head>
<body>
<?php
require "header.php";

// Получаем идентификатор продукта из URL
if (!isset($_GET['id'])) {
    echo "Ошибка: Идентификатор продукта не указан!";
    exit();
}

$product_id = $_GET['id'];

// Получаем информацию о продукте из базы данных
$sql_product = "SELECT * FROM products WHERE id = $product_id";
$result_product = mysqli_query($conn_sql, $sql_product);
if (!$result_product) {
    echo "Ошибка: Не удалось выполнить запрос к базе данных: " . mysqli_error($conn_sql);
    exit();
}

$product = mysqli_fetch_assoc($result_product);

// Выводим информацию о продукте
echo '<div class="container">';
echo '<div class="card mb-3" style="max-width: 540px;">';
echo '<div class="row g-0">';
echo '<div class="col-md-4">';
echo '<img src="' . $product['image'] . '" class="img-fluid rounded-start" alt="...">';
echo '</div>';
echo '<div class="col-md-8">';
echo '<div class="card-body">';
echo '<h5 class="card-title">' . $product['name'] . '</h5>';
echo '<p class="card-text">' . $product['description'] . '</p>';
echo '<p class="card-text">' . $product['price'] . '₽' . '</p>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

// Добавляем поле для ввода отзыва
    echo '<form action="add_review.php" method="post">';
    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
    echo '<textarea name="comment" rows="3" placeholder="Введите ваш отзыв" class="form-control"></textarea>';
    echo '<button type="submit" class="btn btn-primary mt-2">Оставить отзыв</button>';
    echo '</form>';
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

// Получаем отзывы о продукте из базы данных
$sql_reviews = "SELECT * FROM reviews WHERE product_id = $product_id";
$result_reviews = mysqli_query($conn_sql, $sql_reviews);
if (!$result_reviews) {
    echo "Ошибка: Не удалось выполнить запрос к базе данных: " . mysqli_error($conn_sql);
    exit();
}

// Выводим отзывы о продукте
while ($row = mysqli_fetch_assoc($result_reviews)) {
    echo '<div class="card mb-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Имя:' . $row['name'] . '</h5>';
    echo '<h5 class="card-title">Пользователь #' . $row['user_id'] . '</h5>';
    echo '<p class="card-text">' . $row['comment'] . '</p>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>