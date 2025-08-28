jQuery(document).ready(function ($) {
    $(document.body).on("click", 'button[name="apply_coupon"]', function (e) {
        e.preventDefault();

        var $form = $(this).closest("form");
        var $couponCode = $("#coupon_code");
        var $responseDiv = $("#coupon-response");
        var $button = $(this);
        var couponCode = $couponCode.val().trim();

        // Clear previous messages
        $responseDiv.hide().html("");
        $(".woocommerce-message, .woocommerce-error, .woocommerce-info").remove();

        if (!couponCode) {
            $responseDiv
                .html('<div class="woocommerce-error">Please enter a coupon code.</div>')
                .fadeIn();
            return;
        }

        // Show loading state
        $button.prop("disabled", true).text("Applying...");

        // Get nonce - try multiple sources
        var nonce = "";
        if (
            typeof wc_cart_fragments_params !== "undefined" &&
            wc_cart_fragments_params.apply_coupon_nonce
        ) {
            nonce = wc_cart_fragments_params.apply_coupon_nonce;
        } else if (typeof coupon_ajax_object !== "undefined") {
            nonce = coupon_ajax_object.nonce;
        } else {
            // Try to get from existing cart form nonce
            var cartNonce =
                $('input[name="woocommerce-cart-nonce"]').val() ||
                $('input[name="_wpnonce"]').val() ||
                $('[name*="nonce"]').first().val();
            if (cartNonce) {
                nonce = cartNonce;
            }
        }

        // Get AJAX URL
        var ajaxUrl = "";
        if (typeof wc_cart_fragments_params !== "undefined" && wc_cart_fragments_params.ajax_url) {
            ajaxUrl = wc_cart_fragments_params.ajax_url;
        } else if (typeof coupon_ajax_object !== "undefined") {
            ajaxUrl = coupon_ajax_object.ajax_url;
        } else if (typeof wc_checkout_params !== "undefined") {
            ajaxUrl = wc_checkout_params.ajax_url;
        } else {
            ajaxUrl = "/wp-admin/admin-ajax.php"; // fallback
        }

        console.log("Using nonce:", nonce);
        console.log("Using AJAX URL:", ajaxUrl);

        $.ajax({
            type: "POST",
            url: ajaxUrl,
            data: {
                action: "apply_coupon_code",
                security: nonce,
                coupon_code: couponCode,
            },
            success: function (response) {
                console.log("AJAX Response:", response);

                if (response.success) {
                    // Success message
                    var message =
                        response.data.message || response.data || "Coupon applied successfully!";
                    var successHtml =
                        '<div class="woocommerce-message" role="alert">' + message + "</div>";

                    // Add success message
                    if ($responseDiv.length) {
                        $responseDiv.html(successHtml).fadeIn();
                    } else {
                        $couponCode.closest(".coupon, .form-row").after(successHtml);
                    }

                    // Update cart totals and fragments
                    if (typeof response.data === "object" && response.data.cart_total) {
                        // Update specific elements if data is provided
                        $(".cart-subtotal .amount, .order-total .amount").html(
                            response.data.cart_total
                        );
                        if (response.data.discount_total) {
                            $(".cart-discount").html(response.data.discount_total);
                        }
                    }

                    // Trigger WooCommerce updates
                    $(document.body).trigger("wc_fragment_refresh");
                    $(document.body).trigger("update_checkout");
                    $(document.body).trigger("wc_update_cart");

                    // Clear coupon input
                    $couponCode.val("");
                } else {
                    // Error message
                    var errorMessage = response.data || "Failed to apply coupon. Please try again.";
                    var errorHtml =
                        '<div class="woocommerce-error" role="alert">' + errorMessage + "</div>";

                    if ($responseDiv.length) {
                        $responseDiv.html(errorHtml).fadeIn();
                    } else {
                        $couponCode.closest(".coupon, .form-row").after(errorHtml);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
                console.log("XHR:", xhr);

                var errorHtml =
                    '<div class="woocommerce-error">Network error. Please check your connection and try again.</div>';

                if ($responseDiv.length) {
                    $responseDiv.html(errorHtml).fadeIn();
                } else {
                    $couponCode.closest(".coupon, .form-row").after(errorHtml);
                }
            },
            complete: function () {
                // Reset button state
                $button.prop("disabled", false).text("Apply Coupon");

                // Auto-hide messages after 5 seconds
                setTimeout(function () {
                    $(".woocommerce-message, .woocommerce-error, .woocommerce-info").fadeOut();
                }, 5000);
            },
        });
    });

    // Optional: Handle Enter key in coupon input
    $(document.body).on("keypress", "#coupon_code", function (e) {
        if (e.which === 13) {
            // Enter key
            e.preventDefault();
            $('button[name="apply_coupon"]').trigger("click");
        }
    });
});
