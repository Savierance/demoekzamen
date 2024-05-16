<?php
require '../page/connect.php';
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Корзина</title>
</head>
<body>
<?php
include "../page/header.php";
?>

<div class="container w-100 justify-content-center">
    <?php
    $user_id = $_SESSION['user_id'];


    $sql = "SELECT product_id, quantity FROM cart WHERE user_id='$user_id'";
    $result = mysqli_query($conn_sql, $sql);
    

    $list = '<ul class="list-group">';


    $total_price = 0;


    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $sql_product = "SELECT name, price FROM products WHERE id='$product_id'";
        $result_product = mysqli_query($conn_sql, $sql_product);
        $row_product = mysqli_fetch_assoc($result_product);
        $product_name = $row_product['name'];
        $product_price = $row_product['price'];


        $product_total_price = $product_price * $quantity;
        $list .= '<li class="list-group-item">
      <div class="d-flex justify-content-between">
        <div>
          <span class="text-dark">' . $product_name . '</span>
          <span>x ' . $quantity . '</span>
          <span class="text-dark">Стоимость: ' . $product_price . '₽' . '</span>
          <span class="text-dark">Всего: ' . $product_total_price . '₽' . '</span>
        </div>
        <div>
          <a href="increase_quantity.php?product_id=' . $product_id . '" class="btn btn-success btn-sm">+</a>
          <a href="decrease_quantity.php?product_id=' . $product_id . '" class="btn btn-danger btn-sm">-</a>
          <a href="delete_from_cart.php?product_id=' . $product_id . '" class="btn btn-danger btn-sm">Удалить</a>
        </div>
      </div>
    </li>';
        $total_price += $product_total_price;
    }
    $list .= '</ul>';
    echo $list;
    echo '<p class="text-dark">Итого: ' . $total_price . '</p>';
    echo '<button type="button" class="btn btn-primary" onclick="window.location.href=\'order.php\'">Оформить заказ</button>';
    ?>
</div>

<?php
include "../page/footer.php";
?>
<script>
    const cartButton = document.querySelector('button.btn-primary');
    const cartItems = document.querySelectorAll('.list-group li');

    if (cartItems.length === 0) {
        cartButton.classList.add('disabled');
        cartButton.textContent = 'Корзина пуста';
    } else {
        cartButton.classList.remove('disabled');
        cartButton.textContent = 'Оформить заказ';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>