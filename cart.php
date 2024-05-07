<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    


    <style>


        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5dec4;
        }

        .container {
            /* max-width: 800px; */
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden;
        }

        .product img {
            float: left;
            margin-right: 10px;
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        .product-details {
            float: left;
            width: 60%;
        }

        
       

        .total {
            clear: both;
            text-align: right;
            margin-top: 10px;
            font-size: 18px;
        }

        .checkout-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            float: right;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }

        /* Update this CSS for the .product class */

.product {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
    overflow: hidden;
}

.product img {
    max-width: 100px;
    max-height: 100px;
    border-radius: 5px;
    margin-right: 10px;
}

.product-details {
    flex-grow: 1;
}

.quantity {
    width: 20%;
    text-align: center;
}
.quantity-btn{
    font-size: 15px;
    margin: 10px;
    
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
        <div class="searchbar">
            <form action="search.php" method="get">
    <input type="text" name="query" placeholder="What are you looking for?" required>
    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
        </div>
        <div class="usercart">

            <div class="cartsec" style="padding-top: 30px;">
                <a href="cart.html"><img src="images/cart.png" style="width:20px;height:20px;"></a>CART

            </div>

    
           
          
        
        </div>    
        </div>






        <?php
session_start();
if (isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}
function getProductDetails($product_id, $conn)
{
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function updateQuantity($product_id, $quantity)
{
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $conn = mysqli_connect("localhost", "root", "mysql", "client1");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $productDetails = getProductDetails($product_id, $conn);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }

        // Store cart item in the database
        $user_id = $_SESSION["user_id"];
        $quantity = $_SESSION['cart'][$product_id];

        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
        mysqli_query($conn, $sql);

        header('Location: cart.php');
        exit;
    } else {
        echo 'Invalid request.';
    }
} else {
    // Handle quantity updates
    if (isset($_POST['update_quantity'])) {
        $product_id = $_POST['product_id'];
        $new_quantity = $_POST['new_quantity'];
        updateQuantity($product_id, $new_quantity);
    }

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo '<h2>Your Cart Products</h2>';

        $conn = mysqli_connect("localhost", "root", "mysql", "client1");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $productDetails = getProductDetails($product_id, $conn);
        
            if ($productDetails) {
                echo '<div>';
                echo '<img src="' . $productDetails['image_url'] . '" alt="' . $productDetails['name'] . '" width="100" height="100">';
                echo '<h3>' . $productDetails['name'] . '</h3>';
        
                echo '<form method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
        
                // Add the Remove button
                echo '<button type="button" class="remove-btn" data-product-id="' . $product_id . '">Remove</button>';
        
                echo '<input type="hidden" name="update_quantity" value="1">';
                echo '<label for="new_quantity">Quantity:</label>';
                echo '<button type="button" class="quantity-btn" data-action="decrease">-</button>';
                echo '<span class="quantity">' . $quantity . '</span>';
                echo '<button type="button" class="quantity-btn" data-action="increase">+</button>';
                echo '</form>';
        
                echo '<p>Total Price: <span class="price" data-price="' . $productDetails['price'] . '">$' . ($productDetails['price'] * $quantity) . '</span></p>';
        
                echo '<hr>';
                echo '</div>';
            }
        }

        mysqli_close($conn);
    } else {
        echo 'Cart is empty.';
    }
}
?>





<div class="checkout-button" style="display:flex;justify-content:center;align-items:center;padding-bottom:10px;cursor: pointer;">
    <a href="checkout.php" style="padding: 7px 15px;background:#4CAF50;outline:none;border:none;color:white;cursor: pointer;text-decoration:none;">Proceed to Checkout</a>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Get all quantity buttons and attach click event listeners
        var quantityButtons = document.querySelectorAll('.quantity-btn');
        quantityButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var productId = this.parentNode.querySelector('[name="product_id"]').value;
                var quantityElement = this.parentNode.querySelector('.quantity');
                var priceElement = this.parentNode.nextElementSibling.querySelector('.price');
                var currentQuantity = parseInt(quantityElement.innerText);

                if (this.dataset.action === 'increase') {
                    currentQuantity++;
                } else if (this.dataset.action === 'decrease' && currentQuantity > 1) {
                    currentQuantity--;
                }

                // Update the displayed quantity
                quantityElement.innerText = currentQuantity;

                // Update the total price
                var productPrice = parseFloat(priceElement.dataset.price);
                var totalPrice = productPrice * currentQuantity;
                priceElement.innerText = '$' + totalPrice.toFixed(2);

                // Send an AJAX request to update the quantity on the server
                updateQuantity(productId, currentQuantity);
            });
        });

        // Get all remove buttons and attach click event listeners
        var removeButtons = document.querySelectorAll('.remove-btn');
        removeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var productId = this.dataset.productId;

                // Send an AJAX request to remove the item from the server
                removeItemFromCart(productId);

                // Remove the item from the UI
                this.parentNode.parentNode.remove();
            });
        });

        function updateQuantity(productId, newQuantity) {
            // Send an AJAX request to update the quantity on the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                }
            };
            xhr.send('update_quantity=1&product_id=' + productId + '&new_quantity=' + newQuantity);
        }

        function removeItemFromCart(productId) {
            // Send an AJAX request to remove the item from the server, unfortunately still isn't working
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                }
            };
            xhr.send('remove_item=1&product_id=' + productId);
        }
    });
</script>


    


</body>
</html>
