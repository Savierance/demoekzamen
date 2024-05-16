<?php
require '../page/connect.php';
session_start();
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

// Получить общую стоимость заказа
$total_price = 0;
$_POST['total_price'] = $total_price;
foreach ($products as $product) {
    $sql_product = "SELECT price FROM products WHERE id='$product[product_id]'";
    $result_product = mysqli_query($conn_sql, $sql_product);
    $row_product = mysqli_fetch_assoc($result_product);
    $product_price = $row_product['price'];
    $total_price += $product_price * $product['quantity'];
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Оформление заказа</title>
</head>
<body>
<?php
include "../page/header.php";
?>
<div class="container w-75 justify-content-center">
    <form action="order_submit.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="shipping_type" class="form-label">Тип доставки</label>
                    <select class="form-control" id="shipping_type" name="shipping_type">
                        <option value="1">Доставка курьером</option>
                        <option value="2">Доставка почтой</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="shipping_address_container">
                <div class="mb-3">
                    <label for="shipping_address" class="form-label">Адрес доставки</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Укажите адрес доставки">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="total_price" class="form-label">Общая стоимость</label>
            <input type="text" class="form-control" id="total_price" name="total_price" value="<?php echo $total_price; ?>" readonly>
        </div>
        <input type="submit" class="btn btn-primary" value="Оформить заказ">
    </form>
</div>
<?php
include "../page/footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>