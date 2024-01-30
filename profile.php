<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    

    <style>
           body {
                background-color: #f5dec4;
                color: #231915;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
        
        

            .header{
        
        height: 14vh;
        display: flex; 
        justify-content: space-around;
        align-items: center;
        background: #bd8d54;
    }
    .header .usercart{
        display: flex;
        
        gap: 40px;    
    }
    .header .usercart .usersec{
        display: flex;
        align-items: center;
    }
    .header .usercart .usersec:hover{
        color: white;
    }
    .header .usercart .cartsec{
        display: flex;
        align-items: center;
    }

    .header .searchbar{
        display: flex;
        align-items: center;
        /* gap: 7px; */
    }
    .header .searchbar input{
        padding: 6.5px 70px;
        border: none;
        border-radius: 4px 0px 0px 4px;
        cursor: pointer;
    }
    i{
        cursor: pointer;
        font-size: 20px;
        border: 1px solid rgba(0, 0, 0, 0.434);
        padding: 4.5px 10px;
        border-radius: 0px 4px 4px 0px;
        color: white;
    }
    .usersignup a button:hover{
        color: white;
        
    }
    .footer{
        background: #bd8d54;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding-top: 10px;
    }
    .footer .footercontent a{
        color: white;
        text-decoration: none;
        padding-left: 30px;
        font-weight: 700;

    }
    .copy{
        /* background-color: #231915; */
        /* color: white; */
    }
    .copy p{
        text-align: center;
    }
  
</style>
</head>
<body>
<div class="header">
<div class="logosec">
    <a href="index.php"><img src="images/logo.png" style="width:140px;height:60px;"></a>

</div>
<div class="searchbar">
    <form action="search.php" method="get">
<input type="text" name="query" placeholder="What are you looking for?" required>
<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
</div>
<div class="usercart">

    <div class="cartsec">
        <a href="cart.php"><img src="images/cart.png" style="width:25px;height:25px; padding-right: 4px;"></a> <span style="color: black;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;cursor: pointer;">VIEW CART</span>

    </div>
<?php
     // Check if the user is logged in
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     
     if (isset($_SESSION["user_id"])) {
         echo '<div class="usersec">';
         echo '<a href="profile.php" style="background: #bd8d54;color:black;border: 2px solid burlywood;padding: 5px 10px;font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;cursor: pointer;font-weight: bold;">Welcome, ' . $_SESSION["username"] . '</a>';
         echo '</div>';
         echo '<div class="usersignup">';
         echo '<a href="logout.php"><button style="background: #bd8d54;border: 2px solid burlywood;padding: 5px 10px;font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;cursor: pointer;font-weight: bold;">LOG OUT</button></a>';
         echo '</div>';
     } else {
         echo '<div class="usersec">';
         echo '<a href="login.php" style="display:flex;color:black;text-decoration:none;"><img src="images/account.png" style="width:25px;height:25px;"> <span style="font-family:\'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif ;cursor: pointer;">LOGIN</span></a>';
         echo '</div>';
         echo '<div class="usersignup">';
         echo '<a href="account.html"><button style="background: #bd8d54;border: 2px solid burlywood;padding: 5px 10px;font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;cursor: pointer;font-weight: bold;">SIGN UP</button></a>';
         echo '</div>';
     }
     ?>

</div>    
</div>



<?php
// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // If not logged in, redirect to the login page or any other appropriate page
    header("Location: login.php");
    exit();
}

// Fetch user information from the database based on the user ID
// You need to modify this part to fit your database structure
$user_id = $_SESSION["user_id"];

// Connect to the MySQL database
$conn = mysqli_connect("localhost", "root", "mysql", "client1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details from the database
$sqlUser = "SELECT * FROM user_accounts WHERE id = $user_id";
$resultUser = mysqli_query($conn, $sqlUser);

if ($resultUser && mysqli_num_rows($resultUser) > 0) {
    $userDetails = mysqli_fetch_assoc($resultUser);
    // Display user information
    echo '<h2>User Profile</h2>';
    echo '<p>Name: ' . $userDetails['username'] . '</p>';
    echo '<p>Email: ' . $userDetails['email'] . '</p>';
    // Display other user details as needed
} else {
    echo 'User not found.';
}

// Fetch products in the user's cart
$sqlCart = "SELECT * FROM products WHERE id IN (SELECT product_id FROM cart WHERE user_id = $user_id)";
$resultCart = mysqli_query($conn, $sqlCart);

if ($resultCart && mysqli_num_rows($resultCart) > 0) {
    echo '<h2>Cart Products</h2>';
    while ($product = mysqli_fetch_assoc($resultCart)) {
        echo '<div>';
        echo '<img src="' . $product['image_url'] . '" alt="' . $product['name'] . '" width="100" height="100">';
        echo '<h3>' . $product['name'] . '</h3>';
        echo '<p>Price: $' . $product['price'] . '</p>';
        // Display other product details as needed
        echo '</div>';
    }
} else {
    echo 'Cart is empty.';
}

// Close the MySQL connection
mysqli_close($conn);
?>

<div class="footer">
        <div class="icon">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="footercontent">
            <a href="contact.php">CONTACT US</a>
            <a href="about.php">ABOUT US</a>
            <a href="faq.php">FAQ</a>
        </div>
        
        
        
    </div>
    <div class="copy">
        <p>Copyright &copy; Team Flash</p>
    </div>
        
</body>
</html>