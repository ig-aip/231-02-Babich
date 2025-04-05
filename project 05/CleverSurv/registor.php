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
    <title>Registration</title>
    <link rel="stylesheet" href="css/styleReg.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <section class="registor show-animate" id="registor">
        <form action="registerDb.php" method="post" onsubmit="return validateForm()">
            <div class="block">
                <div class="registor-title animate-fade-up">
                    <div class="title">Регистрация</div>
                </div>

                <div id="error-message" style="color:red; display:none;"></div>

                <div class="registor-email animate-fade-up">
                    <div class="redWord">Email</div>
                    <div class="input-field">
                    <input type="email" placeholder="Email" name="email" id="email" 
                    value="<?php echo isset($old_data['email']) ? htmlspecialchars($old_data['email']) : '' ?>" required>
                        <div class="error-message" id="emailError"></div>
                    </div>
                </div>

                <div class="registor-password animate-fade-up">
                    <div class="redWord">Пароль</div>
                    <div class="input-field">
                        <input type="password" placeholder="Пароль" name="password" id="password" required>
                        <small>Пароль должен содержать: буквы верхнего/нижнего регистра, цифры, спецсимволы и быть от 4 до 16 символов</small>
                        <div class="error-message" id="passwordError"></div>
                    </div>
                </div>

                <div class="registor-repassword animate-fade-up">
                    <div class="redWord">Повтор пароля</div>
                    <div class="input-field">
                        <input type="password" placeholder="Повтор пароля" name="repeatpassword" id="repeatpassword" required>
                        <div class="error-message" id="repeatpasswordError"></div>
                    </div>
                </div>

                <div class="registor-checkBox animate-fade-up">
                    <div class="textArea">
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" required>
                            <label for="terms">Я принимаю <a href="#expluatationDoc">Условия эксплуатации</a> и <a href="#confidationDoc">политику конфиденциальности</a></label>
                        </div>
                    </div>
                </div>
                
                <div class="registor-button animate-fade-up">
                    <div class="btn-box">
                        <button type="submit" class="btn" id="submitBtn" disabled>Регистрация</button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function validateForm() {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const repeat = document.getElementById('repeatpassword').value;
                const generalError = document.getElementById('error-message');
                
                resetErrors();
                let isValid = true;

                // Проверка совпадения паролей
                if(password !== repeat) { 
                    showError(document.getElementById('repeatpassword'), 'repeatPasswordError', 'Пароли не совпадают!');
                    isValid = false;
                }

                // Проверка сложности пароля
                const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,15}$/;
                if(!regex.test(password)) {
                    showError(document.getElementById('password'), 'passwordError', 'Пароль должен содержать: буквы верхнего/нижнего регистра, цифры, спецсимволы и быть от 4 до 16 символов');
                    isValid = false;
                }

                return isValid;
            }

            function showError(input, errorId, message) {
                const errorElement = document.getElementById(errorId);
                input.classList.add('error');
                errorElement.textContent = message;
                errorElement.classList.add('active');
            }

            function resetErrors() {
                // Сброс всех ошибок
                document.querySelectorAll('.input-field input').forEach(input => {
                    input.classList.remove('error');
                });
                document.querySelectorAll('.error-message').forEach(error => {
                    error.classList.remove('active');
                    error.textContent = '';
                });
                generalError.style.display = 'none';
            }

            document.getElementById('terms').addEventListener('change', function() {
            const submitBtn = document.getElementById('submitBtn');
            if(this.checked) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'true');
            }
            });

            document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($errors as $field => $message): ?>
                showError(document.getElementById('<?= $field ?>'), '<?= $field ?>Error', '<?= $message ?>');
            <?php endforeach; ?>
            });
        </script>
    </section>
</body>
</html>