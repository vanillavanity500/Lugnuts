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
    .featured-products{
        display: flex;
        justify-content: space-around;
        
    }
    .featured-products .card{
        height: 75vh;
        width: 350px;
        background: #bd8d54;
        border-radius: 10px 10px 0px 0px;
    }

    .featured-products .featured-products1{
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .featured-products .card img{
        width: 100%;
        height: 60%;
        border-radius: 10px 10px 0px 0px;
    }
    .featured-products .featured-products2{
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .featured-products .card .nameprice{
        display: flex;
        justify-content: space-around;
        color: white;
    }
    .featured-products .card .btns{
        display: flex;
        justify-content: center;
        gap: 20px;
        padding-top: 20px;
    }
    .featured-products .card .btns button{
        padding: 10px 20px;
        background: #f5dec4;
        border-radius: 2px;
        cursor: pointer;
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
        
        <div class="hero">
            
            <div class="heading1">   
                <h1 style="font-family: 'Times New Roman', Times, serif;text-align: center;font-size: 60px;">Latest Arrivals</h1>
            </div>
            
            <ul>
        <?php
            // Connect to the MySQL database
            $conn = mysqli_connect("localhost", "root", "mysql", "client1");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch the last 3 products from the database
            $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li>';
                    echo '<a href="product.php?id=' . $row['id'] . '">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" width="100" height="100">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>Price: $' . $row['price'] . '</p>';
                    echo '<form action="cart.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                    echo '<input type="submit" value="ADD TO CART">';
                    echo '</form>';
                    echo '</li>';
                }
            } else {
                echo "<li>No products available.</li>";
            }

            // Close the MySQL connection
            mysqli_close($conn);
        ?>
    </ul>
            <div class="card" style="background-color: #f5dec4;"><a href="browse.php" style="font-size: 50px;text-decoration: none;color: black;display: flex;justify-content: center;align-items: center;padding-top: 150px;">Browse Collection<i class="fa-solid fa-arrow-right"></i></a>
            </div>

        
            </div>
        

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

