<?php
defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2 class="size-20 fw-semibold color-1 mb-5"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>

	<div class="d-flex align-items-center justify-content-between w-100">
		<h4 class="size-16 fw-medium color-1 opacity-75"><?php esc_html_e( 'Total excluding tax', 'woocommerce' ); ?></h4>
		<h5 class="size-16 fw-medium color-1 opacity-75 cart-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
			<?php wc_cart_totals_subtotal_html(); ?>
		</h5>
	</div>

	<hr class="color-bg-7 mt-3 mb-4 w-100">

	<?php /* foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="d-flex align-items-center justify-content-between w-100 cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<h4 class="size-16 fw-medium color-1"><?php wc_cart_totals_coupon_label( $coupon ); ?></h4>
			<h5 class="size-16 fw-medium color-1" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></h5>
		</div>
	<?php endforeach; */ ?>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

		<?php // wc_cart_totals_shipping_html(); ?>

		<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

	<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

		<div class="shipping d-flex align-items-center justify-content-between w-100">
			<h4 class="size-16 fw-medium color-1"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></h4>
			<h5 class="size-16 fw-medium color-1" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></h5>
		</div>

	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="fee d-flex align-items-center justify-content-between w-100">
			<h4 class="size-16 fw-medium color-1"><?php echo esc_html( $fee->name ); ?></h4>
			<h5 class="size-16 fw-medium color-1" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></h5>
		</div>
	<?php endforeach; ?>

	<?php
	if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text  = '';

		if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
			/* translators: %s location. */
			$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
		}

		if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
			foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				?>
				<div class="d-flex align-items-center justify-content-between w-100 tax-total">
					<h4 class="size-16 fw-medium color-1"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></h4>
					<h5 class="size-16 fw-medium color-1"><?php wc_cart_totals_taxes_total_html(); ?></h5>
				</div>
				<?php
			}
		} else {
			?>
			<div class="d-flex align-items-center justify-content-between w-100 tax-total">
				<h4 class="size-16 fw-medium color-1"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></h4>
				<h5 class="size-16 fw-medium color-1"><?php wc_cart_totals_taxes_total_html(); ?></h5>
			</div>
			<?php
		}
	}
	?>

	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

	<div class="d-flex align-items-center justify-content-between w-100">
		<h4 class="size-16 fw-bold color-1"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h4>
		<h5 class="size-16 fw-bold color-1 cart-total"><?php wc_cart_totals_order_total_html(); ?></h5>
	</div>

	<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<hr class="color-bg-7 mt-3 mb-4 w-100">

	<?php if ( wc_coupons_enabled() ) { ?>
		<form class="checkout_coupon woocommerce-form-coupon p-0 border-0" method="post">
			<button class="btn px-0 size-16 color-1 fw-semibold w-100 text-start d-flex align-items-center justify-content-between border-0 coupon-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cart-coupon" aria-expanded="false" aria-controls="cart-coupon">
				Apply discount code

				<?php if ( $coupon_icon = get_field('coupon_icon', 'options') ) :
					echo '<img src="' . esc_url( $coupon_icon ) . '" alt="icon toggle">';
				endif; ?>
			</button>

			
			<div class="coupon collapse" id="cart-coupon">
				<div class="pb-4"></div>
					<form id="ajax-coupon-form" method="post">
						<div class="d-flex flex-wrap align-items-center gap-3">
							<div class="coupon-input">
								<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
								<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
							</div>
							<button type="submit" class="coupon-submit px-4 py-3 color-bg-6 color-1 width-fit fw-semibold rounded-pill size-16 button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
							<div class="clear"></div>
							<div id="coupon-response" class="w-100" style="display: none;"></div>
						</div>
					</form>
					<p class="size-14 color-1 opacity-75 mt-4">Enter the code without any space between letters. Gift cards can be exchanged later in the process.</p>
				</div>
			</div>
		</form>
		
	<?php } ?>

	<div class="wc-proceed-to-checkout p-0">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
