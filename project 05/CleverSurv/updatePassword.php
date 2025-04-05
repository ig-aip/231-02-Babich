<?php
session_start();
require_once("db.php");

if (!isset($_SESSION['user_email'])) {
    header("Location: logIn.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user_email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['errors'] = [
            'confirmPassword' => 'Пароли не совпадают'
        ];
        header("Location: profile_new.php?modal=password");
        exit();
    }

   if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[a-zA-Z\d\W_]{4,16}$/', $new_password)) {
    $_SESSION['errors'] = [
        'newPassword' => 'Пароль не соответствует требованиям'
    ];
    header("Location: profile_new.php?modal=password");
    exit();
}
    $stmt = $conn->prepare("SELECT password FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!password_verify($old_password, $user['password'])) {
        $_SESSION['errors'] = [
            'oldPassword' => 'Старый пароль неверен'
        ];
        header("Location: profile_new.php?modal=password");
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE Email = ?");
    $update_stmt->bind_param("ss", $hashed_password, $email);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Пароль успешно изменён!";
        header("Location: profile_new.php");
    } else {
        die("Ошибка обновления пароля: " . $conn->error);
    }
}
?>