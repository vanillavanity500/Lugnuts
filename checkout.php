<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    

    <style>
        body{
           
            background-color: #f5dec4;
        }
        
        main {
            text-align: center;
            padding: 20px;
        }
        .checkout-form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px; 
            border: 1px solid #bd8d54;
            border-radius: 5px;
        }
        .checkout-form label {
            display: block;
            text-align: left;
            margin-top: 10px;
        }
        .checkout-form .form-group {
            display: flex;
            justify-content: space-between;
        }
        .checkout-form input {
            /* width: 46%; */
            padding: 7px 40px; 
            margin-top: 5px;
            border: 1px solid #bd8d54;
            border-radius: 5px;
        }
        .checkout-form .buttons {
            margin-top: 20px;
        }
        .checkout-form .buttons button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .checkout-form #buy-button {
            background-color: #bd8d54;
            color: #231915;
            color: white;
            font-weight: 700;
        }
        .checkout-form #cancel-button {
            background-color: #f94c4c;
            color: #fff;
            font-weight: 700;
        }

        .checkout-items {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.checkout-item {
    
    width: 200px; /* Adjust the width as needed */
    border: 1px solid #231915; /* Add a border for better separation */
    padding: 10px;
    box-sizing: border-box;
}

.checkout-item img {
    width: 30%;
    height: auto;
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

.copy p{
    text-align: center;
}

    </style>
</head>
<body>
<div class="header" style="background: #bd8d54;height: 14vh;display:flex;gap:300px;">
        <div class="logosec" style="margin: 10px;">
            <a href="index.php"><img src="images/logo.png" style="width:140px;height:60px;"></a>

        </div>
        <div class="searchbar" style="padding-top:25px;">
           <input type="text" name="search" placeholder="What are you looking for?" style="padding: 5px 40px;" ><i class="fa-solid fa-magnifying-glass" style="cursor: pointer;
    font-size: 20px;
    border: 1px solid rgba(0, 0, 0, 0.434);
    padding: 6px 10px;
    padding-top:2px;
    border-radius: 0px 4px 4px 0px;
    color: white;"></i>

        </div>
        <div class="usercart" style="display: flex;gap:20px;">

        <div class="cartsec" style="padding-top: 30px;">
                <a href="browse.php" style="text-decoration:none;color:white;">PRODUCTS</a>

            </div>

            <div class="cartsec" style="padding-top: 30px;">
                <a href="cart.php" style="text-decoration:none;color:white;">CART</a>

            </div>
              
</div>    
        </div>

        <?php
session_start();
function validateCreditCard($number) {
    $number = str_replace(' ', '', $number);
    $sum = 0;
    $flip = true;

    for ($i = strlen($number) - 1; $i >= 0; $i--) {
        $digit = (int)$number[$i];
        $digit = $flip ? $digit : $digit * 2;
        $digit = $digit > 9 ? $digit - 9 : $digit;
        $sum += $digit;
        $flip = !$flip;
    }

    return $sum % 10 === 0;
}
//Stle changes will be made here
echo '<h2>Checkout</h2>';

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "mysql", "client1");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo '<div class="checkout-items">';

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product details based on $product_id
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $productDetails = mysqli_fetch_assoc($result);

            echo '<div class="checkout-item">';
            echo '<img src="' . $productDetails['image_url'] . '" alt="' . $productDetails['name'] . '" width="100" height="100">';
            echo '<div class="product-details">';
            echo '<h3>' . $productDetails['name'] . '</h3>';
            echo '<p>Price: $' . $productDetails['price'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }

    echo '</div>';
    $totalPrice = 0;

    // Calculate total price
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $productDetails = mysqli_fetch_assoc($result);
            $totalPrice += $productDetails['price'] * $quantity;
        }
    }

    // Shipping and tax
    $shippingFee = 15; // Shipping fee
    $taxRate = 0.575; // Tax rate

    $shippingFeeAmount = $totalPrice > 0 ? $shippingFee : 0;
    $taxAmount = $totalPrice * $taxRate;
    $totalAmount = $totalPrice + $shippingFeeAmount + $taxAmount;

    echo '<h3>Total Cost</h3>';
    echo '<p>Subtotal: $' . $totalPrice . '</p>';
    echo '<p>Shipping Fee: $' . $shippingFeeAmount . '</p>';
    echo '<p>Tax: $' . $taxAmount . '</p>';
    echo '<p>Total: $' . $totalAmount . '</p>';

    // Close the MySQL connection
    mysqli_close($conn);
} else {
    echo 'Your cart is empty.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button was clicked
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'buy') {
        // Process the buy button
        // Validate credit card and perform additional processing
        $creditCardNumber = $_POST['card-number'];
        if (validateCreditCard($creditCardNumber)) {
            // Credit card is valid, perform additional processing if needed
            echo '<p>Thank you for your order! We will send your shipping details shortly.</p>';
            // Clear the cart 
            $_SESSION['cart'] = array();
        } else {
            echo '<p>Invalid credit card. Please check your card details and try again.</p>';
        }
    }

    if ($action === 'cancel') {
        // Process the cancel button
        // Clear the cart and redirect to the cart page
        $_SESSION['cart'] = array();
        header('Location: cart.php');
        exit();
    }
}
?>
     

<main>
        <h2>Checkout</h2>
        <form class="checkout-form" method = "POST">
            <div class="form-group">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div>
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div>
                    <label for="zip">ZIP Code</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" required>
                </div>
                <div>
                    <label for="state">country</label>
                    <input type="text" id="country" name="country" required>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card-number" required>
                </div>
                <div>
                    <label for="security-code">Security Code</label>
                    <input type="text" id="security-code" name="security-code" required>
                </div>
                <div>
                <label for="expiration-date">Expiration Date (MM/YY)</label>
                <input type="text" id="expiration-date" name="expiration-date" pattern="^(0[1-9]|1[0-2])\/\d{2}$" placeholder="MM/YY" required>
                </div>
            </div>
            <div class="buttons">
            <button type="submit" id="buy-button" name="action" value="buy">Buy Now</button>
            <button type="submit" id="cancel-button" name="action" value="cancel" formnovalidate>Cancel</button>
            </div>
        </form>
    </main>
   
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
