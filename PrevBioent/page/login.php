<?php
require '../page/connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Вход</title>
</head>
<body>
<div class="container w-50 mt-5">
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Эл. Почта:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Пароль:</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button name="submit" type="submit" class="btn btn-light">Войти</button>
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);


    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn_sql, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        session_start();
        $_SESSION['user_id'] = $user_id;
        header('Location: ../index.php');
        //Проверка является ли пользователь админом, если да, то его перенаправляет на админ панель
        if($row['role'] === 'admin'){
            $_SESSION['admin'] = true;
        }
        header("Location: admin.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
  Неверный email или пароль!
</div>';
    }
}
mysqli_close($conn_sql);
?>