<?php
// Check if the product_id and action are set in the POST request
if (isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    // Start the session
    session_start();

    // Update the quantity based on the action (increase or decrease)
    if ($action === 'increase') {
        $_SESSION['cart'][$product_id]++;
    } elseif ($action === 'decrease') {
        if ($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        }
    }

    // Send the updated cart information back to the client
    echo json_encode($_SESSION['cart']);
} else {
    // If product_id or action is not set, return an error
    echo json_encode(['error' => 'Invalid request']);
}
?>
