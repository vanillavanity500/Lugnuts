<?php
session_start();

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "mysql", "client1");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch user details from the database based on the provided username
    $sql = "SELECT * FROM user_accounts WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables and redirect to a dashboard or home page
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php'); // Redirect to your dashboard or home page
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "User not found. Please check your username.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
