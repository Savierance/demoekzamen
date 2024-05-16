<?php
require '../page/connect.php';
session_start();
// Получить идентификатор продукта
$product_id = $_GET['product_id'];

// Удалить товар из корзины
$sql = "DELETE FROM cart WHERE product_id='$product_id' AND user_id='$_SESSION[user_id]'";
mysqli_query($conn_sql, $sql);

// Перенаправить пользователя на страницу корзины
header('Location: cart.php');
?>