<?php
session_start();
include("includes/db.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    // Return empty array if admin is not logged in
    echo json_encode([]);
    exit;
}

// Fetch list of users who have texted the logged-in admin
$admin_email = $_SESSION['admin_email'];
$query = "SELECT DISTINCT sender_email AS email FROM messages WHERE receiver_email = '$admin_email'";
$result = mysqli_query($con, $query);

if (!$result) {
    // Handle query error
    echo json_encode([]);
    exit;
}

$userList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $userList[] = $row;
}

// Return the user list as JSON data
echo json_encode($userList);
?>
