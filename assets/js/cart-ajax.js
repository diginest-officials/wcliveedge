jQuery(document).ready(function ($) {
    $(".plus, .minus").click(function () {
        var $parent = $(this).closest(".cart-loader");
        var $qty = $parent.find(".qty");
        var cartKey = $parent.data("cart_item_key");
        var currentVal = parseInt($qty.val());
        var newQty = currentVal;
        var $loader = $parent.find(".loader");
        var $subtotal = $parent.find(".product-subtotal");

        if ($(this).hasClass("plus")) {
            newQty += 1;
        } else if ($(this).hasClass("minus") && currentVal > 1) {
            newQty -= 1;
        }

        $qty.val(newQty);
        $loader.show(); // Show loader

        updateCart(cartKey, newQty, $subtotal, $loader);
    });

    function updateCart(cartKey, quantity, $subtotal, $loader) {
        $.ajax({
            type: "POST",
            url: wc_cart_params.ajax_url,
            data: {
                action: "update_cart_item",
                cart_key: cartKey,
                quantity: quantity,
            },
            success: function (response) {
                if (response.success) {
                    // Update subtotal for the cart item
                    $subtotal.html(response.data.item_total);

                    // Update total excluding tax, tax total, and grand total
                    $(".cart-subtotal").html(response.data.cart_subtotal);
                    $(".cart-total").html(response.data.cart_total);
                    $(".tax-total h5").html(response.data.tax_total);
                }

                $loader.hide(); // Hide loader
            },
            error: function () {
                $loader.hide();
                alert("Something went wrong. Please try again.");
            },
        });
    }
});

// Header items Update
jQuery(document).ready(function ($) {
    function updateCartCount() {
        $.ajax({
            type: "POST",
            url: wc_cart_params.ajax_url,
            data: { action: "get_cart_count" },
            success: function (response) {
                if (response.success) {
                    $(".cart-count").text(response.data.count); // Update count in UI
                }
            },
        });
    }

    $(document).on("click", ".add_to_cart_button, .plus, .minus, .remove", function () {
        setTimeout(updateCartCount, 1000); // Delay to ensure the cart updates
    });
});
