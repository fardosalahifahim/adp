<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $theme = $_POST['theme'];
    $color = $_POST['color'];

    $sql = "UPDATE users SET theme='$theme', color='$color' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Settings updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch current settings
$sql = "SELECT theme, color FROM users WHERE id='" . $_SESSION['user_id'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$current_theme = $row['theme'];
$current_color = $row['color'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>
    <h2>Settings</h2>
    <form action="settings.php" method="POST">
        <label for="theme">Select Theme:</label>
        <select name="theme" required>
            <option value="light" <?php if($current_theme == 'light') echo 'selected'; ?>>Light</option>
            <option value="dark" <?php if($current_theme == 'dark') echo 'selected'; ?>>Dark</option>
            <option value="black" <?php if($current_theme == 'black') echo 'selected'; ?>>Black</option>
        </select>
        <br>
        <label for="color">Select Color:</label>
        <select name="color" required>
            <option value="orange" <?php if($current_color == 'orange') echo 'selected'; ?>>Orange</option>
            <option value="pink" <?php if($current_color == 'pink') echo 'selected'; ?>>Pink</option>
            <option value="blue" <?php if($current_color == 'blue') echo 'selected'; ?>>Blue</option>
            <option value="black" <?php if($current_color == 'black') echo 'selected'; ?>>Black</option>
            <option value="yellow" <?php if($current_color == 'yellow') echo 'selected'; ?>>Yellow</option>
            <option value="green" <?php if($current_color == 'green') echo 'selected'; ?>>Green</option>
        </select>
        <br>
        <input type="submit" value="Save Settings">
    </form>
</body>
</html>
