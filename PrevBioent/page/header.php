<header class="p-3 text-bg-dark mb-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="../index.php" class="d-flex align-items-center fs-3 mb-2 mb-lg-0 text-white text-decoration-none">
            PrevBioent
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 text-white">Главная</a></li>
                <li><a href="../page/catalog.php" class="nav-link px-2 text-white">Каталог</a></li>
                <li><a href="../page/about.php" class="nav-link px-2 text-white">О нас</a></li>
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<a href="../page/cart.php" class="nav-link px-2 text-white">' . 'Корзина' . '</>';
                }
                    ?>
            </ul>

            <div class="text-end">
                <?php if (isset($_SESSION['user_id'])) {
                    echo '<a href="../page/cabinet.php" class="btn btn-success">'. 'Аккаунт' .'</a>';
                } else {
                    echo '<a class="btn btn-outline-light me-2" href="../page/login.php">Вход</a>';
                    echo '<a class="btn btn-success" href="../page/register.php">Регистрация</a>';
                }
                ?>

            </div>
        </div>
    </div>
</header>