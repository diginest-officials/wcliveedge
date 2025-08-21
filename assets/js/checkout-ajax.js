jQuery(document).ready(function ($) {
    $(document.body).on("click", 'button[name="apply_coupon"]', function (e) {
        e.preventDefault();

        var $form = $(this).closest("form");
        var $couponCode = $("#coupon_code");
        var $responseDiv = $("#coupon-response");
        var $button = $(this);
        var couponCode = $couponCode.val();

        // Clear previous messages
        $responseDiv.hide().html("");

        if (!couponCode) {
            $responseDiv
                .html('<div class="woocommerce-error">Please enter a coupon code.</div>')
                .fadeIn();
            return;
        }

        $button.prop("disabled", true).text("Apply");

        $.ajax({
            type: "POST",
            url: wc_cart_fragments_params.ajax_url,
            data: {
                action: "apply_coupon_code",
                security: wc_cart_fragments_params.apply_coupon_nonce,
                coupon_code: couponCode,
            },
            success: function (response) {
                if (response.success) {
                    $couponCode.closest(".coupon").find(".woocommerce-message").remove(); // Remove any previous messages
                    $couponCode
                        .closest(".coupon")
                        .append('<div class="woocommerce-message">' + response.data + "</div>")
                        .fadeIn();
                    // Trigger cart update
                    $(document.body).trigger("wc_fragment_refresh");
                    $(document.body).trigger("update_checkout");
                } else {
                    $responseDiv
                        .html('<div class="woocommerce-info">' + response.data + "</div>")
                        .fadeIn();
                }
            },
            error: function () {
                $responseDiv
                    .html(
                        '<div class="woocommerce-error">Error applying coupon. Please try again.</div>'
                    )
                    .fadeIn();
            },
            complete: function () {
                $button.prop("disabled", false).text("Apply");
                $couponCode.val("");
            },
        });
    });
});
