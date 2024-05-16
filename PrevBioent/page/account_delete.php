<?php
include 'connect.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    if (mysqli_query($conn_sql, $sql)) {
        echo '<div class="alert alert-success" role="alert">
            Аккаунт удален. </div>';
        session_destroy();
        header('Refresh:2, URL=../index.php');
    }
    else{
        echo '<div class="alert alert-success" role="alert">
            Аккаунт не удален. </div>';
    }
}
mysqli_close($conn_sql);
?>