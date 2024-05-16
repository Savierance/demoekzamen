<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['phone_number'])) {
    // Защита от SQL-инъекций
    $phone = htmlspecialchars($_POST['phone_number']);

    // Вставка номера телефона в базу данных
    $query = "INSERT INTO call_order (user_id, phone_number) VALUES ('$user_id', '$phone')";

    if ($conn_sql->query($query) === TRUE) {
      // Перенаправление с параметром для отображения алерта
      header('Location: ' . $_SERVER['PHP_SELF'] . '?show_alert=true');
      exit();
    } else {
      echo "Ошибка: " . $query . "<br>" . $conn->error;
    }
  }
}
?>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; 2023 PrevBioent</p>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-body-secondary">Главная</a></li>
            <li class="nav-item"><a href="../page/catalog.php" class="nav-link px-2 text-body-secondary">Каталог</a></li>
            <li class="nav-item"><a href="../page/cabinet.php" class="nav-link px-2 text-body-secondary">Кабинет</a></li>
            <li class="nav-item"><a href="../page/cabinet.php" class="nav-link px-2 text-body-secondary">Заказать звонок</a>
          <div class="customer-help">
            <form class="call-order" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <input type="text" name="phone_number" required placeholder="Введите номер телефона" title="Пожалуйста, введите только цифры" class="box-call">
              <br>
              <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
              <br>
              <input type="submit" class="send-btn" value="Отправить">
            </form>

            <?php
            if (isset($_GET['show_alert']) && $_GET['show_alert'] == 'true') {
              echo "<script>alert('Номер телефона успешно записан, мы с вами свяжемся!');</script>";
              echo '<script>window.history.replaceState({}, document.title, "' . $_SERVER['PHP_SELF'] . '");</script>';
            }
            ?>
          </div>
            </li>
        </ul>
    </footer>
</div>