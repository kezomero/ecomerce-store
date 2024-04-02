<?php

session_start();

include("includes/db.php");

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {




?>

<?php

$admin_session = $_SESSION['admin_email'];

$get_admin = "select * from admins  where admin_email='$admin_session'";

$run_admin = mysqli_query($con,$get_admin);

$row_admin = mysqli_fetch_array($run_admin);

$admin_id = $row_admin['admin_id'];

$admin_name = $row_admin['admin_name'];

$admin_email = $row_admin['admin_email'];

$admin_image = $row_admin['admin_image'];

$admin_country = $row_admin['admin_country'];

$admin_job = $row_admin['admin_job'];

$admin_contact = $row_admin['admin_contact'];

$admin_about = $row_admin['admin_about'];


$get_products = "SELECT * FROM products";
$run_products = mysqli_query($con,$get_products);
$count_products = mysqli_num_rows($run_products);

$get_customers = "SELECT * FROM customers";
$run_customers = mysqli_query($con,$get_customers);
$count_customers = mysqli_num_rows($run_customers);

$get_p_categories = "SELECT * FROM product_categories";
$run_p_categories = mysqli_query($con,$get_p_categories);
$count_p_categories = mysqli_num_rows($run_p_categories);


$get_total_orders = "SELECT * FROM customer_orders";
$run_total_orders = mysqli_query($con,$get_total_orders);
$count_total_orders = mysqli_num_rows($run_total_orders);


$get_pending_orders = "SELECT * FROM customer_orders WHERE order_status='pending'";
$run_pending_orders = mysqli_query($con,$get_pending_orders);
$count_pending_orders = mysqli_num_rows($run_pending_orders);

$get_completed_orders = "SELECT * FROM customer_orders WHERE order_status='Complete'";
$run_completed_orders = mysqli_query($con,$get_completed_orders);
$count_completed_orders = mysqli_num_rows($run_completed_orders);


$get_total_earnings = "SELECT SUM( due_amount) as Total FROM customer_orders WHERE order_status = 'Complete'";
$run_total_earnings = mysqli_query($con, $get_total_earnings);
$row = mysqli_fetch_assoc($run_total_earnings);                       
$count_total_earnings = $row['Total'];


$get_coupons = "SELECT * FROM coupons";
$run_coupons = mysqli_query($con,$get_coupons);
$count_coupons = mysqli_num_rows($run_coupons);


?>


<!DOCTYPE html>
<html>

<head>

<title>Admin Panel</title>

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" >
<link rel="shortcut icon" href="//cdn.shopify.com/s/files/1/2484/9148/files/SDQSDSQ_32x32.png?v=1511436147" type="image/png">

</head>

<body>

<div id="wrapper"><!-- wrapper Starts -->

<?php include("includes/sidebar.php");  ?>

<div id="page-wrapper"><!-- page-wrapper Starts -->

<div class="container-fluid"><!-- container-fluid Starts -->

<?php

if(isset($_GET['dashboard'])){

include("dashboard.php");

}

if(isset($_GET['insert_product'])){

include("insert_product.php");

}

if(isset($_GET['view_products'])){

include("view_products.php");

}

if(isset($_GET['delete_product'])){

include("delete_product.php");

}

if(isset($_GET['edit_product'])){

include("edit_product.php");

}

if(isset($_GET['insert_p_cat'])){

include("insert_p_cat.php");

}

if(isset($_GET['view_p_cats'])){

include("view_p_cats.php");

}

if(isset($_GET['delete_p_cat'])){

include("delete_p_cat.php");

}

if(isset($_GET['edit_p_cat'])){

include("edit_p_cat.php");

}

if(isset($_GET['insert_cat'])){

include("insert_cat.php");

}

if(isset($_GET['view_cats'])){

include("view_cats.php");

}

if(isset($_GET['delete_cat'])){

include("delete_cat.php");

}

if(isset($_GET['edit_cat'])){

include("edit_cat.php");

}

if(isset($_GET['insert_slide'])){

include("insert_slide.php");

}


if(isset($_GET['view_slides'])){

include("view_slides.php");

}

if(isset($_GET['delete_slide'])){

include("delete_slide.php");

}


if(isset($_GET['edit_slide'])){

include("edit_slide.php");

}


if(isset($_GET['view_customers'])){

include("view_customers.php");

}

if(isset($_GET['customer_delete'])){

include("customer_delete.php");

}


if(isset($_GET['view_orders'])){

include("view_orders.php");

}

if(isset($_GET['order_delete'])){

include("order_delete.php");

}

if(isset($_GET['insert_user'])){

include("insert_user.php");

}

if(isset($_GET['view_users'])){

include("view_users.php");

}


if(isset($_GET['user_delete'])){

include("user_delete.php");

}



if(isset($_GET['user_profile'])){

include("user_profile.php");

}

if(isset($_GET['insert_box'])){

include("insert_box.php");

}

if(isset($_GET['view_boxes'])){

include("view_boxes.php");

}
if(isset($_GET['view_payments'])){

include("view_payments.php");

}

if(isset($_GET['delete_box'])){

include("delete_box.php");

}

if(isset($_GET['edit_box'])){

include("edit_box.php");

}

if(isset($_GET['insert_term'])){

include("insert_term.php");

}

if(isset($_GET['view_terms'])){

include("view_terms.php");

}

if(isset($_GET['delete_term'])){

include("delete_term.php");

}

if(isset($_GET['edit_term'])){

include("edit_term.php");

}

if(isset($_GET['edit_css'])){

include("edit_css.php");

}

if(isset($_GET['insert_manufacturer'])){

include("insert_manufacturer.php");

}

if(isset($_GET['view_manufacturers'])){

include("view_manufacturers.php");

}

if(isset($_GET['delete_manufacturer'])){

include("delete_manufacturer.php");

}

if(isset($_GET['edit_manufacturer'])){

include("edit_manufacturer.php");

}





if(isset($_GET['insert_icon'])){

include("insert_icon.php");

}


if(isset($_GET['view_icons'])){

include("view_icons.php");

}

if(isset($_GET['delete_icon'])){

include("delete_icon.php");

}

if(isset($_GET['edit_icon'])){

include("edit_icon.php");

}


if(isset($_GET['edit_contact_us'])){

include("edit_contact_us.php");

}

if(isset($_GET['insert_enquiry'])){

include("insert_enquiry.php");

}


if(isset($_GET['view_enquiry'])){

include("view_enquiry.php");

}

if(isset($_GET['delete_enquiry'])){

include("delete_enquiry.php");

}

if(isset($_GET['edit_enquiry'])){

include("edit_enquiry.php");

}


if(isset($_GET['edit_about_us'])){

include("edit_about_us.php");

}


if(isset($_GET['insert_store'])){

include("insert_store.php");

}

if(isset($_GET['view_store'])){

include("view_store.php");

}

if(isset($_GET['delete_store'])){

include("delete_store.php");

}

if(isset($_GET['edit_store'])){

include("edit_store.php");

}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['receiver_email'])) {
    // Get the message data from the POST request
    $message = $_POST['message'];
    $receiverEmail = $_POST['receiver_email'];

    // Validate and sanitize input data if needed

    // Insert the message into the messages table
    $insertQuery = "INSERT INTO messages (sender_email, receiver_email, message_text) 
                    VALUES ('$admin_email', '$receiverEmail', '$message')";
    $result = mysqli_query($con, $insertQuery);

    if ($result) {
        // Message insertion successful
        echo "Message sent successfully!";
    } else {
        // Error inserting message
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}

?>

<!-- Chat Button -->
<div class="chat-btn" id="chatBtn">Chat</div>

<!-- Chat Window -->
<div class="chat-window" id="chatWindow" style="display: none;">
    <!-- X button to close the chat window -->
    <div id="closeChatBtn">X</div>
    <!-- User list container -->
    <div id="userListContainer"></div>
    <!-- Chat messages container -->
    <div id="chatMessagesContainer" style="height: 300px; overflow-y: scroll;"></div>
    <!-- Form for sending messages -->
    <form id="chatForm" method="POST"> <!-- Updated method attribute -->
        <input type="text" name="message" id="messageInput" placeholder="Type your message..." required>
        <!-- Hidden input for receiver email -->
        <input type="hidden" name="receiver_email" id="receiverEmailInput">
        <!-- Send button -->
        <button type="submit" id="sendBtn">Send</button>
    </form>
</div>

</div><!-- container-fluid Ends -->

</div><!-- page-wrapper Ends -->

</div><!-- wrapper Ends -->

<style>
    /* Chat Window Styling */
    .chat-window {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        padding: 10px;
        z-index: 9999;
        max-width: 300px;
        display: none;
    }

    .chat-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9999;
    }

    #closeChatBtn {
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
        font-weight: bold;
    }

    .message {
        margin: 5px;
        border-radius: 5px;
        background-color: #f2f2f2;
        max-width: 80%;
        padding: 10px;
    }

    .sent-message {
        background-color: #007bff;
        color: #fff;
        border-radius: 20px 20px 20px 0;
        text-align: left;
    }

    .received-message {
        background-color: #f2eee1;
        color: #333;
        border-radius: 20px 20px 0 20px;
        text-align: right;
    }

    #adminListContainer {
        margin-bottom: 10px;
    }

    #chatMessagesContainer {
        height: 300px;
        overflow-y: scroll;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    #messageInput {
        width: calc(100% - 80px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 5px;
    }

    #sendBtn {
        padding: 8px 15px;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
</style>

<script>
    // Declare receiverEmail variable outside the function
    let receiverEmail = '';
    // Function to fetch and display the user list
    function fetchUserList() {
        fetch('fetch_user_list.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Construct the user list HTML
                let userListHTML = '<ul>';
                data.forEach(user => {
                    // Add click event to each user email
                    userListHTML += '<li><a href="#" class="user-email" data-email="' + user.email + '">' + user.email + '</a></li>';
                });
                userListHTML += '</ul>';

                // Display the user list in the chat window
                document.getElementById('userListContainer').innerHTML = userListHTML;

                // Add click event to each user email link
                document.querySelectorAll('.user-email').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault(); // Prevent default link behavior

                        // Get the clicked email
                        const clickedEmail = this.getAttribute('data-email');
                        console.log('Clicked Email:', clickedEmail);

                        // Set the receiver email
                        receiverEmail = clickedEmail;
                        // Call the fetchMessages function with the clicked email
                        fetchMessages(clickedEmail);
                    });
                });
            } else {
                // Display a message if no users are found
                document.getElementById('userListContainer').innerHTML = '<p>No chats available.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
        // Add click event to each user email link
        document.querySelectorAll('.user-email').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Get the clicked email
                const clickedEmail = this.getAttribute('data-email');
                console.log('Clicked Email:', clickedEmail);

                // Set the receiver email in the hidden input field
                setReceiverEmail(clickedEmail);

                // Call the fetchMessages function with the clicked email
                fetchMessages(clickedEmail);
            });
        });

    }

    // Function to fetch and display messages for the selected user
    function fetchMessages(email) {
        const formData = new FormData();
        formData.append('receiver_email', email);

        fetch('fetch_messages.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Display fetched messages in the chat window
            document.getElementById('chatMessagesContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Function to set the receiver email when a user's chat is opened
function setReceiverEmail(email) {
    document.getElementById('receiverEmailInput').value = email;
}
    document.getElementById('chatBtn').addEventListener('click', function() {
        document.getElementById('chatWindow').style.display = 'block';
        document.getElementById('chatBtn').style.display = 'none'; // Hide chat button

        // Call the fetchUserList function when the chat button is clicked
        fetchUserList();
    });

    document.getElementById('closeChatBtn').addEventListener('click', function() {
        document.getElementById('chatWindow').style.display = 'none';
        document.getElementById('chatBtn').style.display = 'block'; // Show chat button
    });
    document.getElementById('chatForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the message and receiver email
    const message = document.getElementById('messageInput').value;

    // Validate input if needed

    // Make an AJAX request to send the message data
    fetch(window.location.href, { // Using window.location.href to send to the same file
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Set the content type
        },
        body: new URLSearchParams({
            'message': message,
            'receiver_email': receiverEmail
        })
    })
    .then(response => response.text())
    .then(data => {
        // Handle the server response accordingly
        console.log('Server Response:', data);
        //alert('Server Response: ' + data); // Display the server response

        // Clear the message input field after sending
        document.getElementById('messageInput').value = '';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending message.'); // Display error message if request fails
    });
});

</script>


<script src="js/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>


</body>


</html>

<?php } ?>