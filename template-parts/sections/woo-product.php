<!-- Breadcrumbs -->
<section class="sec-spacing-md pb-5">
    <div class="container">
        <p class="opacity-85">Shop / Office Desk / <?php the_title(); ?></p>
    </div>
</section>

<!-- Product -->
<section class="pb-5 pt-0">
    <div class="container">
        <div class="row row-gap-5">
            <div class="col-lg-7 col-12">
                <div class="swiper-product swiper">
                    <div class="swiper-wrapper">
                        <?php $gallery_image_ids = $product->get_gallery_image_ids();

                        if ( !empty( $gallery_image_ids ) ) :
                            foreach ($gallery_image_ids as $image_id) : 
                                if ($image_id): ?>
                                    <div class="swiper-slide">
                                        <img
                                            src="<?php echo wp_get_attachment_url($image_id); ?>"
                                            alt="Product"
                                            class="rounded-md height-lg-470 height-390 w-100 object-fit-cover"
                                        />
                                    </div>
                                <?php endif;
                            endforeach; 
                        endif; ?>
                    </div>
                </div>

                <div class="swiper-gallery swiper mt-3">
                    <div class="swiper-wrapper">
                            <?php $gallery_image_ids = $product->get_gallery_image_ids();

                            if ( !empty( $gallery_image_ids ) ) :
                                foreach ($gallery_image_ids as $image_id) : 
                                    if ($image_id): ?>
                                        <div class="swiper-slide rounded-md overflow-hidden position-relative" >
                                            <img
                                                src="<?php echo wp_get_attachment_url($image_id); ?>"
                                                alt="Product"
                                                class="height-110 w-100 object-fit-cover"
                                            />
                                        </div>
                                    <?php endif;
                                endforeach; 
                            endif; ?>
                    </div>
                </div>

                <p class="size-18 mt-5 d-none d-lg-block">
                    Inspired by the majesty of Helmcken Falls, this handcrafted desk is
                    built from a sustainably sourced live-edge maple slab. The wood
                    flows gracefully over its edge to form a sturdy base, reminiscent of
                    water cascading over rugged cliffs. A custom blue epoxy inlay traces
                    a waterfall-like path across the surface, adding a modern accent
                    that complements the elegant maple grain. This seamless integration
                    of materials and fluid design creates a striking centerpiece that
                    brings organic beauty and modern sophistication to any workspace.
                </p>
            </div>
            <div class="col-lg-5 col-12 ps-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3 pb-1">
                    <h6 class="size-16 color-tag-1 rounded-pill py-2 px-3 width-fit">
                        In Stock
                    </h6>
                    <h6 class="size-16 color-tag-2 rounded-pill py-2 px-3 width-fit">
                        Made to order
                    </h6>
                </div>

                <h1 class="size-lg-40 size-32 fw-semibold mb-3 pb-1">
                    The Helmcken Desk
                </h1>

                <ul class="ps-4 lh-base mb-4">
                    <li class="size-16 opacity-85">
                        Waterfall-edge design inspired by the fluid motion of nature.
                    </li>
                    <li class="size-16 opacity-85">
                        Live-edge wood slab with a vivid blue epoxy inlay.
                    </li>
                    <li class="size-16 opacity-85">
                        Hand-finished with a durable lacquer for lasting beauty.
                    </li>
                </ul>

                <div class="mb-2">
                    <span class="size-24 fw-semibold">$6540</span>
                </div>

                <div class="mb-4">
                    <div class="py-4 border-bottom border-1">
                        <h3 class="size-18 fw-semibold mb-2">Wood Type</h3>
                        <p class="size-16 opacity-85">Maple</p>
                    </div>
                    <div class="py-4 border-bottom border-1">
                        <h3 class="size-18 fw-semibold mb-2">Wood Orgin</h3>
                        <p class="size-16 opacity-85">
                            Sustainably sourced from the Pacific Northwest, Canada.
                        </p>
                    </div>
                    <div class="py-4">
                        <h3 class="size-18 fw-semibold mb-2">Lacquer Color</h3>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <p
                                class="size-16 opacity-85 d-flex gap-2 align-items-center p-2 border border-1 rounded-2"
                            >
                                <span class="p-2 border border-1 d-block"></span>
                                Clear Glass Lacquer
                            </p>
                            <!-- <p
                                class="size-16 opacity-85 d-flex gap-2 align-items-center p-2 border border-1 rounded-2"
                            >
                                <span
                                    class="p-2 border border-1 d-block color-test"
                                ></span>
                                Peach Lacquer
                            </p> -->
                        </div>
                    </div>
                </div>

                <div class="pt-2 d-flex align-items-center gap-3 pb-2">
                    <div
                        class="d-flex align-items-center gap-3 py-2 px-4 border border-1 color-border-1 rounded-pill"
                    >
                        <span class="d-block size-18 color-1 fw-semibold">-</span>
                        <span class="d-block size-18 color-1 fw-semibold">1</span>
                        <span class="d-block size-18 color-1 fw-semibold">+</span>
                    </div>
                    <a
                        href="#"
                        class="text-decoration-none color-bg-1 text-white size-18 fw-semibold rounded-pill py-2 px-1 w-100 text-center"
                        >Add to Cart</a
                    >
                </div>

                <div class="mt-3">
                    <div
                        class="d-flex align-items-center gap-4 justify-content-between p-3 border border-1 color-border-1 rounded-3"
                    >
                        <div class="d-flex align-items-center gap-xxl-4 gap-3 p-1">
                            <img
                                src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-delivery.svg"
                                alt="Delivery icon"
                                class="icon-45"
                            />
                            <div class="">
                                <h6 class="fw-semibold size-18 mb-1">Delivery</h6>
                                <p class="size-16 opacity-85">
                                    Check Delivery Availability
                                </p>
                            </div>
                        </div>
                        <div class="p-1">
                            <img
                                src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                                alt="Arrow icon"
                                class="icon-24"
                            />
                        </div>
                    </div>

                    <div
                        class="d-flex align-items-center gap-4 justify-content-between p-3 border border-1 color-border-1 rounded-3 mt-3"
                    >
                        <div class="d-flex align-items-center gap-xxl-4 gap-3 p-1">
                            <img
                                src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-support.svg"
                                alt="Delivery icon"
                                class="icon-45"
                            />
                            <div class="">
                                <h6 class="fw-semibold size-18 mb-1">
                                    Request a Review
                                </h6>
                                <p class="size-16 opacity-85">
                                    Schedule a online or In Person review
                                </p>
                            </div>
                        </div>

                        <div class="p-1">
                            <img
                                src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                                alt="Arrow icon"
                                class="icon-24"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-3 sec-spacing-lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <h3 class="size-16 fw-semibold">Product ID</h3>
                    <p
                        class="size-16 py-2 px-3 text-white color-bg-1 opacity-75 rounded-pill"
                    >
                        OD001
                    </p>
                </div>

                <p class="size-20 fw-semibold mb-5">
                    Ideal for home offices, creative studios, or statement interiors.
                </p>

                <div class="d-flex flex-column gap-3 mb-5">
                    <button
                        class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
                    >
                        <h4 class="size-18 fw-semibold">Product Overview</h4>
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                            alt="Arrow icon"
                            class="icon-24"
                        />
                    </button>
                    <button
                        class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
                    >
                        <h4 class="size-18 fw-semibold">Measurements</h4>
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                            alt="Arrow icon"
                            class="icon-24"
                        />
                    </button>
                    <button
                        class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
                    >
                        <h4 class="size-18 fw-semibold">Lead Times</h4>
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                            alt="Arrow icon"
                            class="icon-24"
                        />
                    </button>
                    <button
                        class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
                    >
                        <h4 class="size-18 fw-semibold">Material and Care</h4>
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                            alt="Arrow icon"
                            class="icon-24"
                        />
                    </button>
                    <button
                        class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
                    >
                        <h4 class="size-18 fw-semibold">Safety and Compliance</h4>
                        <img
                            src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
                            alt="Arrow icon"
                            class="icon-24"
                        />
                    </button>
                </div>

                <div
                    class="mt-5 p-4 d-flex justify-content-between border border-1 color-bg-6 rounded-3"
                >
                    <div class="">
                        <h3 class="size-24 fw-semibold mb-2">Need Assistance?</h3>
                        <p class="size-16 opacity-75">
                            Our specialists can help you find and customize the perfect
                            item for your home
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Collection Section 2 - Content should change - Mobile scroll -->
<section class="sec-spacing-lg pt-0">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between pb-lg-5 pb-4">
            <h2
                class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320"
            >
                Relative Products
            </h2>
        </div>
        <div class="row flex-nowrap gap-lg-0 overflow-x-auto pb-4">
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-3.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-2.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-1.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Wood Slabs
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-2.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
        </div>
        <!-- <a
            href="#"
            class="size-18 text-decoration-none fw-semibold mt-5 text-center py-2 px-5 text-white border border-1 border-white rounded-pill btn-over-4 d-block d-lg-none"
            >View all</a
        > -->
    </div>
</section>

<?php $bottom_img = 'https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/product-1.webp';
if ($bottom_img) : ?>

    <section>
        <div class="container">
            <h2
                class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320 mb-lg-5 mb-4"
            >
                Shop the look
            </h2>
            <div class="position-relative">
                <img
                    src="<?php echo $bottom_img; ?>"
                    alt="Product Set"
                    class="img-fluid rounded-md height-660 object-fit-cover w-100"
                />
                <div
                    class="d-flex flex-column flex-lg-row align-items-lg-end gap-3 justify-content-between position-absolute start-0 bottom-0 w-100 z-2 swiper-disable p-lg-5 p-4 pt-0"
                >
                    <h3
                        class="size-24 size-lg-40 text-white width-max-lg-340 width-max-200"
                    >
                        Ocean Black and Wood Table
                    </h3>
                    <a
                        href="#"
                        class="text-decoration-none width-fit color-3 bg-white py-lg-2 py-1 px-lg-4 px-2 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold text-center"
                        >Order Now</a
                    >
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Collection Section 2 - Content should change - Mobile scroll -->
<section class="sec-spacing-lg">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between pb-lg-5 pb-4">
            <h2
                class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320"
            >
                More From Desk
            </h2>
        </div>
        <div class="row flex-nowrap gap-lg-0 overflow-x-auto pb-4">
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-3.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-2.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-1.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Wood Slabs
                    </h3>
                </a>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                <a href="#" class="text-decoration-none card-over w-100">
                    <div class="overflow-hidden rounded-md">
                        <img
                            src="images/collection-2.webp"
                            alt="Collection image"
                            class="height-280 object-fit-cover w-100"
                        />
                    </div>
                    <h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
                        Tables
                    </h3>
                </a>
            </div>
        </div>
        <!-- <a
            href="#"
            class="size-18 text-decoration-none fw-semibold mt-5 text-center py-2 px-5 text-white border border-1 border-white rounded-pill btn-over-4 d-block d-lg-none"
            >View all</a
        > -->
    </div>
</section>