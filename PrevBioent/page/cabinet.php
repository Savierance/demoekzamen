<?php
require '../page/connect.php';
session_reset();
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$strSQL = "SELECT * FROM users WHERE id={$user_id}";

try {
    $stmt = $conn_sql->prepare($strSQL);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
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
    <title>Личный кабинет</title>
</head>
<body>
<?php
include "../page/header.php";
?>
<div class="container w-100 justify-content-center">
    <div class="row">
        <div class="col">
<h1 class="d-flex text-center mt-5">Личный кабинет</h1>
    <p>Ваши данные:</p>
    <?php
    echo '<ul class="list-group list-group-flush">';
    echo '<li class="list-group-item">Имя: ' . $row['name'] . '</li>';
    echo '<li class="list-group-item">Фамилия: ' . $row['surname'] . '</li>';
    echo '<li class="list-group-item">Почта: ' . $row['email'] . '</li>';
    echo '<li class="list-group-item">Номер телефона: ' . $row['phone_number'] . '</li>';
    echo '<li class="list-group-item">ID аккаунта: ' . $row['id'] . '</li>';
    echo '</ul>';
    echo '<div class="d-flex flex-row justify-content-start gap-1">';
    echo '<div class="btn-group mt-1" role="group">';
    echo '<a href="logout.php" class="btn btn-outline-secondary">Выйти</a>';
    echo '<a href="change_password.php" class="btn btn-outline-secondary">Сменить пароль</a>';
    echo '<button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#DeleteModal">Удалить аккаунт</button>';
    echo '</div>';
    echo '</div>';
    ?>
        </div>
        <div class="col">
            <h1 class="d-flex text-center mt-5">Заказы</h1>
            <p>Ваши заказы:</p>
            <?php
            $sql = "SELECT id, shipping_type, shipping_address, total, status FROM orders WHERE user_id = $user_id";
            $result = mysqli_query($conn_sql, $sql);

            $orders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[] = [
                    'id' => $row['id'],
                    'shipping_type' => $row['shipping_type'],
                    'shipping_address' => $row['shipping_address'],
                    'total' => $row['total'],
                    'status' => $row['status']
                ];
            }

            echo '<ul class="list-group">';
            foreach ($orders as $order) {
                echo '<li class="list-group-item">';
                echo '<strong>ID заказа:</strong> ' . $order['id'];
                echo '<br>';
                echo '<strong>Тип доставки:</strong> ' . $order['shipping_type'];
                echo '<br>';
                echo '<strong>Адрес доставки:</strong> ' . $order['shipping_address'];
                echo '<br>';
                echo '<strong>Итого:</strong> ' . $order['total'] . '₽';
                echo '<br>';
                echo '<strong>Статус:</strong> ' . $order['status'];
                echo '</li>';
            }
            echo '</ul>';
            ?>
        </div>
    </div>
<?php
include "../page/footer.php";
?>
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Вы действительно хотите удалить аккаунт?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Данное действие необратимо и приведёт к полному удалению данных вашего аккаунта.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <a href="account_delete.php" class="btn btn-danger">Удалить</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>