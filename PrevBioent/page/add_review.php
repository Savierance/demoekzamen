<?php
require '../page/connect.php';
session_start();
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

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $product_id = $_POST['product_id'];
    $comment = $_POST['comment'];
    
    // Проверяем, что комментарий не пустой
    if (empty($comment)) {
        echo "Ошибка: Пожалуйста, введите отзыв.";
        exit();
    }

    // Проверяем, авторизован ли пользователь
    if (!isset($_SESSION['user_id'])) {
        echo "Ошибка: Для оставления отзыва пожалуйста войдите в аккаунт.";
        exit();
    }

    // Получаем идентификатор пользователя
    $user_id = $_SESSION['user_id'];

    

    // Вставляем отзыв в базу данных
    $sql_insert_review = "INSERT INTO reviews (product_id, user_id, comment) VALUES ('$product_id', '$user_id', '$comment')";
    $result_insert_review = mysqli_query($conn_sql, $sql_insert_review);
    
    if (!$result_insert_review) {
        echo "Ошибка: Не удалось добавить отзыв: " . mysqli_error($conn_sql);
        exit();
    }
    
    // Отобразим только что добавленный отзыв
    $sql_new_review = "SELECT * FROM reviews WHERE product_id = $product_id AND user_id = $user_id ORDER BY id DESC LIMIT 1";
    $result_new_review = mysqli_query($conn_sql, $sql_new_review);
    
    if (!$result_new_review) {
        echo "Ошибка: Не удалось выполнить запрос к базе данных: " . mysqli_error($conn_sql);
        exit();
    }
    
    $new_review = mysqli_fetch_assoc($result_new_review);
    
    // Выводим отзыв
    echo '<div class="card mb-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Пользователь #' . $new_review['user_id'] . '</h5>';
    echo '<p class="card-text">' . $new_review['comment'] . '</p>';
    echo '</div>';
    echo '</div>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
















