<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    
    <link rel="stylesheet" type="text/css" href="browser.css">
   
    
   
   
   
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
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

.hero{
    height: 140vh;
    
}
.hero .sidebar{
    display: flex;
    justify-content: space-around;
    align-items: center;
    background-color: rgba(245, 245, 245, 0.859);
}
.hero .sidebar .filter-options{
    display: flex;
    gap: 10px;
}
select{
    padding: 6px 40px;
    border-radius: 5px;
}
.showmore button{
    padding: 7px 10px;
    border: 2px solid #bd8d54;
    cursor: pointer;
    font-weight: 600;
}
.showmore button:hover{
    box-shadow: 0px 0px 5px #bd8d54;
}
.products{
    /* height: 100%; */
    /* background: red; */
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 10px;
    gap: 20px;
}
.products .p{
    height: 60vh;
    width: 100%;
    background-color: #d39e5e;
    color: whitesmoke;
    border-radius: 4px 4px 0px 0px;
}
.products .p .productimg{
    width: 100%;
    height: 34vh;
    /* background-color: black; */
}
.products .p .productimg img{
    width: 100%;
    height: 100%;
    border-radius: 4px 4px 0px 0px;
}
.products .p .productdetail .price{
    /* background-color: aliceblue; */
    /* width: 100%; */
    /* height: 40%; */
    
}
.products .p .productdetail .buybtn{
    display: flex;
    justify-content: center;
    
} 
.products .p .productdetail .buybtn button{
    padding: 5px 10px;
    background: orange;
    box-shadow: 2px 2px black;
    cursor: pointer;
    border: none;
    font-weight: 700;
}
.products .p .productdetail .buybtn button:hover{
    box-shadow: 0px 0px 5px black;
}
.products .p .productdetail .buybtn i{
    border: none;
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

    
    <div class="hero">
        <div class="sidebar">
            <div class="filtre">
            <h2>Filter Options</h2>
            </div>
            <div class="filter-options" >
                <div class="bybrand">
                
        <label>By Brand</label>
    <select name="brand">
        <option>Choose One...</option>
        <option>Brand 1</option>
        <option>Brand 2</option>
        <option>Brand 3</option>
        
    </select>
</div>
<div class="bydate">
    <label>By Date</label>
    <select name="date">
        <option>Choose One...</option>
        <option>Last Week</option>
        <option>Last Month</option>
        <option>Last Year</option>
        
    </select>
</div>
                
            </div>
            <div class="showmore">
                <button>SHOW MORE</button>
            </div>
        </div>


<ul>
    <?php
        // Connect to the MySQL database
        $conn = mysqli_connect("localhost", "root", "mysql", "client1");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to fetch products from the database
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li>';
                echo '<a href="product.php?id=' . $row['id'] . '">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" width="100" height="100">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '</a>';
                echo '<form action="cart.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                echo '<input type="submit" value="ADD TO CART">';
                echo '</form>';
                echo '</li>';
            }
        } else {
            echo "No products available.";
        }

        // Close the MySQL connection
        mysqli_close($conn);
    ?>
</ul>



     

    <div class="footer">
        <div class="icon">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="footercontent">
            <a href="contact.html">CONTACT US</a>
            <a href="about.html">ABOUT US</a>
            <a href="faq.html">FAQ</a>
            
        </div>
        
        
        
    </div>
    <div class="copy">
        <p>Copyright &copy; Team Flash</p>
    </div>
        
   

    

</body>
</html>
