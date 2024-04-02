<?php
session_start();

// Include necessary files
include("includes/db.php");

// Check if receiver_email is set in the POST data
if (isset($_POST['receiver_email'])) {
    // Sanitize and validate the receiver's email
    $receiverEmail = mysqli_real_escape_string($con, $_POST['receiver_email']);

    // Get the logged-in user's email from the session
    $loggedInUserEmail = $_SESSION['customer_email'];

    // Fetch messages from the database for the specified receiver email
    $query = "SELECT sender_email, message_text FROM messages WHERE (sender_email = '$receiverEmail' OR receiver_email = '$receiverEmail') ORDER BY timestamp ASC"; // Assuming 'timestamp' is the column storing message timestamps
    $result = mysqli_query($con, $query);

    // Check if there are messages for the specified receiver
    if ($result && mysqli_num_rows($result) > 0) {
        // Display the fetched messages
        while ($row = mysqli_fetch_assoc($result)) {
            $messageSender = $row['sender_email'];
            $messageText = $row['message_text'];

            // Determine message alignment and styling based on sender's email
            $messageAlignment = ($messageSender == $loggedInUserEmail) ? 'right' : 'left'; // Align messages based on sender
            $messageClass = ($messageSender == $loggedInUserEmail) ? 'sent-message' : 'received-message'; // Add a class for styling based on sender

            // Generate HTML markup for the message with appropriate alignment and styling
            echo '<div class="message ' . $messageClass . '" style="text-align: ' . $messageAlignment . '">';
            echo $messageText; // Display the message text
            echo '</div>';
        }
    } else {
        // No messages found for the receiver
        echo '<div class="message">No messages available.</div>';
    }
} else {
    // No receiver_email provided in the POST data
    echo '<div class="message">Error: Receiver email not specified.</div>';
}
?>
