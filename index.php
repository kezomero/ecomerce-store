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

<!-- Cover -->
<main>
  <!-- Auto-scrolling image slider -->
  <div class="slideshow-container">
    <div class="mySlides fade">
      <img src="admin_area/product_images/Black Blouse Versace Coat1.jpg" style="width:100%; height: auto;">
    </div>
    <div class="mySlides fade">
      <img src="admin_area/product_images/Black Blouse Versace Coat1.jpg" style="width:100%; height: auto;">
    </div>
    <div class="mySlides fade">
      <img src="admin_area/product_images/Black Blouse Versace Coat1.jpg" style="width:100%; height: auto;">
    </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">
    <h1>Featured Collection</h1>
  </div>

  <div id="content" class="container">
    <div class="row">
      <?php getPro(); ?>
    </div>
  </div>
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
</main>

<!-- FOOTER -->
<footer class="page-footer">

	<div class="footer-nav">
		<div class="container clearfix">

			<div class="footer-nav__col footer-nav__col--info">
				<div class="footer-nav__heading">Information</div>
				<ul class="footer-nav__list">
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">The brand</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Local stores</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Customer service</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Privacy &amp; cookies</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Site map</a>
					</li>
				</ul>
			</div>

			<div class="footer-nav__col footer-nav__col--whybuy">
				<div class="footer-nav__heading">Why buy from us</div>
				<ul class="footer-nav__list">
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Secure delivery</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Testimonials</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Award winning</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Ethical trading</a>
					</li>
				</ul>
			</div>

			<div class="footer-nav__col footer-nav__col--account">
				<div class="footer-nav__heading">Your account</div>
				<ul class="footer-nav__list">
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Sign in</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Register</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">View cart</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">View your lookbook</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Track an order</a>
					</li>
					<li class="footer-nav__item">
						<a href="#" class="footer-nav__link">Update information</a>
					</li>
				</ul>
			</div>


			<div class="footer-nav__col footer-nav__col--contacts">
				<div class="footer-nav__heading">Contact details</div>
				<address class="address">
				Head Office: Secondhand Products.<br>
				Kibabii, Bungoma.
			</address>
				<div class="phone">
					Telephone:
					<a class="phone__number" href="tel:0123456789">0123-456-789</a>
				</div>
				<div class="email">
					Email:
					<a href="mailto:support@yourwebsite.com" class="email__addr">support@yourwebsite.com</a>
				</div>
			</div>

		</div>
	</div>

	<!-- <div class="banners">
		<div class="container clearfix">

			<div class="banner-award">
				<span>Award winner</span><br> Fashion awards 2016
			</div>

			<div class="banner-social">
				<a href="#" class="banner-social__link">
				<i class="icon-facebook"></i>
			</a>
				<a href="#" class="banner-social__link">
				<i class="icon-twitter"></i>
			</a>
				<a href="#" class="banner-social__link">
				<i class="icon-instagram"></i>
			</a>
				<a href="#" class="banner-social__link">
				<i class="icon-pinterest-circled"></i>
			</a>
			</div>

		</div>
	</div> -->

	<div class="page-footer__subline">
		<div class="container clearfix">

			<div class="copyright">
				&copy; 2024 Second Hand Store&trade;
			</div>

			<div class="developer">
				Dev by Kezobree
			</div>

			<div class="designby">
				Design by Kezobree
			</div>
		</div>
	</div>
</footer>

<!-- CSS for slideshow -->
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
<style>
  .slideshow-container {
    max-width: 100%;
    max-height:20%;
    margin: 0;
    position: relative;
    overflow: hidden;
  }

  .fade {
    animation-name: fade;
    animation-duration: 7s; /* Adjust animation duration as needed */
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
  }

  @keyframes fade {
    0% {
      opacity: 0;
    }

    25% {
      opacity: 1;
    }

    75% {
      opacity: 1;
    }

    100% {
      opacity: 0;
    }
  }
</style>

<!-- JavaScript for slideshow -->
<script>
  let slideIndex = 0;

  function showSlides() {
    let slides = document.querySelectorAll('.mySlides');

    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }

    slideIndex++;

    if (slideIndex > slides.length) {
      slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = 'block';

    setTimeout(showSlides, 10000); // Change image every 5 seconds
  }

  window.onload = function () {
    showSlides();
  };
</script>

</body>
</html>
