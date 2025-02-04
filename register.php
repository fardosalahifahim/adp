<?php
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $retype_password = $_POST['retype_password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit();
    }

    // Check if the password and re-type password match
    if ($_POST['password'] !== $retype_password) {
        echo "Error: Passwords do not match.";
        exit();
    }

    // Check if the email or username already exists
    $check_sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Error: Email or Username already exists.";
    } else {
        $verification_code = bin2hex(random_bytes(16)); // Generate a verification code
        $sql = "INSERT INTO users (first_name, last_name, username, email, password, dob, gender, verification_code) VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$dob', '$gender', '$verification_code')";

        if ($conn->query($sql) === TRUE) {
            // Send verification email
            $mail = new PHPMailer(true);
            try {
                $mail->setFrom('your-email@example.com', 'Actdoor');
                $mail->addAddress($email);
                $mail->Subject = 'Email Verification';
                $mail->Body = "Please verify your email using this code: $verification_code";
                $mail->send();
                
                echo "Registration successful! A verification code has been sent to your email.";
            } catch (Exception $e) {
                echo "Error sending email: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $conn->error; // More detailed error message
        }
    }
}

$conn->close();
?>
