<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php /* Custom Template */ ?>


			<pre><?php // print_r($product); ?></pre>

				<section class="pt-4 pb-5">
					<div class="container custom-breadcrumbs">
						<?php if (function_exists('woocommerce_breadcrumb')) woocommerce_breadcrumb(); ?>
					</div>
				</section>

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
															class="rounded-md height-lg-470 height-390 w-100 object-fit-contain"/>
													</div>
												<?php endif;
											endforeach; 
										else: ?>
											<div class="swiper-slide">
												<img
													src="<?php echo get_the_post_thumbnail_url(); ?>"
													alt="Product"
													class="rounded-md height-lg-470 height-390 w-100 object-fit-cover"/>
											</div>
										<?php endif; ?>
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
																class="height-110 w-100 object-fit-cover"/>
														</div>
													<?php endif;
												endforeach; 
											endif; ?>
									</div>
								</div>

								<?php $description = $product->description;

								if ( !empty( $description ) ) : ?>
								<p class="size-18 mt-5 d-none d-lg-block">
									<?= $description; ?>
								</p>
								<?php endif; ?>
							</div>
							
							<div class="col-lg-5 col-12 ps-lg-4">
								<?php $tags = get_field('tags');
								
								$stock = $tags['in_stock'];
								$order = $tags['made_to_order'];

								if ( !empty( $stock ) || !empty( $order ) ) : ?>
									<div class="d-flex align-items-center gap-3 mb-3 pb-1">
										<?php if ($product->is_in_stock() && $stock) : ?>
											<h6 class="size-16 color-tag-1 rounded-pill py-2 px-3 width-fit">
												In Stock
											</h6>
										<?php endif; 
										
										if ($order) : ?>
											<h6 class="size-16 color-tag-2 rounded-pill py-2 px-3 width-fit">
												<?= get_field('manufacturing_date') ?: 'Made to order'; ?> 
											</h6>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<h1 class="size-lg-40 size-32 fw-semibold mb-3 pb-1">
									<?php the_title(); ?>
								</h1>

								<?php $points = get_field('feature_points');

								if ( !empty( $points ) ) : ?>
									<ul class="ps-4 lh-base mb-4">
										<?php foreach ($points as $point) : 
											if ($point) : ?>
												<li class="size-16 opacity-85">
													<?= $point['point']; ?>
												</li>
											<?php endif;
										endforeach; ?>
									</ul>
								<?php endif; ?>

								<div class="mb-2">
									<?php $price = $product->get_regular_price();
									if ($price) : ?>
									<!-- <span class="size-24 fw-semibold"><?php echo '$' . number_format($product->get_regular_price(), 0); ?></span> -->
									<span>Inquire for pricing</span>
									<?php endif; ?>
								</div>

								<div class="mb-4">
									<?php $materials = get_field('materials'); ?>
									<div class="py-4 border-bottom border-1">
										<h3 class="size-18 fw-semibold mb-2">Category</h3>
										<!-- WP Parent Category -->
										<?php $terms = get_the_terms( $product->ID, 'product_cat' );
										$main_cat = $terms[0]->parent->name; ?>
										<p class="size-16 opacity-85"><?= $main_cat; ?></p>
									</div>
									
									<?php 
										$terms = get_the_terms( $product->ID, 'product_cat' );
										$cat = $terms[0]->name;
									?>
									<div class="py-4 border-bottom border-1">
										<h3 class="size-18 fw-semibold mb-2">Type</h3>
										<p class="size-16 opacity-85"><?= $cat; ?></p>
									</div>

									<?php $lacquer_color = $materials['lacquer']['color'];
									$lacquer_name = $materials['lacquer']['text'];

									if ($lacquer_name) : ?>
										<div class="py-4">
											<h3 class="size-18 fw-semibold mb-2">Epoxy Color</h3>
											<div class="d-flex align-items-center gap-3 flex-wrap">
												<p class="size-16 opacity-85 d-flex gap-2 align-items-center p-2 border border-1 rounded-2">
													<span class="p-2 border border-1 d-block" style="background-color: <?= $lacquer_color; ?>"></span>
													<?= $lacquer_name; ?>
												</p>
											</div>
										</div>
									<?php endif; ?>
								</div>

								<div class="pt-2 d-flex align-items-center gap-3 pb-2">
									<form class="ajax_add_to_cart cart d-flex align-items-center gap-3 w-100" method="post" enctype="multipart/form-data" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
										<div class="d-flex align-items-center border border-1 color-border-1 rounded-pill overflow-hidden quantity-wrapper">
											<span class="d-block size-20 color-1 fw-semibold py-2 pe-2 ps-4 cursor-pointer">-</span>
											<?php // WooCommerce Quantity Input
											woocommerce_quantity_input( array(
												'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
												'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
												'input_value' => 1, // Default value
											) ); ?>
											<span class="d-block size-20 color-1 fw-semibold py-2 ps-2 pe-4 cursor-pointer plus">+</span>
										</div>

										<button type="submit" class="single_add_to_cart_button button text-decoration-none color-bg-1 text-white size-18 fw-semibold rounded-pill p-3 w-100 text-center">
											<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
										</button>
									</form>
								</div>

								<?php $services = get_field('services');
								if ($services) :
									$service_link = "mailto:Faramarz@wcliveedge.com";
								?>
									<div class="mt-3 d-flex flex-column gap-3">
										<?php foreach ( $services as $service ) :
											if ( $service ) : ?>
												<a href="<?php echo $service_link; ?>" class="text-decoration-none" style="color: black;">
													<div class="d-flex align-items-center gap-4 justify-content-between p-3 border border-1 color-border-1 rounded-3">
														<div class="d-flex align-items-center gap-xxl-4 gap-3 p-1">
															<img
																src="<?= $service['icon']; ?>"
																alt="Contact icon"
																class="icon-45"/>

															<div class="">
																<h6 class="fw-semibold size-18 mb-1"><?= $service['title']; ?></h6>
																<p class="size-16 opacity-85">
																<?= $service['content']; ?>
																</p>
															</div>
														</div>
														<div class="p-1">
															<img
																src="https://wcliveedge.wpenginepowered.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
																alt="Arrow icon"
																class="icon-24"/>
														</div>
													</div>
												</a>
											<?php endif;
										endforeach; ?>
									</div>
								<?php endif; ?>
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
									<p class="size-16 py-2 px-3 text-white color-bg-1 opacity-75 rounded-pill">
										<?= $product->sku; ?>
									</p>
								</div>

								<?php $side_content = get_field('side_content');
								if ( $side_content['before_text'] ) : ?>
									<p class="size-20 fw-semibold mb-5"><?= $side_content['before_text']; ?></p>
								<?php endif; ?>

								<?php $contents = $side_content['contents']; 
								if ( !empty( $contents ) ) : ?>
									<div class="d-flex flex-column gap-3 mb-5">

										<?php foreach ( $contents as $i => $content ) :
											if ( $content ) :
												$button_text = $content['button_settings']['button'];
												$button_enable = $content['button_settings']['enable_button'];
											endif;

											if ( $button_enable ) : ?>
												<button
													class="btn d-flex align-items-center justify-content-between p-3 w-100 border border-1 rounded-2 key-over"
													data-bs-toggle="offcanvas"
													href="#<?= 'feature-' . $i; ?>"
													role="button"
													aria-controls="<?= 'feature-' . $i; ?>">

													<h4 class="size-18 fw-semibold"><?= $button_text; ?></h4>
													<img 
														src="https://wcliveedge.com/wp-content/uploads/2025/01/icon-arrow-right.svg"
														alt="Arrow icon"
														class="icon-24"/>
												</button>

												<div class="offcanvas offcanvas-end width-max-660 w-100"
													tabindex="-1"
													id="<?= 'feature-' . $i; ?>"
													aria-labelledby="<?= 'feature-' . $i; ?>-Label">
													<div class="p-lg-5 p-sm-4 p-0 overflow-y-auto">
														<div class="offcanvas-header">
															<h5
																class="fw-semibold size-24"
																id="product-features-Label">
																<?= $button_text ?: 'Overview'; ?>
															</h5>
															<button
																type="button"
																class="btn-close"
																data-bs-dismiss="offcanvas"
																aria-label="Close">
															</button>
														</div>
														<div class="offcanvas-body">
															<?php $first_text = $content['offcanvas']['first_text'];
															if ( $first_text ) :
																echo '<p class="size-18 mb-4">' . $first_text . '</p>';
															endif;

															$enable_sku = $content['offcanvas']['enable_sku'];
															if ( $enable_sku ) : ?>
																<div class="d-flex align-items-center gap-3 my-4">
																	<h3 class="size-16 fw-semibold">Product ID</h3>
																	<p class="size-16 py-2 px-3 text-white color-bg-1 opacity-75 rounded-pill">
																		<?= $product->sku; ?>
																	</p>
																</div>
															<?php endif; 

															$bold_line = $content['offcanvas']['bold_line'];
															if ( $bold_line ) : ?>
																<p class="size-20 fw-semibold mt-4">
																	<?= $bold_line; ?>
																</p>
															<?php endif; 
															
															$bullets = $content['offcanvas']['bullets'];
															if ( !empty( $bullets ) ) : ?>
																<ul class="list-style-none my-4">
																	<?php foreach ( $bullets as $bullet ) :
																		if ( $bullet ) : ?>
																			<li class="size-20 lh-lg"><span class="fw-semibold"><?= $bullet['title']; ?> </span><?= $bullet['point']; ?></li>
																		<?php endif;
																	endforeach; ?>
																</ul>
															<?php endif; 
															
															$editor = $content['editor'];

															if ( !empty( $editor ) ) : ?>
															<div class="mt-5 w-100 offcanvas-editor">
																<?= $editor; ?>
															</div>
															<?php endif; ?>

															<?php $accordion = $content['offcanvas_accordion'];
															if ( !empty( $accordion ) ) : ?>
																<div id="classic">
																	<?php $last = array_key_last( $accordion );
																	foreach (  $accordion as $i => $item ) :
																		if ( !empty( $item ) ) : ?>
																
																			<div class=" <?= $i == $last ? '' : 'border-bottom border-1'; ?>">
																				<button class="btn p-0 py-3 color-1 fw-medium size-22 border-0 w-100 faq-btn text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'classic-' . $i; ?>" aria-expanded="false" aria-controls="<?= 'classic-' . $i; ?>">
																					<span class="d-block"><?= $item['title']; ?></span>
																					<span class="classic-btn classic-size color-bg-1 rounded-circle d-block position-relative ms-4"></span>
																				</button>
																				<div id="<?= 'classic-' . $i; ?>" class="accordion-collapse collapse">
																					<div class="accordion-body pt-1 pb-4 offcanvas-editor">
																						<?= $item['editor']; ?>
																					</div>
																				</div>
																			</div>
																			
																		<?php endif;
																	endforeach; ?>
																</div>
															<?php endif; ?>
														</div>
													</div>
												</div>

											<?php endif;
										endforeach; ?>
									</div>
								<?php endif; ?>

								<?php $support = get_field('support');
								if ( !empty( $support ) ) : ?>
									<div class="mt-5 p-4 d-flex justify-content-between flex-sm-row flex-column row-gap-4 border border-1 color-bg-6 rounded-3">
										<div class="width-max-250">
											<?php $title = $support['title'];
											if ( $title ) :
												echo '<h3 class="size-24 fw-semibold mb-2">' . $title . '</h3>';
											endif;

											$content = $support['content'];
											if ( $content ) : 
												echo '<p class="size-16 opacity-75">' . $content . '</p>';
											endif; ?>
										</div>

										<?php $contact = $support['contact'];
										if ( !empty( $contact ) ) : ?>
											<div class="d-flex flex-column gap-3">
												<?php foreach ( $contact as $single ) :
													if ( $single ) : ?>
														<div>
															<h6 class="size-14 mb-2 fw-medium"><?= $single['label']; ?></h6>
															<a href="<?= $single['address']['url']; ?>" class="color-1 fw-semibold" target="<?= $single['address']['target']; ?>">
																<?= $single['address']['title']; ?>
															</a>
														</div>
													<?php endif; 
												endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>

				<?php global $product;

				if ($product) {
					$categories = wp_get_post_terms($product->get_id(), 'product_cat');

					$child_categories = array();
					$parent_categories = array();

					foreach ($categories as $category) {
						if ($category->parent != 0) {
							$child_categories[] = $category;
						} else {
							$parent_categories[] = $category;
						}
					}

					if (!empty($child_categories)) {
						foreach ($child_categories as $child):
							$c_args = array(
								'post_type'      => 'product',
								'posts_per_page' => 4,
								'orderby'        => 'rand',
								'post__not_in'   => array($product->get_id()),
								'tax_query'      => array(
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => $child->slug,
									),
								),
							);

							$c_query = new WP_Query($c_args);
							if ($c_query->have_posts()) : ?>
							<section class="sec-spacing-jy pt-0">
								<div class="container">
									<h2 class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320 mb-lg-5 mb-4">
										Related Products
									</h2>
									<div class="row flex-nowrap gap-lg-0 overflow-x-auto pb-4">
										<?php while ($c_query->have_posts()) : $c_query->the_post(); ?>
											<?php
											$product_id = get_the_ID();
											$related_product = wc_get_product($product_id);
											$image_url = get_the_post_thumbnail_url($product_id, 'large') ?: 'https://via.placeholder.com/300';
											$product_title = get_the_title();
											$product_link = get_permalink();
											?>
											<div class="col-xl-3 col-lg-4 col-sm-6 col-11">
												<a href="<?php echo esc_url($product_link); ?>" class="text-decoration-none card-over w-100">
													<div class="overflow-hidden rounded-md">
														<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product_title); ?>" class="height-280 object-fit-cover w-100"/>
													</div>
													<h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
														<?php echo esc_html($product_title); ?>
													</h3>
												</a>
											</div>
										<?php endwhile; ?>
									</div>
									<?php wp_reset_postdata(); ?>
								</div>
							</section>
							<?php endif; 
						endforeach;
					}
				} ?>

				<?php $product_set = get_field('product_set');
				if ( !empty( $product_set ) && !empty( $product_set['image'] ) ) : ?>
					<section>
						<div class="container">
							<h2 class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 width-max-mobile-320 mb-lg-5 mb-4">
								Shop the look
							</h2>
							<div class="position-relative">
								<img
									src="<?= $product_set['image']['url']; ?>"
									alt="<?= $product_set['image']['alt']; ?>"
									class="img-fluid rounded-md object-fit-cover w-100"/>

								<div class="d-flex flex-column flex-lg-row align-items-lg-end gap-3 justify-content-between position-absolute start-0 bottom-0 w-100 z-2 swiper-disable p-lg-5 p-4 pt-0">
									<?php $title = $product_set['title'];

									if ($title) : ?>
										<h3 class="size-24 size-lg-40 text-white width-max-lg-340 width-max-200">
											<?= $title; ?>
										</h3>
									<?php endif;

									$link = $product_set['link'];

									if ( !empty( $link ) ) : ?>
										<a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>"
											class="text-decoration-none width-fit color-3 bg-white py-lg-2 py-1 px-lg-4 px-2 border border-1 border-white rounded-pill btn-over-3 size-18 fw-semibold text-center">
											<?= $link['title']; ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</section>
				<?php endif; ?>

				<?php
				if ($product) {
					if (!empty($parent_categories)) {
						foreach ($parent_categories as $parent):
							$p_args = array(
								'post_type'      => 'product',
								'posts_per_page' => 4,
								'orderby'        => 'rand',
								'post__not_in'   => array($product->get_id()),
								'tax_query'      => array(
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => $parent->slug,
									),
								),
							);

							$p_query = new WP_Query($p_args);
							if ($p_query->have_posts()) : ?>
							<section class="sec-spacing-jy">
								<div class="container">
									<h2 class="color-1 fw-semibold size-32 size-lg-48 fw-light lh-sm width-max-430 mb-lg-5 mb-4">
										Shop from <?= $parent->name; ?>
									</h2>
									<div class="row flex-nowrap gap-lg-0 overflow-x-auto pb-4">
										<?php while ($p_query->have_posts()) : $p_query->the_post(); ?>
											<?php
											$product_id = get_the_ID();
											$related_product = wc_get_product($product_id);
											$image_url = get_the_post_thumbnail_url($product_id, 'large') ?: 'https://via.placeholder.com/300';
											$product_title = get_the_title();
											$product_link = get_permalink();
											?>
											<div class="col-xl-3 col-lg-4 col-sm-6 col-11">
												<a href="<?php echo esc_url($product_link); ?>" class="text-decoration-none card-over w-100">
													<div class="overflow-hidden rounded-md">
														<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product_title); ?>" class="height-280 object-fit-cover w-100"/>
													</div>
													<h3 class="mt-3 color-1 size-28 d-flex align-items-center gap-3">
														<?php echo esc_html($product_title); ?>
													</h3>
												</a>
											</div>
										<?php endwhile; ?>
									</div>
									<?php wp_reset_postdata(); ?>
								</div>
							</section>
							<?php endif; 
						endforeach;
					}
				} ?>

			<?php /* Custom Template End */ ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
