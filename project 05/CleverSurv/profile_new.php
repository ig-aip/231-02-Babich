<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_email'])) {
    header("Location: logIn.php");
    exit();
}


$email = $_SESSION['user_email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>

    <link rel="stylesheet" href="css/styleProfNew.css">
    
</head>

<body>
    <section class="profile show-animate" id="profile">

        <?php if(isset($_SESSION['error'])): ?>
        <div class="alert error">
         <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
        <div class="alert success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
        <?php endif; ?>

        <div class="block">
            <div class="profile-titleWord animate-fade-up">
                <div class="titleWord">
                    Профиль
                </div>
            </div>
            
            <div class="profile-email animate-fade-up">
                <div class="title">
                    <label>Email: <?php echo htmlspecialchars($user['Email']); ?></label>   
                </div>
            </div>


            <?php if($_SESSION['user_role'] === 'admin'): ?>
                <div class="profile-password animate-fade-up">
                    <div class="title">
                        <label>Пароль: <a></a></label>   
                    </div>   
                </div>   
            <?php else: ?>
                <div class="profile-password animate-fade-up">
                    <div class="title">
                        <label>Пароль: <a href="#" onclick="openPasswordModal()">сменить пароль</a></label>   
                    </div>   
                </div>   
            <?php endif; ?>

            <div class="profile-button animate-fade-up">
                <div class="btn-box">    
                    <a href="indexP.php" class="btn">На главную</a>
                </div>
            </div>
        </div>

    </section>
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2>Смена пароля</h2>
            <form id="passwordForm" action="updatePassword.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Старый пароль:</label>
                    <input type="password" name="old_password" id="oldPassword" required>
                    <div class="error-message" id="oldPasswordError"></div>
                </div>
                
                <div class="form-group">
                    <label>Новый пароль:</label>
                    <input type="password" name="new_password" id="newPassword" required>
                    <small>Пароль должен содержать: буквы верхнего/нижнего регистра, цифры, спецсимволы и быть от 4 до 16 символов</small>
                    <div class="error-message" id="newPasswordError"></div>
                </div>

                <div class="form-group">
                    <label>Повторите новый пароль:</label>
                    <input type="password" name="confirm_password" id="confirmPassword" required>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>

                <div class="btn-box">
                    <button type="submit" class="btn">Сохранить</button>
                    <button type="button" class="btn" onclick="closeModal()">Отмена</button>
                </div>
            </form>
        </div>
    </div>

<?php if (isset($_GET['modal']) && $_GET['modal'] === 'Password'): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    openPasswordModal();
    <?php if(isset($_SESSION['errors'])): ?>
        <?php foreach($_SESSION['errors'] as $field => $message): ?>
            showError(
                document.getElementById('<?= $field ?>'),
                '<?= $field ?>Error',
                '<?= $message ?>'
            );
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>
});
</script>
<?php endif; ?>


<script>
    
function openPasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.add('active');
    document.getElementById('oldPassword').focus();
}



<?php if(isset($_SESSION['errors'])): ?>
        <?php foreach($_SESSION['errors'] as $field => $message): ?>
            showError(
                document.getElementById('<?= $field ?>'),
                '<?= $field ?>Error',
                '<?= $message ?>'
            );
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

function closeModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.remove('active');
}

// Закрытие при клике вне модального окна
window.onclick = function(event) {
    const modal = document.getElementById('passwordModal');
    if (event.target == modal) {
        closeModal();
    }
}

function validateForm() {
    let isValid = true;
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    
    // Сброс предыдущих ошибок
    resetErrors();

    // Валидация старого пароля (пример проверки)
    if(oldPassword.value.length < 6) {
        showError(oldPassword, 'oldPasswordError', 'Старый пароль неверен');
        isValid = false;
    }

    // Валидация нового пароля
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[a-zA-Z\d\W_]{4,16}$/;
    if(!passwordRegex.test(newPassword.value)) {
        showError(newPassword, 'newPasswordError', 'Пароль не соответствует требованиям');
        isValid = false;
    }

    // Проверка совпадения паролей
    if(newPassword.value !== confirmPassword.value) {
        showError(confirmPassword, 'confirmPasswordError', 'Пароли не совпадают');
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
    document.querySelectorAll('.form-group input').forEach(input => {
        input.classList.remove('error');
    });
    document.querySelectorAll('.error-message').forEach(error => {
        error.classList.remove('active');
        error.textContent = '';
    });
}

// Реакция на изменение полей
document.getElementById('confirmPassword').addEventListener('input', function() {
    if(this.value === document.getElementById('newPassword').value) {
        this.classList.remove('error');
        document.getElementById('confirmPasswordError').classList.remove('active');
    }
});

document.getElementById('newPassword').addEventListener('input', function() {
    if(this.value === document.getElementById('confirmPassword').value) {
        document.getElementById('confirmPassword').classList.remove('error');
        document.getElementById('confirmPasswordError').classList.remove('active');
    }
    
});

document.getElementById('passwordForm').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault();
    }
});
</script>

</body>

</html>
