<?php
// Check if the form is submitted
if (isset($_POST['signup'])) {
    // Retrieve user input
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "mysql", "client1");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert user data into the 'user_accounts' table
    $sql = "INSERT INTO user_accounts (username, password, email) VALUES ('$username', '$password', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User registered successfully. Redirecting to login page.'); window.location.href='login.php';</script>";
    } else {
        if (mysqli_errno($conn) == 1062) { // 1062 is the MySQL error code for duplicate entry
            echo "<script>alert('Username or email already exists. Please choose a different one.'); window.location='account.html';</script>";
            exit();       
        } else {     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    // Close the database connection
    mysqli_close($conn);
}
?>
