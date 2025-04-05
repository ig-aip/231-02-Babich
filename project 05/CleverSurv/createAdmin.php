<?php
require_once("db.php");

$email = 'firstAdmin@yandex.ru'; // Замените на нужный email
$password = 'admin123'; // Замените на надежный пароль

// Хеширование пароля
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Добавляем роль в запрос
$sql = "INSERT INTO users (Email, Password, Role) VALUES (?, ?, 'admin')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if($stmt->execute()) {
    echo "Администратор успешно создан!";
} else {
    echo "Ошибка: " . $conn->error;
}

$stmt->close();
$conn->close();
?>