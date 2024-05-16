<?php
require '../page/connect.php';
session_start();
// Получить данные из формы заказа
$shipping_type = $_POST['shipping_type'];
$shipping_address = $_POST['shipping_address'];
$total = $_POST['total_price'];

// Создать заказ
$sql = "INSERT INTO orders (user_id, shipping_type, shipping_address, total, status)
VALUES ('$_SESSION[user_id]', '$shipping_type', '$shipping_address', '$total', 'Ожидает подтверждения')";

$result = mysqli_query($conn_sql, $sql);

// Получить ID созданного заказа
$order_id = mysqli_insert_id($conn_sql);

// Получить товары из корзины
$sql = "SELECT product_id, quantity FROM cart WHERE user_id='$_SESSION[user_id]'";
$result = mysqli_query($conn_sql, $sql);

// Создать массив товаров
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [
        'product_id' => $row['product_id'],
        'quantity' => $row['quantity']
    ];
}

// Добавить товары в заказ
foreach ($products as $product) {
    $sql = "INSERT INTO order_details (order_id, product_id, quantity)
    VALUES ($order_id, $product[product_id], $product[quantity])";

    $result = mysqli_query($conn_sql, $sql);
}

// Если заказ успешно создан, то отправить пользователю уведомление
if ($result) {
    $sql = "DELETE FROM cart WHERE user_id='$_SESSION[user_id]'";
    mysqli_query($conn_sql, $sql);

    header("Location: ../index.php");
} else {
    // Показать ошибку пользователю
    echo "Ошибка оформления заказа.";
}
?>