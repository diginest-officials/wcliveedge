jQuery(document).ready(function ($) {
    $(".add-to-cart-btn").on("click", function (e) {
        e.preventDefault();

        let productID = $(this).data("product-id");

        $.ajax({
            type: "POST",
            url: ajax_cart.ajaxurl,
            data: {
                action: "search_ajax_add_to_cart",
                product_id: productID,
                security: ajax_cart.nonce,
            },
            beforeSend: function () {
                // Optional: Add a loading spinner or change button text
            },
            success: function (response) {
                if (response.success) {
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            },
        });
    });
});
