<?php
/**
 * The Template for displaying shipping form.
 *
 * This template can be overridden by copying it to yourtheme/addonify-floating-cart/shipping.php.
 *
 * @package GoCart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>


<div id="addonify_floating_cart-shipping-container-inner">
	<?php if ( ! ( count( WC()->countries->get_allowed_countries() ) > 0 ) || (bool) addonify_floating_cart_get_option( 'enable_shipping_calculation' ) ) : ?>
		<?php if ( $available_methods ) : ?>
			<ul id="addonify_floating_cart-shipping-methods" class="addonify_floating_cart-shipping-methods">
				<?php foreach ( $available_methods as $method ) : ?>
					<li>
						<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // phpcs:ignore
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // phpcs:ignore
						}
						printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // phpcs:ignore
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<p class="addonify_floating_cart-shipping-destination">
				<?php
				if ( $formatted_destination ) {
					// Translators: $s shipping destination.
					printf( esc_html__( 'Shipping to %s.', 'addonify-floating-cart' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
					$calculator_text = esc_html__( 'Change address', 'addonify-floating-cart' );
				} else {
					echo wp_kses_post( apply_filters( 'addonify_floating_cart_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'addonify-floating-cart' ) ) );
				}
				?>
			</p>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo wp_kses_post( apply_filters( 'addonify_floating_cart_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'addonify-floating-cart' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'addonify_floating_cart_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'addonify-floating-cart' ) ) );
			}
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'addonify_floating_cart_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'addonify-floating-cart' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'addonify-floating-cart' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="addonify-floating-cart-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( $show_shipping_calculator ) : ?>

			<form id="addonify_floating_cart-shipping-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

				<div class="addonify_floating_cart-shipping-address-form-toggle-button-block">
					<?php printf( '<a href="#" class="addonify_floating_cart-shipping-address-form-toggle-button addonify_floating_cart-link has-underline">%s</a>', esc_html( ! empty( $calculator_text ) ? $calculator_text : __( 'Calculate shipping', 'addonify-floating-cart' ) ) ); ?>
				</div>

				<section class="addonify_floating_cart-shipping-form-elements" style="display:none;">

					<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
						<div class="addonify_floating_cart-shipping-form-item" id="addonify_floating_cart_shipping_country_field">
							<label for="addonify_floating_cart_shipping_country" class="screen-reader-text">
								<?php esc_html_e( 'Country / region:', 'addonify-floating-cart' ); ?>
							</label>
							<select name="addonify_floating_cart_shipping_country" id="addonify_floating_cart_shipping_country" class="country_to_state country_select" rel="addonify_floating_cart_shipping_state">
								<option value="default">
									<?php esc_html_e( 'Select a country / region&hellip;', 'addonify-floating-cart' ); ?>
								</option>
								<?php
								foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
									echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
								}
								?>
							</select>
						</div>
					<?php endif; ?>

					<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
						<div class="addonify_floating_cart-shipping-form-item" id="addonify_floating_cart_shipping_state_field">
							<?php
							$current_cc = WC()->customer->get_shipping_country();
							$current_r  = WC()->customer->get_shipping_state();
							$states     = WC()->countries->get_states( $current_cc );

							if ( is_array( $states ) && empty( $states ) ) {
								?>
								<input type="hidden" name="addonify_floating_cart_shipping_state" id="addonify_floating_cart_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'addonify-floating-cart' ); ?>" />
								<?php
							} elseif ( is_array( $states ) ) {
								?>
								<span>
									<label for="addonify_floating_cart_shipping_state" class="screen-reader-text"><?php esc_html_e( 'State / County:', 'addonify-floating-cart' ); ?></label>
									<select name="addonify_floating_cart_shipping_state" class="state_select" id="addonify_floating_cart_shipping_state" data-placeholder="<?php esc_attr_e( 'State / County', 'addonify-floating-cart' ); ?>">
										<option value=""><?php esc_html_e( 'Select an option&hellip;', 'addonify-floating-cart' ); ?></option>
										<?php
										foreach ( $states as $ckey => $cvalue ) {
											echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
										}
										?>
									</select>
								</span>
								<?php
							} else {
								?>
								<label for="addonify_floating_cart_shipping_state" class="screen-reader-text"><?php esc_html_e( 'State / County:', 'addonify-floating-cart' ); ?></label>
								<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / County', 'addonify-floating-cart' ); ?>" name="addonify_floating_cart_shipping_state" id="addonify_floating_cart_shipping_state" />
								<?php
							}
							?>
						</div>
					<?php endif; ?>

					<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
						<div class="addonify_floating_cart-shipping-form-item" id="addonify_floating_cart_shipping_city_field">
							<label for="addonify_floating_cart_shipping_city" class="screen-reader-text"><?php esc_html_e( 'City:', 'addonify-floating-cart' ); ?></label>
							<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'addonify-floating-cart' ); ?>" name="addonify_floating_cart_shipping_city" id="addonify_floating_cart_shipping_city" />
						</div>
					<?php endif; ?>

					<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
						<div class="addonify_floating_cart-shipping-form-item" id="addonify_floating_cart_shipping_postcode_field">
							<label for="addonify_floating_cart_shipping_postcode" class="screen-reader-text"><?php esc_html_e( 'Postcode / ZIP:', 'addonify-floating-cart' ); ?></label>
							<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'addonify-floating-cart' ); ?>" name="addonify_floating_cart_shipping_postcode" id="addonify_floating_cart_shipping_postcode" />
						</div>
					<?php endif; ?>

					<div class="addonify_floating_cart-shipping-form-item">
						<button type="submit" name="addonify_floating_cart_shipping" value="1" class="button addonify_floating_cart-button">
							<?php esc_html_e( 'Update address', 'addonify-floating-cart' ); ?>
						</button>
					</div>

					<?php wp_nonce_field( 'addonify-floating-cart-shipping', 'addonify-floating-cart-shipping-nonce' ); ?>

				</section>
			</form>

		<?php endif; ?>
	<?php endif ?>
</div>
