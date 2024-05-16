<?php
require 'connect.php';

// Получить идентификатор продукта
$product_id = $_GET['id'];

// Получить идентификатор пользователя
session_start();
$user_id = $_SESSION['user_id'];

// Получить количество товара
$quantity = $_GET['quantity'];

// Вставить новую запись в таблицу cart
$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
$result = mysqli_query($conn_sql, $sql);
if (!$result) {
    die('Could not add product to cart: ' . mysqli_error($conn_sql));
}

// Перенаправить пользователя на страницу корзины
header('Location: ../page/catalog.php');
?>