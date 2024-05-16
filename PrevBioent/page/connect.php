<?php
$conn_sql = new mysqli("localhost", "root", "Lindemann_1995", "prevbioent"); //Напишешь свою бд и пароль, если он есть.

if ($conn_sql->connect_error) {
    die("Connection failed: " . $conn_sql->connect_error);
}
?>