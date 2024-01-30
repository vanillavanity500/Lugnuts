
<?php
 session_start();
            ?>  
 <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            body {
                background-color: #f5dec4;
                color: #231915;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
        

            .header{
        position: sticky;
        top: 0;
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
    .hero{
        height: 200vh;
        
    }
    .contact-form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-form label {
            text-align: left;
            width: 100%;
            margin-bottom: 5px;
        }

        .contact-form input,
        .contact-form textarea,
        .contact-form button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
    <title>About Us - Lugnuts Luxury Car Parts</title>
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

        <div class="hero">
        <div class="heading1">
            <h1>Contact Us</h1>
            <p>Let us know if you have any questions </p>
            <br><br>
        </div>
        <div class="contact-form">
            <form action="process_contact_form.php" method="post">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
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
