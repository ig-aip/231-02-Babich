<?php
session_start();
$errors = [];
$old_data = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

if (isset($_SESSION['old_data'])) {
    $old_data = $_SESSION['old_data'];
    unset($_SESSION['old_data']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="css/styleLog.css">
</head>
<body>
    <section class="logIn show-animate" id="logIn">
        <form action="loginDb.php" method="post">
            <div class="block">
                <div class="logIn-title animate-fade-up">
                    <div class="title">Авторизация</div>
                </div>

                <div class="logIn-email animate-fade-up">
                    <div class="redWord">Email</div>
                    <div class="input-field">
                        <input type="email" placeholder="Email" name="email" id="email" 
                               value="<?= htmlspecialchars($old_data['email'] ?? '') ?>" required>
                        <div class="error-message" id="emailError">
                            <?= $errors['email'] ?? '' ?>
                        </div>
                    </div>
                </div>

                <div class="logIn-password animate-fade-up">
                    <div class="redWord">Пароль</div>
                    <div class="input-field">
                        <input type="password" placeholder="Пароль" name="password" id="password" required>
                        <div class="error-message" id="passwordError">
                            <?= $errors['password'] ?? '' ?>
                        </div>
                        <div class="notationBtns">
                            <a href="#rememberPas" class="notation">Забыли пароль ?</a>
                        </div>
                    </div>
                </div>

                <div class="logIn-button animate-fade-up">
                    <div class="btn-box">
                        <button type="submit" class="btn">Войти</button>
                    </div>
                </div>

                <div class="logIn-registorNotification animate-fade-up">
                    <div class="textArea">
                        <p>Если вы не зарегистрированы, <a href="registor.php">зарегистрируйтесь</a></p>
                    </div>
                </div>

            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Подсветка полей с ошибками
            <?php foreach ($errors as $field => $message): ?>
                const <?= $field ?>Input = document.getElementById('<?= $field ?>');
                if(<?= $field ?>Input) {
                    <?= $field ?>Input.classList.add('error');
                    const errorElement = document.getElementById('<?= $field ?>Error');
                    if(errorElement) {
                        errorElement.style.display = 'block';
                        errorElement.textContent = '<?= $message ?>';
                    }
                }
            <?php endforeach; ?>
        });
    </script>
    
</body>

</html>