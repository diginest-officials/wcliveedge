<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="mb-4 py-2 border-bottom border-1 d-flex align-items-center justify-content-between w-100 d-block d-lg-none fw-semibold" data-bs-toggle="collapse" href="#cart-toggle" role="button" aria-expanded="true" id="cart-toggle-btn" aria-controls="cart-toggle">View Cart <img src="<?php the_field( 'coupon_icon', 'option' ) ?: ''; ?>" alt="icon-arrow"></div>
	<div class="collapse show" id="cart-toggle">
		<div class="d-flex flex-column gap-4">
			<?php do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) { ?>
					<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> row"> 
						<div class="d-flex gap-3 justify-content-between w-100 checkout-item mt-2">
							<div class="d-flex gap-4">
								<div class="position-relative">
									<?= $_product->get_image(); ?>
									<span class="d-block position-absolute z-1 py-1 px-2 size-14 fw-medium rounded-pill item-quantity"><?= $cart_item['quantity']; ?></span>
								</div>
								<div class="d-flex flex-column width-max-180">
									<h3 class="size-14 fw-medium mb-1 color-1"><?= $_product->get_name(); ?></h3>
									<p class="size-12 fw-medium mb-1 color-1 opacity-75 flex-grow-1"><?= $_product->short_description; ?></p>
									<span class="item-sku"><?= $_product->sku; ?></span>
								</div>
							</div>
							<div class="item-price">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						</div>
					</div>
				<?php }
			}

			do_action( 'woocommerce_review_order_after_cart_contents' ); ?>
		</div>
	</div>

	<div>
		<div class="cart-subtotal d-flex my-3 justify-content-between w-100">
			<h5 class="size-14 fw-medium color-1 width-fit"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></h5>
			<h6 class="size-14 fw-medium color-1 width-fit"><?php wc_cart_totals_subtotal_html(); ?></h6>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="d-flex my-3 justify-content-between w-100 cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<h5 class="size-14 fw-medium color-1 width-fit"><?php wc_cart_totals_coupon_label( $coupon ); ?></h5>
				<h6 class="size-14 fw-medium color-1 width-fit"><?php wc_cart_totals_coupon_html( $coupon ); ?></h6>
			</div>
		<?php endforeach; ?>

		<?php /* if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; */ ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="d-flex my-3 fee justify-content-between w-100">
				<h5 class="size-14 fw-medium color-1 width-fit"><?php echo esc_html( $fee->name ); ?></h5>
				<h6 class="size-14 fw-medium color-1 width-fit"><?php wc_cart_totals_fee_html( $fee ); ?></h6>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<div class="d-flex my-3 justify-content-between w-100 tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<h5 class="size-14 fw-medium color-1 width-fit"><?php echo esc_html( $tax->label ); ?></h5>
						<h6 class="size-14 fw-medium color-1 width-fit"><?php echo wp_kses_post( $tax->formatted_amount ); ?></h6>
				</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="d-flex my-3 tax-total justify-content-between w-100">
					<h5 class="size-14 fw-medium color-1 width-fit"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h5>
					<h6 class="size-14 fw-medium color-1 width-fit"><?php wc_cart_totals_taxes_total_html(); ?></h6>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<hr class="mt-3 mb-4">

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="order-total d-flex my-3 justify-content-between w-100">
			<h5 class="size-16 fw-semibold color-1 width-fit"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h5>
			<h6 class="size-16 fw-medium color-1 width-fit"><?php wc_cart_totals_order_total_html(); ?></h6>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</div>
</div>
