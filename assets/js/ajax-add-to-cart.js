jQuery(document).ready(function ($) {
    $(".add-to-cart-ajax").on("click", function (e) {
        e.preventDefault();

        var button = $(this);
        var product_id = button.data("product_id");
        var product_sku = button.data("product_sku");
        var quantity = button.data("quantity");
        var responseDiv = button.closest(".d-flex").find("#add-response");

        $.ajax({
            type: "POST",
            url: ajax_cart.ajaxurl,
            data: {
                action: "ajax_add_to_cart",
                product_id: product_id,
                product_sku: product_sku,
                quantity: quantity,
                nonce: ajax_cart.nonce,
            },
            beforeSend: function () {
                button.addClass("loading");
                responseDiv.text("Adding...");
            },
            success: function (response) {
                if (response.success) {
                    button.removeClass("loading").addClass("added");
                    responseDiv.text("Added!");

                    // Refresh cart and session
                    $(document.body).trigger("wc_fragment_refresh");
                    $(document.body).trigger("added_to_cart", [
                        response.cart_count,
                        response.cart_total,
                    ]);
                } else {
                    console.log("Error:", response.data);
                }
            },
        });
    });

    $(".ajax_add_to_cart").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        var product_id = form.data("product_id");
        var quantity = form.find("input.qty").val();
        var addToCartBtn = form.find(".single_add_to_cart_button");

        addToCartBtn.prop("disabled", true).text("Adding...");

        $.ajax({
            type: "POST",
            url: ajax_cart.ajaxurl,
            data: {
                action: "custom_ajax_add_to_cart",
                product_id: product_id,
                quantity: quantity,
            },
            success: function (response) {
                if (response.success) {
                    addToCartBtn.text("Added").addClass("added");

                    // Update mini cart (if using a cart fragment)
                    $(document.body).trigger("wc_fragment_refresh");

                    // Redirect to cart page dynamically
                    setTimeout(function () {
                        window.location.href = response.data.cart_url;
                    }, 1000);
                } else {
                    addToCartBtn.text("Failed");
                    setTimeout(function () {
                        addToCartBtn.text("Add to Cart");
                    }, 2000);
                }
            },
            complete: function () {
                addToCartBtn.prop("disabled", false);
            },
        });
    });

    // Search AJAX
    $("#site-search").on("keyup", function () {
        let query = $(this).val();
        if (query.length < 2) {
            $("#search-results").html("");
            return;
        }

        $.ajax({
            url: ajax_cart.ajaxurl,
            type: "POST",
            data: {
                action: "wc_ajax_search",
                keyword: query,
            },
            beforeSend: function () {
                $("#search-results").html('<p class="text-white">Searching...</p>');
            },
            success: function (response) {
                $("#search-results").html(response);
            },
            error: function () {
                $("#search-results").html('<p class="text-danger">No results found.</p>');
            },
        });
    });

    // Search AJAX
    $("#site-search-2").on("keyup", function () {
        let query = $(this).val();
        if (query.length < 2) {
            $("#search-results-2").html("");
            return;
        }

        $.ajax({
            url: ajax_cart.ajaxurl,
            type: "POST",
            data: {
                action: "wc_ajax_search_mobile",
                keyword: query,
            },
            beforeSend: function () {
                $("#search-results-2").html('<p class="text-white">Searching...</p>');
            },
            success: function (response) {
                $("#search-results-2").html(response);
            },
            error: function () {
                $("#search-results-2").html('<p class="text-danger">No results found.</p>');
            },
        });
    });
});
