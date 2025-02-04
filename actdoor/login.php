<?php
include 'db.php';
session_start();

// Initialize login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = null;
}

// Lockout logic
if ($_SESSION['login_attempts'] >= 3) {
    if (time() - $_SESSION['lockout_time'] < 300) { // 5 minutes lockout
        echo "Your account is locked. Please try again later.";
        exit();
    } else {
        // Reset attempts after lockout period
        $_SESSION['login_attempts'] = 0;
        $_SESSION['lockout_time'] = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username']; // Updated to match the input name
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;
            echo "Login successful!";
        } else {
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= 3) {
                $_SESSION['lockout_time'] = time();
                echo "Your account is locked due to multiple failed login attempts. Please try again later.";
            } else {
                echo "Invalid password.";
            }
        }
    } else {
        echo "No user found with that email.";
    }
}

$conn->close();
?>
