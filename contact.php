<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");
// Fetch the necessary data for the chat window if needed
// Insert message into database if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['receiver_email'])) {
  // Check if user is logged in
  if (!isset($_SESSION['customer_email'])) {
      // Redirect to login page or display a message
      echo "login";
      exit; // Stop further execution
  }

  // Sanitize and validate the incoming data
  $message = mysqli_real_escape_string($con, $_POST['message']);
  $receiverEmail = mysqli_real_escape_string($con, $_POST['receiver_email']); // Assuming receiver_email is submitted in the form
  $senderEmail = $_SESSION['customer_email']; // Get sender's email from session
  if(!empty($_POST['receiver_email'])){

      // Insert the message into the database with sender's email
      $insertMessageQuery = "INSERT INTO messages (sender_email, receiver_email, message_text) 
      VALUES ('$senderEmail', '$receiverEmail', '$message')";
      $result = mysqli_query($con, $insertMessageQuery);

      if ($result) {
      // Redirect back to the same page after successful insertion
      //header("Location: ".$_SERVER['PHP_SELF']);
      // exit; // Stop further execution
      } else {
      // Error occurred during insertion
      echo '<script>alert("Error sending message");</script>';
      }
  }else{
      //header("Location: ".$_SERVER['PHP_SELF']);
      echo '<script>alert("Select a user to chat with");</script>';
  }
}
?>


  <!-- MAIN -->
  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">Contact</span> Us
      </div>
      <p class="nero__text">
      If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.
      </p>
    </div>
  </main>

<div class="col-md-12" ><!-- col-md-12 Starts -->

<div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center><!-- center Starts -->

<?php

$get_contact_us = "select * from contact_us";

$run_conatct_us = mysqli_query($con,$get_contact_us);

$row_conatct_us = mysqli_fetch_array($run_conatct_us);

$contact_heading = $row_conatct_us['contact_heading'];

$contact_desc = $row_conatct_us['contact_desc'];

$contact_email = $row_conatct_us['contact_email'];

?>

<h2> <?php echo $contact_heading; ?> </h2>

<p class="text-muted" >
<?php echo $contact_desc; ?>
</p>

</center><!-- center Ends -->

</div><!-- box-header Ends -->

<form action="contact.php" method="post" ><!-- form Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label>Name</label>

<input type="text" class="form-control" name="name" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Email</label>

<input type="text" class="form-control" name="email" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Subject </label>

<input type="text" class="form-control" name="subject" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Message </label>

<textarea class="form-control" name="message"> </textarea>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label> Select Enquiry Type </label>


<select name="enquiry_type" class="form-control"><!-- select Starts -->

<option> Select Enquiry Type </option>

<?php

$get_enquiry_types = "select * from enquiry_types";

$run_enquiry_types = mysqli_query($con,$get_enquiry_types);

while($row_enquiry_types = mysqli_fetch_array($run_enquiry_types)){

$enquiry_title = $row_enquiry_types['enquiry_title'];

echo "<option> $enquiry_title </option>";

}

?>

</select><!-- select Ends -->

</div><!-- form-group Ends -->


<div class="text-center"><!-- text-center Starts -->

<button type="submit" name="submit" class="btn btn-primary">

<i class="fa fa-user-md"></i> Send Message

</button>

</div><!-- text-center Ends -->

</form><!-- form Ends -->

<?php

if(isset($_POST['submit'])){

// Admin receives email through this code

$sender_name = $_POST['name'];

$sender_email = $_POST['email'];

$sender_subject = $_POST['subject'];

$sender_message = $_POST['message'];

$enquiry_type = $_POST['enquiry_type'];

$new_message = "

<h1> This Message Has Been Sent By $sender_name </h1>

<p> <b> Sender Email :  </b> <br> $sender_email </p>

<p> <b> Sender Subject :  </b> <br> $sender_subject </p>

<p> <b> Sender Enquiry Type :  </b> <br> $enquiry_type </p>

<p> <b> Sender Message :  </b> <br> $sender_message </p>

";

$headers = "From: $sender_email \r\n";

$headers .= "Content-type: text/html\r\n";

mail($contact_email,$sender_subject,$new_message,$headers);

// Send email to sender through this code

$email = $_POST['email'];

$subject = "Welcome to my website";

$msg = "I shall get you soon, thanks for sending us email";

$from = "sad.ahmed22224@gmail.com";

mail($email,$subject,$msg,$from);

echo "<h2 align='center'>Your message has been sent successfully</h2>";

}


?>

</div><!-- box Ends -->

</div><!-- col-md-12 Ends -->

<!-- Chat Button -->
<div class="chat-btn" id="chatBtn">Chat</div>

<!-- Chat Window -->
<div class="chat-window" id="chatWindow" style="display: none;">
    <!-- X button to close the chat window -->
    <div id="closeChatBtn">X</div>
    <!-- Admin list container -->
    <div id="adminListContainer">
        <?php
        // Fetch available admins directly from the database
        $get_admins = "SELECT * FROM admins";
        $run_admins = mysqli_query($con, $get_admins);
        if (mysqli_num_rows($run_admins) > 0) {
            echo '<form id="chatForm" method="post">'; // Open the form with an ID
            echo '<select id="adminSelect" name="receiver_email">'; // Changed name attribute to receiver_email
            echo '<option value="">Select One to Chat With</option>';
            while ($row_admins = mysqli_fetch_array($run_admins)) {
                echo '<option value="' . $row_admins['admin_email'] . '">' . $row_admins['admin_name'] . '</option>'; // Changed value to admin_email
            }
            echo '</select>';
            echo '<div id="chatMessagesContainer" style="height: 400px; overflow-y: scroll;"></div>'; // Scrollable container to display chat messages
            echo '<input type="text" name="message" placeholder="Type your message...">'; // Added input field for message
            echo '<button type="submit" id="sendBtn">Send</button>'; // Changed button type to submit
            echo '</form>'; // Close the form
        } else {
            echo '<p>No available admins.</p>';
        }
        ?>
    </div>
</div>

</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>
<style>
    /* CSS for Chat Window */
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
    }

    .message.right {
        text-align: right;
        background-color: #007bff;
        color: #fff;
    }
    .message {
    margin: 5px;
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
    background-color: #f2f2f2;
    color: #333;
    border-radius: 20px 20px 0 20px;
    text-align: right;
}

</style>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    document.getElementById('chatBtn').addEventListener('click', function() {
        document.getElementById('chatWindow').style.display = 'block';
        document.getElementById('chatBtn').style.display = 'none'; // Hide chat button
    });

    document.getElementById('closeChatBtn').addEventListener('click', function() {
        document.getElementById('chatWindow').style.display = 'none';
        document.getElementById('chatBtn').style.display = 'block'; // Show chat button
    });

    // JavaScript for handling form submission and displaying messages
    document.getElementById('adminSelect').addEventListener('change', function() {
    var form = document.getElementById('chatForm');
    var formData = new FormData(form);
    fetch('fetch_messages.php', { // Updated URL to fetch_messages.php
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'login') {
            // Handle login redirection or display a login message
            alert('Please login to send messages.');
        } else {
            // Display fetched chat messages
            document.getElementById('chatMessagesContainer').innerHTML = data;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
