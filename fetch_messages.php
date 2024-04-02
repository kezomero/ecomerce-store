<?php
session_start();

// Include necessary files
include("includes/db.php");

// Check if receiver_email is set in the POST data
if (isset($_POST['receiver_email'])) {
    // Get the receiver's email and sender's email from session
    $receiverEmail = mysqli_real_escape_string($con, $_POST['receiver_email']);
    $senderEmail = $_SESSION['customer_email'];

    // Fetch chat messages from the database
    $getMessagesQuery = "SELECT * FROM messages 
                         WHERE (sender_email = '$senderEmail' AND receiver_email = '$receiverEmail') 
                         OR (sender_email = '$receiverEmail' AND receiver_email = '$senderEmail') 
                         ORDER BY timestamp ASC"; // Assuming 'timestamp' is the column storing message timestamps
    $runMessagesQuery = mysqli_query($con, $getMessagesQuery);

    // Generate HTML markup for displaying messages
    while ($rowMessage = mysqli_fetch_array($runMessagesQuery)) {
        $messageSender = $rowMessage['sender_email'];
        $messageText = $rowMessage['message_text'];

        // Determine message alignment based on sender's email and previous sender's email
        if ($messageSender == $receiverEmail) {
            // Set alignment based on timestamp comparison
            $messageAlignment = ($messageSender == $senderEmail) ? 'right' : 'left';
        } else {
            // Use previous alignment if sender is the same
            $messageAlignment = ($messageSender == $receiverEmail) ? 'left' : 'right';
        }

        // Generate HTML markup for the message with appropriate alignment and styling
        echo '<div class="message ' . $messageClass . '" style="text-align: ' . $messageAlignment . '">';
        echo $messageText; // Display the message text
        echo '</div>';
    }
    exit; // Stop further execution after displaying messages
}
?>
