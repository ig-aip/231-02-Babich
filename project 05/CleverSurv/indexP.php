<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project6</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
<?php
session_start();
?>
<!-- head design -->
<div class="page">
    <header class="header">
        <a href="#" class="logo">CleverSurv</a>

        <nav class="navbar">
            <a href="#aboutUs">О нас</a>
            <?php if(isset($_SESSION['user_email'])): ?>
                <?php if($_SESSION['user_role'] === 'admin'): ?>
                    <a href="profileAdmin.php">Жалобы</a>
                <?php endif; ?>
                <a href="profile_new.php" class="active">Профиль</a>
                <a href="logout.php">Выйти</a>
            <?php else: ?>
                <a href="registor.php">Зарегистрироваться</a>
                <a href="logIn.php" class="active">Войти</a>
            <?php endif; ?>
            <span class="active-nav"></span>
        </nav>
    </header>

     <!-- home section design --> 
     <section class="home show-animate" id="home">
        <div class="home-content">
            <div class="home-heading animate-fade-up">
                <h1>Лучший сайт для создания <span>онлайн-опросов.</span></h1>
            </div>

            <div class="home-description animate-fade-up">
                <p>Лучший сайт для опросов предлагает интуитивно понятный интерфейс, широкий выбор шаблонов и возможность кастомизации. Пользователи могут создавать опросы различных типов, анализировать результаты в реальном времени и делиться ссылками на опросы в соцсетях. Платформа поддерживает интеграцию с другими инструментами и обеспечивает высокую безопасность данных.</p>
            </div>

            <div class="home-button animate-fade-up">
                <div class="btn-box">
                    <?php if(isset($_SESSION['user_email'])): ?>
                        <a href="creatorSurv.php" class="btn">Создать</a>
                    <?php else: ?>
                        <a href="logIn.php" class="btn">Войти</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- <div class="home-imgHover">
            <img src="img/graph1.png" alt="">
        </div> -->
        <div class="home-slider animate-fade-up">
            <div class="blockSlider" id="blockSlider">
                <div class="fullArea">
                    <div class="imagesArea">
                        <img class="imageSlider" src="img/graph1.png" alt="">
                        <img class="imageSlider" src="img/g2.png" alt="">
                        <img class="imageSlider" src="img/g3.png" alt="">
                        <img class="imageSlider" src="img/g4.png" alt="">
                    </div>

                    <div class="pointsAreaSize">
                        <span class="point"></span>
                        <span class="point"></span>
                        <span class="point"></span>
                        <span class="point"></span>
                    </div>

                    <div class="btnsAreaSize">
                        <div class="blockArrow" id="leftBtn"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                        <div class="blockArrow" id="rightBtn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>



        <script src="app.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Добавляем класс loaded после загрузки страницы
                setTimeout(function() {
                    document.body.classList.add('loaded');
                }, 300);

                // Анимация для прелоадера
                const preloader = document.querySelector('.preloader__scene');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 2000);
            });
        </script>

     </section>
</div>
</body>
</html>