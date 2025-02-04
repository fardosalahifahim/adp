<?php
include 'db.php';
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notifications WHERE user_id='$user_id' ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Notifications</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>" . $row['notification_type'] . ":</strong> " . $row['message'] . "<br><em>Time: " . $row['timestamp'] . "</em></p>";
            }
        } else {
            echo "<p>No notifications available.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
