<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verification_code = $_POST['verification_code'];
    $user_id = $_SESSION['user_id'];

    // Check the verification code in the database
    $sql = "SELECT * FROM users WHERE id='$user_id' AND verification_code='$verification_code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update user status to verified
        $update_sql = "UPDATE users SET is_verified=TRUE WHERE id='$user_id'";
        $conn->query($update_sql);

        // Automatically log in the user
        $_SESSION['user_id'] = $user_id; // Set user ID in session
        setcookie("user_id", $user_id, time() + (86400 * 30), "/"); // 30 days
        echo "Email verified successfully! You are now logged in.";
        
        // Redirect to the feed or home page
        header("Location: feed.php");
        exit();
    } else {
        echo "Invalid verification code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            font-family: Arial, sans-serif;
        }
        .verification-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #2575fc;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <h2>Verify Your Email</h2>
        <form action="verify.php" method="POST">
            <input type="text" name="verification_code" placeholder="Enter Verification Code" required>
            <input type="submit" value="Verify">
        </form>
    </div>
</body>
</html>
