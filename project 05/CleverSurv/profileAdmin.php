<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: indexP.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>

    <link rel="stylesheet" href="css/styleProfAdmin.css">
    
</head>

<body>
    <section>

        <div class="block">
            <div class="title">
                Жалобы
            </div>

            <div class="block-listing">
                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №1
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №2
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №3
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №4
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №5
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №6
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №7
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №8
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №9
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №10
                    </a>
                </div>

                <div class="btn-area">
                    <a href="#problemsBlockB" class="btn">
                        <div class="img-area">
                            <img class="warningIcon" src="img/warning.png" alt="">
                        </div>
                        Warning №11
                    </a>
                </div>

            </div>

            <div class="btn-box">    
                <a href="indexP.php" class="btn">На главную</a>
            </div>
            
        </div> 

    </section>
    
</body>

</html>