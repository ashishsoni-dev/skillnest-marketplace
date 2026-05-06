<?php
include("../php/core/init.php");


$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$role = $_POST['role'];

// VALIDATION
if (empty($name) || empty($email) || empty($password)) {
    echo "All fields required";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email";
    exit;
}

if (strlen($password) < 6) {
    echo "Password must be at least 6 characters";
    exit;
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $password, $role);

if ($stmt->execute()) {
    header("Location: ../pages/login.php?success=account_created");
    exit;
} else {
    header("Location: ../pages/signup.php?error=signup_failed");
    exit;
}
