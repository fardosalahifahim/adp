<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];

    // Send friend request
    $sql = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES ('$sender_id', '$receiver_id', 'pending')";

    if ($conn->query($sql) === TRUE) {
        // Log the activity
        $activity_type = "Friend Request Sent";
        $activity_description = "User ID $sender_id sent a friend request to User ID $receiver_id.";
        $log_sql = "INSERT INTO user_activities (user_id, activity_type, activity_description) VALUES ('$sender_id', '$activity_type', '$activity_description')";
        $conn->query($log_sql);

        // Log notification
        $notification_message = "You have sent a friend request to User ID $receiver_id.";
        $notification_sql = "INSERT INTO notifications (user_id, notification_type, message) VALUES ('$receiver_id', 'Friend Request', '$notification_message')";
        $conn->query($notification_sql);

        echo "Friend request sent!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// View pending friend requests
$pending_sql = "SELECT * FROM friend_requests WHERE receiver_id='" . $_SESSION['user_id'] . "' AND status='pending'";
$pending_result = $conn->query($pending_sql);

// Accept friend request
if (isset($_GET['accept'])) {
    $request_id = $_GET['accept'];
    $sql = "UPDATE friend_requests SET status='accepted' WHERE id='$request_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Friend request accepted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
</head>
<body>
    <h2>Pending Friend Requests</h2>
    <ul>
        <?php
        if ($pending_result->num_rows > 0) {
            while($row = $pending_result->fetch_assoc()) {
                echo "<li>User ID " . htmlspecialchars($row['sender_id']) . " sent you a friend request. ";
                echo "<a href='friend_request.php?accept=" . $row['id'] . "'>Accept</a></li>";
            }
        } else {
            echo "<li>No pending friend requests.</li>";
        }
        ?>
    </ul>
</body>
</html>
