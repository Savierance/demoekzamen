<?php
require 'connect.php';
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
    <title>Витамины</title>
</head>
<body>
<?php
require "header.php";

 echo '"<div class="container">';
    echo '<div class="map">';
    echo '<h2 class="d-flex flex-row justify-content-center" >Наше местоположение</h2>';
    echo '<p><script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7ff815e01686bf0570be036d774442567a73b17f7bfff5dc1a0259e9bbc8f580&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script></p>';
    echo '</div>';
 echo '</div>';

require "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>