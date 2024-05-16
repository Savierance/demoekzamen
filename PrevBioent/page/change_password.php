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
    <title>Смена пароля</title>
</head>
<body>
<div class="container w-50 mt-5">
    <main class="form-signin w-100 m-auto">
        <form action="" method="post">
            <h1 class="h3 mb-3 fw-normal">Смена пароля</h1>
            <div class="form-floating mb-1">
                <input type="password" class="form-control" name="old_password" id="password" placeholder="Password">
                <label for="floatingPassword">Старый пароль</label>
            </div>
            <div class="form-floating mb-1">
                <input type="password" class="form-control" name="new_password" id="password" placeholder="Password">
                <label for="floatingPassword">Новый пароль</label>
            </div>
            <div class="form-floating mb-1">
                <input type="password" class="form-control" name="new_password_confirm" id="password" placeholder="Password">
                <label for="floatingPassword">Повторите новый пароль</label>
            </div>
            <button class="btn btn-success w-100 py-2 mt-5" name="submit" type="submit">Сменить пароль</button>
        </form>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    if (empty($old_password) || empty($new_password) || empty($new_password_confirm)) {
        echo "Пожалуйста, заполните все поля.";
    } else {

        $old_password = md5($old_password);
        $new_password = md5($new_password);
        $new_password_confirm = md5($new_password_confirm);


        if ($new_password != $new_password_confirm) {
            echo "Новый пароль и его подтверждение не совпадают.";
        } else {

            $sql = "SELECT * FROM users WHERE password = '$old_password'";

            $result = mysqli_query($conn_sql, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "Вы ввели неверный старый пароль.";
            } else {

                $new_password = mysqli_real_escape_string($conn_sql, $new_password);

                $sql = "UPDATE users SET password = '$new_password' WHERE password = '$old_password'";

                $result = mysqli_query($conn_sql, $sql);

                if ($result) {
                    session_start();
                    $_SESSION = array();
                    session_destroy();
                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                        );
                    }
                    header("Location: ../index.php");
                } else {
                    echo "Произошла ошибка при обновлении пароля.";
                }
            }
        }
    }
}
?>