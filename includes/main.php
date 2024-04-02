</head>

<body>

  <header class="page-header">
    <!-- topline -->
    <div class="page-header__topline">
      <div class="container clearfix">

        <div class="currency">
          <a class="currency__change" href="customer/my_account.php?my_orders">
          <?php
          if(!isset($_SESSION['customer_email'])){
          echo "Welcome :Guest"; 
          }
          else
          { 
              echo "Welcome : " . $_SESSION['customer_email'] . "";
            }
?>
          </a>
        </div>

        <div class="basket">
          <a href="cart.php" class="btn btn--basket">
            <i class="icon-basket"></i>
            <?php items(); ?> items
          </a>
        </div>
        
        
        <ul class="login">

<li class="login__item">
<?php
if(!isset($_SESSION['customer_email'])){
  echo '<a href="customer_register.php" class="login__link">Register</a>';
} 
  else
  { 
      echo '<a href="customer/my_account.php?my_orders" class="login__link">My Account</a>';
  }   
?>  
</li>


<li class="login__item">
<?php
if(!isset($_SESSION['customer_email'])){
  echo '<a href="checkout.php" class="login__link">Sign In</a>';
} 
  else
  { 
      echo '<a href="./logout.php" class="login__link">Logout</a>';
  }   
?>  
  
</li>
</ul>
      
      </div>
    </div>
    <!-- bottomline -->
    <div class="page-header__bottomline">
      <div class="container clearfix">

        <div class="logo" >
          <a class="logo__link" href="index.php">
            CATE SECONDHAND STORE
          </a>
        </div>

        <nav class="main-nav">
          <ul class="categories">

            <li class="categories__item">
              <a class="categories__link" href="index.php">
                Home
               
              </a>
              </li>

            <li class="categories__item">
              <a class="categories__link categories__link--active" href="shop.php">
                Shop
              </a>
            </li>

            <li class="categories__item">
              <a class="categories__link" href="about.php">
                About us
              </a>
            </li>
            
            <li class="categories__item">
              <a class="categories__link" href="localstore.php">
                Local Stores
              </a>
            </li>

          <li class="categories__item">
              <a class="categories__link" href="customer/my_account.php?my_orders">
                My Account
                <i class="icon-down-open-1"></i>
              </a>
             

            </li>

          </ul>
        </nav>
      </div>
    </div>
    <style>
    /* CSS styles for the logo */
    .logo {
      margin-top: 20px; /* Add top margin for spacing */
    }

    .logo__link {
      font-size: 25px; /* Adjust the font size */
      font-weight: bold; /* Make the text bold */
      color: #333; /* Set the text color */
      text-decoration: none; /* Remove underline from the link */
      font-family: Arial, sans-serif;
    }
  </style>
  </header>