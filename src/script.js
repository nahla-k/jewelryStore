// Function to handle the add to cart action
function addToCart(product) {
    // Show the modal when a product is added to the cart
    const modal = document.getElementById("confirmationModal");
    modal.style.display = "flex";
    
    // Hide the modal after 3 seconds
    setTimeout(() => {
      modal.style.display = "none";
    }, 3000);
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    // Get the modal and close button
    const modal = document.getElementById("confirmationModal");
    const closeModal = document.getElementById("closeModal");

    // Add event listener to all "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.addToCartButton');
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Get product details from the button attributes
        const productName = button.getAttribute('data-name');
        const productPrice = button.getAttribute('data-price');

        // Display the modal
        modal.style.display = "flex";

        // Optionally, use AJAX to add the product to the cart here

        // Hide the modal after 3 seconds
        setTimeout(() => {
          modal.style.display = "none";
        }, 3000);
      });
    });

    // Close the modal when the user clicks on the close button
    closeModal.addEventListener("click", function() {
      modal.style.display = "none";
    });

    // Close the modal if the user clicks outside of it
    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };
  });