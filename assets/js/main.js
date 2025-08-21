jQuery(document).ready(function ($) {
    // toggle cart
    function toggleCartClass() {
        if ($(window).width() < 992) {
            $("#cart-toggle").removeClass("show");
        } else {
            $("#cart-toggle").addClass("show");
        }
    }

    $(window).resize(function () {
        toggleCartClass();
    });

    $("body").on("click", "table.cart .quantity", function () {
        var itemQtyInitial;

        jQuery(".woocommerce table.cart tr.cart_item .product-quantity").hover(
            function () {
                itemQtyInitial = jQuery(".qty", this).val();
            },
            function () {
                var itemQtyExit = jQuery(".qty", this).val();
                if (itemQtyInitial != itemQtyExit) {
                    jQuery(".button[name='update_cart']").trigger("click");
                }
            }
        );
    });

    $(".quantity-wrapper").each(function () {
        var wrapper = $(this);
        var input = wrapper.find(".qty"); // WooCommerce quantity input

        wrapper.find(".cursor-pointer").on("click", function () {
            var currentVal = parseInt(input.val(), 10);
            var max = parseInt(input.attr("max")) || 9999; // WooCommerce max quantity
            var min = parseInt(input.attr("min")) || 1; // WooCommerce min quantity

            if ($(this).hasClass("plus")) {
                if (currentVal < max) {
                    input.val(currentVal + 1).trigger("change");
                }
            } else {
                if (currentVal > min) {
                    input.val(currentVal - 1).trigger("change");
                }
            }
        });
    });

    $("#searchbar-close").on("click", function () {
        let searchbar = new bootstrap.Collapse($("#searchbar"), { toggle: false });
        searchbar.hide();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const swiperBanner = new Swiper(".swiper-feature", {
        loop: true,
        spaceBetween: 10,
        autoplay: {
            delay: 2600,
        },
        pagination: {
            el: ".feature-pagination",
            clickable: true,
        },
        on: {
            init: function () {
                const bullets = document.querySelectorAll(".swiper-pagination-bullet");
                bullets.forEach((bullet) => {
                    bullet.classList.remove("swiper-pagination-bullet-active");
                });
            },
        },
    });

    const swiperFocus = new Swiper(".swiper-focus", {
        slidesPerView: 1.2,
        spaceBetween: 26,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 2600,
        },
        navigation: {
            nextEl: ".focus-next",
            prevEl: ".focus-prev",
        },
        breakpoints: {
            430: {
                spaceBetween: 35,
            },
            576: {
                slidesPerView: 1.7,
                spaceBetween: 60,
            },
            992: {
                slidesPerView: 1.5,
                spaceBetween: 90,
            },
            1400: {
                slidesPerView: 1.9,
                spaceBetween: 90,
            },
        },
    });

    const swiperGallery = new Swiper(".swiper-gallery", {
        slidesPerView: "auto",
        spaceBetween: 12,
        cssWidthProperty: true,
        centeredSlides: false,
        breakpoints: {
            1200: {
                slidesPerView: 5.6,
                spaceBetween: 12,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 12,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 12,
            },
            576: {
                slidesPerView: 3.5,
                spaceBetween: 12,
            },
        },
    });

    const swiperProduct = new Swiper(".swiper-product", {
        slidesPerView: 1,
        spaceBetween: 20,
        thumbs: {
            swiper: swiperGallery,
        },
    });

    const swiperCategory = new Swiper(".swiper-category", {
        slidesPerView: "auto",
        spaceBetween: 28,
        loop: false,
        cssWidthProperty: true,
        freeMode: true,
        scrollbar: {
            el: ".archive-scrollbar",
            hide: false,
            draggable: true,
        },
    });
    const swiperCategory2 = new Swiper(".swiper-category-2", {
        slidesPerView: "auto",
        spaceBetween: 28,
        loop: false,
        cssWidthProperty: true,
        freeMode: true,
        scrollbar: {
            el: ".archive-scrollbar-2",
            hide: false,
            draggable: true,
        },
    });

    // Remove default text of shipping in checkout
    const container = document.querySelector(".custom-woocommerce-shipping-selection");
    if (container) {
        container.childNodes.forEach((node) => {
            if (node.nodeType === Node.TEXT_NODE && node.textContent.trim() === "Shipping") {
                node.remove();
            }
        });
    }

    // Display one tab at a time
    function initializeTabs(tabSelector, contentSelector) {
        const tabs = document.querySelectorAll(tabSelector);
        const contentSections = document.querySelectorAll(contentSelector);

        tabs.forEach((tab, index) => {
            tab.addEventListener("click", () => {
                // Remove active class from all elements in this section
                tabs.forEach((t) => t.classList.remove("active"));
                contentSections.forEach((section) => section.classList.remove("active"));

                // Add active class to selected tab and its content
                tab.classList.add("active");
                contentSections[index].classList.add("active");
            });
        });
    }

    // Initialize tabs for each section
    initializeTabs("#material-tab", "#material-collection");
    initializeTabs("#variation-tab", "#variation-collection");
    initializeTabs("#finish-tab", "#finish-collection");
    initializeTabs("#table-tab", "#table-collection");
    initializeTabs("#table-tab", "#table-collection2");
    initializeTabs("#table-tab", "#table-collection3");
});

document.addEventListener("DOMContentLoaded", function () {
    const orderby = document.querySelector(".woocommerce-ordering .orderby");

    if (orderby) {
        orderby.addEventListener("change", function () {
            this.form.submit(); // Automatically submits on selection change
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const quickViewButtons = document.querySelectorAll('.quick-view-button');
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            fetchProductData(productId);
        });
    });

    function fetchProductData(productId) {
        fetch(`${window.wpAjax.ajax_url}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'fetch_product_data',
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(product => {
            const quickViewModalLabel = document.getElementById('quickViewModalLabel');
            quickViewModalLabel.innerHTML = `<a href="/products/${product.data.slug}" target="_self">${product.data.name}</a>`;

            const quickViewDescription = document.getElementById('quickViewDescription');
            const formattedDescription = product.data.description.replace(/<\/?p>/g, ' ');
            if (formattedDescription.trim() !== '') {
                quickViewDescription.innerHTML = formattedDescription;
            } else {
                quickViewDescription.style.display = 'none';
            }

            // const price = product.data.price;
            // if (price.trim() !== '') {
            //     document.getElementById('quickViewPrice').textContent = `$${Number(product.data.price).toLocaleString()}`;
            // } else {
            //     document.getElementById('quickViewPrice').style.display = 'none';
            // }

            const imagesContainer = document.getElementById('quickViewImages');
            imagesContainer.innerHTML = '';

            const uniqueImages = new Set();
            product.data.images.forEach(image => {
                if (!uniqueImages.has(image.src) && image.src !== 'https://wcliveedge.com/wp-content/uploads/2025/01/Office_03b-1-e1739914689160.jpg') {
                    uniqueImages.add(image.src);
                    const slide = document.createElement('div');
                    slide.classList.add('swiper-slide', 'rounded-md');
                    slide.innerHTML = `<img src="${image.src}" alt="Product" class="rounded-md mw-100 object-fit-contain"/>`;
                    imagesContainer.appendChild(slide);
                }
            });

            if (typeof Swiper !== 'undefined') {
                if (window.productSwiper) {
                    window.productSwiper.destroy();
                }
                window.productSwiper = new Swiper('.swiper-product', {
                    pagination: {
                        el: ".swiper-pagination",
                        dynamicBullets: true,
                    },
                    slidesPerView: 1
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});
