<?php
session_start();
require_once("db.php");

// Очистка предыдущих данных
unset($_SESSION['errors']);
unset($_SESSION['old_data']);

$errors = [];
$old_data = $_POST;
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Валидация полей
if (empty($email)) {
    $errors['email'] = "Поле Email обязательно для заполнения";
}

if (empty($password)) {
    $errors['password'] = "Поле Пароль обязательно для заполнения";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_data'] = $old_data;
    header("Location: login.php");
    exit();
}

// Проверка существования пользователя
$stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $errors['email'] = "Пользователь с таким email не найден";
    $_SESSION['errors'] = $errors;
    $_SESSION['old_data'] = $old_data;
    header("Location: login.php");
    exit();
}

$user = $result->fetch_assoc();

// Проверка пароля
if (!password_verify($password, $user['Password'])) {
    $errors['password'] = "Неверный пароль";
    $_SESSION['errors'] = $errors;
    $_SESSION['old_data'] = $old_data;
    header("Location: login.php");
    exit();
}

// Успешная авторизация
$_SESSION['user_email'] = $email;
$_SESSION['user_role'] = $user['Role'];
header("Location: indexP.php");
exit();

$stmt->close();
$conn->close();
?>