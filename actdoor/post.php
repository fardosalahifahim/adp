<?php
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: about.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];

    // Insert the post into the posts table
    $sql = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Post created successfully!";
    } else {
        echo "Error: " . $conn->error; // More detailed error message
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create a New Post</h1>
        <form action="post.php" method="POST">
            <textarea name="content" rows="4" cols="50" placeholder="What's on your mind?" required></textarea><br>
            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>
