<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    
    <link rel="stylesheet" type="text/css" href="product-styles.css">
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
        header, footer {
            background-color: #bd8d54;
            padding: 20px;
        }
        a, #search {
            color: #231915;
            text-decoration: none;
        }
        header {
            position: sticky;
            top: 0;
            z-index: 100;
        }
        footer {
            width: 100%;
            margin-top: 20px;
        }
        main {
            text-align: center;
        }
        #product-image-element {
            width: 300px;
            height: 200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        #product-description {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 800px;
            margin: 10px auto;
        }
        #icons a {
            margin-right: 20px;
        }
        ul {
            list-style-type: none;
            text-align: center;
            padding: 0;
        }
        ul li {
            display: inline;
            margin-right: 150px;
            color: #f5dec4;
        }
    </style>




</head>
<body>
    <div class="header">
        <div class="logosec">
            <a href="index.html"><img src="images/logo.png" style="width:140px;height:60px;"></a>

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
            session_start();

            if (isset($_SESSION["user_id"])) {
                echo '<div class="usersec">';
                echo 'Welcome, ' . $_SESSION["username"];
                echo '</div>';
                echo '<div class="usersignup">';
                echo '<a href="logout.php"><button style="background: #bd8d54;border: 2px solid burlywood;padding: 5px 10px;font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;cursor: pointer;font-weight: bold;">LOG OUT</button></a>';
                echo '</div>';
            } else {
                echo '<div class="usersec">';
                echo '<a href="login.php"><img src="images/account.png" style="width:25px;height:25px;"></a> <span style="font-family:\'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif ;cursor: pointer;">LOGIN</span>';
                echo '</div>';
                echo '<div class="usersignup">';
                echo '<a href="account.php"><button style="background: #bd8d54;border: 2px solid burlywood;padding: 5px 10px;font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;cursor: pointer;font-weight: bold;">SIGN UP</button></a>';
                echo '</div>';
            }
            ?>
          
            
        </div>    
        </div>


    <div class="product-container">
        <?php
            // Check if the 'id' parameter is present in the URL
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];
    
                // Connect to the MySQL database
                $conn = mysqli_connect("localhost", "root", "mysql", "client1");
    
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
    
                // Query to fetch product details based on the provided 'id'
                $sql = "SELECT * FROM products WHERE id = " . $product_id;
                $result = mysqli_query($conn, $sql);
    
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p>Description: ' . $row['description'] . '</p>';
                    echo '<p>Price: $' . $row['price'] . '</p>';
                    echo '<a href="cart.php" class="buy-button">Add To Cart</a>';
                } else {
                    echo "Product not found.";
                }
    
                // Close the MySQL connection
                mysqli_close($conn);
            } else {
                echo "Product ID not provided.";
            }
        ?>
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
            <a href="">CONTACT US</a>
            <a href="">ABOUT US</a>
            <a href="">FAQ</a>
            <a href="">ANY QUERY?</a>
        </div>
        
        
        
    </div>
    <div class="copy">
        <p>Copyright &copy; Team Flash</p>
    </div>
        
    
    <script>
        // JavaScript code to extract query parameters from the URL
        const urlParams = new URLSearchParams(window.location.search);

        // Extract the product details from the query parameters
        const productName = urlParams.get('name');
        const productDescription = urlParams.get('description');
        const productPrice = urlParams.get('price');
        const productImageSrc = urlParams.get('imageSrc');

        // Update the product information on the page
        document.getElementById('product-image-element').src = productImageSrc;
        document.getElementById('product-name').textContent = productName;
        document.getElementById('product-description-text').textContent = productDescription;
        document.getElementById('product-price').textContent = `Price: $${productPrice}`;
    </script>


</body>
</html>

