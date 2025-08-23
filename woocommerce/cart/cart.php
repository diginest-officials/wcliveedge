<?php
defined( 'ABSPATH' ) || exit; ?>

<section>
	<div class="container sec-spacing-md pt-0">

		<div class="mb-lg-5 mb-4 mt-4 custom-breadcrumb">
			<?php if (function_exists('woocommerce_breadcrumb')) {
				woocommerce_breadcrumb();
			} ?>
		</div>

		<?php do_action( 'woocommerce_before_cart' ); ?>

		<div class="row row-gap-5">
			<div class="col-lg-7 col-12">
				<h1 class="size-lg-48 size-32 color-1 mb-5"><?php the_title(); ?></h1>
				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>

					<table class="cart w-100" cellspacing="0">
						<tbody>
							<?php do_action( 'woocommerce_before_cart_contents' ); 
							$index = 0;

							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
								/**
								 * Filter the product name.
								 *
								 * @since 2.1.0
								 * @param string $product_name Name of the product in the cart.
								 * @param array $cart_item The product in the cart.
								 * @param string $cart_item_key Key for the product in the cart.
								 */
								$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
									
									if ( $index != 0 ) {
										echo '<hr class="color-bg-7 my-4 w-100">';
									} 
									
									$index++; ?>

									<div class="cart-loader row position-relative flex-row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>">
										
										<div class="loader position-absolute w-100 h-100 top-0 start-0 z-1 color-bg-2 opacity-85"style="display: none;"></div>

										<div class="product-thumbnail text-center col-xxl-2 col-sm-3 col-4 pe-0 pe-sm-3">
											<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

											if ( ! $product_permalink ) {
												echo $thumbnail; // PHPCS: XSS ok.
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
											}

											$sku = $_product->get_sku();
											if ( $sku ) {
												echo '<div class="cart-product-sku mt-3 color-bg-7 py-1 px-2 size-14 width-fit mx-auto rounded-1">' . esc_html( $sku ) . '</div>';
											}
											?>
										</div>

										<div class="col-xxl-8 col-sm-7 col-6 d-flex flex-column pe-0 pe-sm-3">
											<?php
											if ( ! $product_permalink ) {
												echo wp_kses_post( $product_name . '&nbsp;' );
											} else {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="link-underline link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover link-dark size-sm-20 size-18 fw-semibold color-1 mb-2 width-fit">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
											}

											do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

											// Meta data.
											echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok. ?>

											<p class="size-14 color-1 opacity-85 flex-grow-1"><?php echo get_post_field( 'post_excerpt', $_product->get_id() ); ?></p>

											<div class="d-flex align-items-center gap-sm-4 gap-2">
												<div id="cart-quantity" class="d-flex align-items-center cart-item border border-1 rounded-pill" data-cart-key="<?php echo $cart_item_key; ?>">
													<span class="minus size-20 color-1 cursor-pointer py-2 px-3 fw-semibold">-</span>
													<input type="number" class="qty text-center size-16 color-1 bg-transparent border-0 fw-semibold" value="<?php echo $cart_item['quantity']; ?>" min="1">
													<span class="plus size-20 color-1 cursor-pointer py-2 px-3 fw-semibold">+</span>
												</div>


												<?php
												// Backorder notification.
												// if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
												// 	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												// }

												// if ( $_product->is_sold_individually() ) {
												// 	$min_quantity = 1;
												// 	$max_quantity = 1;
												// } else {
												// 	$min_quantity = 0;
												// 	$max_quantity = $_product->get_max_purchase_quantity();
												// }
												
												// 		$product_quantity = woocommerce_quantity_input(
												// 			array(
												// 				'input_name'   => "cart[{$cart_item_key}][qty]",
												// 				'input_value'  => $cart_item['quantity'],
												// 				'max_value'    => $max_quantity,
												// 				'min_value'    => $min_quantity,
												// 				'product_name' => $product_name,
												// 			),
												// 			$_product,
												// 			false
												// 		);
													
										
												// Add a data attribute for the quantity input
												// echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.

											
												echo '<div class="color-bg-7" style="width: 2px; height: 32px;"></div>';

												$remove_icon = get_field('remove_icon', 'options');
												if ($remove_icon) {
													$display_icon = '<img src="' . $remove_icon . '" alt="remove icon" class="d-block">';
												} else {
													$display_icon = '&times;';
												}

												echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													'woocommerce_cart_item_remove_link',
													sprintf(
														'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">' . $display_icon . '</a>',
														esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
														/* translators: %s is the product name */
														esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
														esc_attr( $product_id ),
														esc_attr( $_product->get_sku() )
													),
													$cart_item_key
												);
												?>
											</div>
										</div>

										<div class="col-2 d-flex justify-content-end">
											<div class="product-subtotal size-sm-20 size-18 fw-semibold color-1" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
												<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
												?>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>

							<?php do_action( 'woocommerce_cart_contents' ); ?>

							<tr>
								<td colspan="6" class="actions">
									<?php /* ?>
									<button type="submit" class=" button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
									<?php */ ?>
									
									<?php do_action( 'woocommerce_cart_actions' ); ?>
									
									<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
								</td>
							</tr>

							<?php do_action( 'woocommerce_after_cart_contents' ); ?>
						</tbody>
					</table>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</form>
			</div>

			<div class="col-1 d-none d-lg-block"></div>
			
			<div class="col-lg-4 col-12">
				<?php do_action( 'woocommerce_before_cart_collaterals' );

				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */

				do_action( 'woocommerce_cart_collaterals' ); ?>
			</div>

			<?php do_action( 'woocommerce_after_cart' ); ?>

		</div>
	</div>
</section>


<!-- Related Products Section -->
<section class="sec-spacing-md pt-0 pt-lg-5">
    <div class="container">
        <?php
        $related_products = get_field('archive_related_products', 'options');
        
        if (!empty($related_products['heading'])) : ?>
            <div class="d-flex align-items-end justify-content-between pb-lg-5 pb-4">
                <h2 class="color-3 size-32 size-lg-48 fw-light lh-sm fw-medium">
                    <?php echo esc_html($related_products['heading']); ?>
                </h2>
            </div>
        <?php endif; ?>

        <div class="row flex-nowrap flex-lg-wrap row-gap-5 overflow-x-auto pb-4">
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'orderby'        => 'rand'
            );

            $random_products = new WP_Query($args);

            if ($random_products->have_posts()) :
                while ($random_products->have_posts()) : $random_products->the_post();
                    $product = wc_get_product(get_the_ID()); ?>

                    <div class="col-xl-3 col-lg-4 col-sm-6 col-11">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none card-over w-100">
                            <div class="overflow-hidden rounded-md">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'height-280 object-fit-cover w-100')); ?>
                                <?php endif; ?>
                            </div>
                            <h3 class="mt-3 color-3 size-28 d-flex align-items-center gap-3">
                                <?php echo esc_html(get_the_title()); ?>
                            </h3>
                        </a>
                    </div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>