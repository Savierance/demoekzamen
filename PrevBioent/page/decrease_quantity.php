<?php
require '../page/connect.php';
session_start();
// Получить идентификатор продукта
$product_id = $_GET['product_id'];

// Получить количество продукта в корзине
$sql = "SELECT quantity FROM cart WHERE product_id='$product_id' AND user_id='$_SESSION[user_id]'";
$result = mysqli_query($conn_sql, $sql);
$row = mysqli_fetch_assoc($result);
$quantity = $row['quantity'];

// Уменьшить количество продукта в корзине
if ($quantity > 0) {
    // Уменьшить количество продукта в корзине
    $quantity--;

    // Обновить количество продукта в корзине
    $sql = "UPDATE cart SET quantity='$quantity' WHERE product_id='$product_id' AND user_id='$_SESSION[user_id]'";
    mysqli_query($conn_sql, $sql);

    // Перенаправить пользователя на страницу корзины
    header('Location: cart.php');
} else {
    // Удалить товар из корзины
    $sql = "DELETE FROM cart WHERE product_id='$product_id' AND user_id='$_SESSION[user_id]'";
    mysqli_query($conn_sql, $sql);

    // Перенаправить пользователя на страницу корзины
    header('Location: cart.php');
}
?>