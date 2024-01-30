
    function updateQuantity(product_id, action) {
        // AJAX request to update the quantity on the server
        fetch('update_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + product_id + '&action=' + action,
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response data as needed
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    
    }



