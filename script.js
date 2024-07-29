document.addEventListener("DOMContentLoaded", function() {
    // Example: Add event listener to a button
    const checkoutButton = document.getElementById('checkout-button');
    
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function() {
            alert('Proceeding to checkout!');
        });
    }
});