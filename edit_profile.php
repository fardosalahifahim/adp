<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $privacy = $_POST['privacy'];
    $email = $_POST['email']; // New field
    $password = $_POST['password']; // New field

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit();
    }

    // Prepare SQL statement
    $sql = "UPDATE users SET privacy='$privacy', email='$email' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch current user data
$sql = "SELECT privacy, email FROM users WHERE id='" . $_SESSION['user_id'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$current_privacy = $row['privacy'];
$current_email = $row['email'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="edit_profile.php" method="POST">
        <label for="privacy">Profile Privacy:</label>
        <select name="privacy" required>
            <option value="public" <?php if($current_privacy == 'public') echo 'selected'; ?>>Public</option>
            <option value="friends" <?php if($current_privacy == 'friends') echo 'selected'; ?>>Friends</option>
        </select>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($current_email); ?>" required>
        <br>
        <label for="password">New Password:</label>
        <input type="password" name="password">
        <br>
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
