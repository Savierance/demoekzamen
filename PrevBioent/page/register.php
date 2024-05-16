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
    <title>Регистрация</title>
</head>
<body>
<div class="container w-50 mt-5">
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Эл. Почта:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="email">Телефон:</label>
            <input type="tel" class="form-control" name="phone_number" id="phone_number" required>
        </div>
        <div class="form-group">
            <label for="pwd">Пароль:</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="form-group">
            <label for="pwd">Повторите пароль:</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" required>
        </div>
        <div class="form-group">
            <label for="pwd">Имя:</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="form-group">
            <label for="pwd">Фамилия:</label>
            <input type="text" name="usersurname" class="form-control" id="usersurname" required>
        </div>
        <button name="submit" type="submit" class="btn btn-light">Зарегистрироваться</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
if (!$conn_sql) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn_sql, $_POST['email']);
    $password = mysqli_real_escape_string($conn_sql, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn_sql, $_POST['password_confirm']);
    $username = mysqli_real_escape_string($conn_sql, $_POST['username']);
    $usersurname = mysqli_real_escape_string($conn_sql, $_POST['usersurname']);
    $phone = mysqli_real_escape_string($conn_sql, $_POST['phone_number']);

    if ($password != $password_confirm) {
        echo '<div class="alert alert-danger" role="alert">
  Пароли не совпадают!
</div>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger" role="alert">
  Неверный формат email!
</div>';
        exit();
    }

    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn_sql, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">
  Такой email уже зарегистрирован!
</div>';
        exit();
    }

    $sql = "INSERT INTO users (name, surname, email, password, phone_number, role) VALUES ('$username', '$usersurname', '$email', '$password', '$phone', 'member')";
    if (mysqli_query($conn_sql, $sql)) {
        header('Location: ../page/login.php');
    } else {
        echo "Ошибка: " . mysqli_error($conn_sql);
    }
}

mysqli_close($conn_sql);
?>