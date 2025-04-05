<?php
session_start();
require_once("db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['old_data'] = $_POST;
    $errors = [];

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    $role = 'user';

    if ($password !== $repeatpassword) {
        $errors['repeatpassword'] = "Пароли не совпадают";
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[a-zA-Z\d\W_]{4,16}$/', $password)) {
        $errors['password'] = "Пароль должен содержать: буквы верхнего/нижнего регистра, цифры, спецсимволы и быть от 4 до 16 символов";
    }

    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors['email'] = "Пользователь с таким email уже существует";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: registor.php");
        exit();
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка нового пользователя
    $insert_query = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sss", $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $role;
        header("Location: indexP.php");
        exit();
    } else {
        die("Ошибка регистрации: " . $conn->error);
    }
}
?>