<?php
    require "../page/connect.php";

    $sql = "SELECT * FROM `users`";
    if($result = $conn_sql->query($sql)){
        $rowCount = $result->num_rows;


    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Админ панель</title>
</head>
<body>

    <?php
        require "../page/connect.php";

        $sql = "SELECT * FROM `users`";
        if($result = $conn_sql->query($sql)){
            $rowCount = $result->num_rows;

            echo '<div class="container">';
            echo '<h1>Информация о пользователях</h1>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Id</th>';
            echo '<th>Имя</th>';
            echo '<th>Email</th>';
            echo '<th>Роль</th>';
            echo '<th>Заказы</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach($result as $row){
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["role"] . '</td>';
                echo '<td>' . $row["registration_date"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        }
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>