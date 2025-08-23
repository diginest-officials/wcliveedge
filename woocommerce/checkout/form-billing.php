<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3 class="size-24 fw-semibold mb-3 color-1"><?php esc_html_e( 'Contact', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3 class="size-24 fw-semibold mb-3 color-1"><?php esc_html_e( 'Contact', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper custom-billing mb-5">
        <?php
        // Email Field
        woocommerce_form_field('billing_email', array(
            'type'        => 'email',
            'class'       => array('form-row-wide'),
            'placeholder' => esc_attr__('Email', 'woocommerce', 'form-row-full'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_email'));
        ?>

        <!-- Order Updates Checkbox -->
        <div class="form-row form-row-wide mt-2">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox d-flex align-items-center gap-2">
                <input type="checkbox" 
                       class="woocommerce-form__input woocommerce-form__input-checkbox" 
                       name="order_updates" 
                       id="order_updates" 
                       value="1">
                <span class="size-14"><?php esc_html_e('Get Order Updates & Offers via Email, WhatsApp or SMS', 'woocommerce'); ?></span>
            </label>
        </div>
    </div>

    <!-- Delivery Section -->
    <h3 class="size-24 fw-semibold mb-3 color-1"><?php esc_html_e('Delivery', 'woocommerce'); ?></h3>

    <div class="woocommerce-billing-fields__field-wrapper custom-billing-2 d-flex flex-wrap gap-3">
        
        <?php // Country/Region Field
        woocommerce_form_field('billing_country', array(
            'type'        => 'country',
            'class'       => array('form-row-wide', 'address-field', 'update_totals_on_change', 'form-row-full'),
            'placeholder' => esc_attr__('Country/Region', 'woocommerce'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
            'default'     => 'US'
        ), $checkout->get_value('billing_country')); ?>

        <?php
        // First Name Field
        woocommerce_form_field('billing_first_name', array(
            'type'        => 'text',
            'class'       => array('form-row-first'),
            'placeholder' => esc_attr__('First name', 'woocommerce', 'form-row-half'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_first_name'));

        // Last Name Field
        woocommerce_form_field('billing_last_name', array(
            'type'        => 'text',
            'class'       => array('form-row-last'),
            'placeholder' => esc_attr__('Last name', 'woocommerce', 'form-row-half'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_last_name'));

        // Address Field
        woocommerce_form_field('billing_address_1', array(
            'type'        => 'text',
            'class'       => array('form-row-wide', 'address-field'),
            'placeholder' => esc_attr__('Address Including House No, Block & Town', 'woocommerce', 'form-row-full'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_address_1'));

        // City Field
        woocommerce_form_field('billing_city', array(
            'type'        => 'text',
            'class'       => array('form-row-first', 'address-field'),
            'placeholder' => esc_attr__('City: Los Angeles, Chicago etc', 'woocommerce', 'form-row-half'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_city'));

        // Postcode Field
        woocommerce_form_field('billing_postcode', array(
            'type'        => 'text',
            'class'       => array('form-row-last', 'address-field'),
            'placeholder' => esc_attr__('Postal code (optional)', 'woocommerce', 'form-row-half'),
            'required'    => false,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_postcode'));

        // Phone Field
        woocommerce_form_field('billing_phone', array(
            'type'        => 'tel',
            'class'       => array('form-row-wide'),
            'placeholder' => esc_attr__('Mobile - 03001234567 | For order/delivery updates', 'woocommerce', 'form-row-full'),
            'required'    => true,
            'clear'       => true,
            'label'       => '',
        ), $checkout->get_value('billing_phone'));
        ?>

        <!-- Save Information Checkbox -->
        <div class="form-row form-row-wide p-0 m-0">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox d-flex align-items-center gap-2 mb-1">
                <input type="checkbox" 
                       class="woocommerce-form__input woocommerce-form__input-checkbox" 
                       name="save_info" 
                       id="save_info" 
                       value="1">
                <span class="size-14"><?php esc_html_e('Save this information for next time', 'woocommerce'); ?></span>
            </label>

            <?php /* ?>
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox d-flex align-items-center gap-2">
                <input type="checkbox" 
                       class="woocommerce-form__input woocommerce-form__input-checkbox" 
                       name="text_updates" 
                       id="text_updates" 
                       value="1">
                <span class="size-14"><?php esc_html_e('Text me with news and offers', 'woocommerce'); ?></span>
            </label>
            <?php */ ?>
        </div>
    </div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
