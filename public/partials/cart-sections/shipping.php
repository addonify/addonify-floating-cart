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

$has_shipping_calculator_enabled = ( get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) ? true : false;
?>
<div id="adfy__woofc-shipping-container-inner">
	<?php
	if ( $available_methods ) {
		?>
		<ul id="adfy__woofc-shipping-methods" class="adfy__woofc-shipping-methods">
			<?php
			foreach ( $available_methods as $method ) {
				?>
				<li>
					<?php
					if ( 1 < count( $available_methods ) ) {
						printf(
							'<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />',
							esc_attr( $index ),
							esc_attr( sanitize_title( $method->id ) ),
							esc_attr( $method->id ),
							checked( $method->id, $chosen_method, false )
						);

						printf(
							'<label for="shipping_method_%1$s_%2$s">%3$s</label>',
							esc_attr( $index ),
							esc_attr( sanitize_title( $method->id ) ),
							wc_cart_totals_shipping_method_label( $method ) // phpcs:ignore
						);
					} else {
						printf(
							'<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />',
							esc_attr( $index ),
							esc_attr( sanitize_title( $method->id ) ),
							esc_attr( $method->id )
						);

						echo wc_cart_totals_shipping_method_label( $method ); // phpcs:ignore
					}

					do_action( 'woocommerce_after_shipping_rate', $method, $index );
					?>
				</li>
				<?php
			}
			?>
		</ul>
		<p class="adfy__woofc-shipping-destination">
			<?php
			if ( $formatted_destination ) {

				printf(
					// Translators: %s shipping destination.
					esc_html__( 'Shipping to %s.', 'addonify-floating-cart' ) . ' ',
					'<strong>' . esc_html( $formatted_destination ) . '</strong>'
				);

				$calculator_text = esc_html__( 'Change address', 'addonify-floating-cart' );
			} else {
				echo wp_kses_post(
					apply_filters(
						'addonify_floating_cart_shipping_estimate_html',
						esc_html__( 'Shipping options will be updated during checkout.', 'addonify-floating-cart' )
					)
				);
			}
			?>
		</p>
		<?php
	} elseif ( ! $has_calculated_shipping || ! $formatted_destination ) {

		if ( ! $has_shipping_calculator_enabled ) {
			echo wp_kses_post(
				apply_filters(
					'addonify_floating_cart_shipping_not_enabled_on_cart_html',
					esc_html__( 'Shipping costs are calculated during checkout.', 'addonify-floating-cart' )
				)
			);
		} else {
			echo wp_kses_post(
				apply_filters(
					'addonify_floating_cart_shipping_may_be_available_html',
					esc_html__( 'Enter your address to view shipping options.', 'addonify-floating-cart' )
				)
			);
		}
	} else {

		echo wp_kses_post(
			apply_filters(
				'addonify_floating_cart_cart_no_shipping_available_html',
				sprintf(
					// Translators: %s shipping destination.
					esc_html__( 'No shipping options were found for %s.', 'addonify-floating-cart' ) . ' ',
					'<strong>' . esc_html( $formatted_destination ) . '</strong>'
				)
			)
		);
	}

	if ( $show_package_details ) {
		?>
		<?php echo '<p class="addonify-floating-cart-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php
	}

	if ( $show_shipping_calculator && $has_shipping_calculator_enabled ) {

		$country_field_label  = esc_html__( 'Country / Region', 'addonify-floating-cart' );
		$state_field_label    = esc_html__( 'State', 'addonify-floating-cart' );
		$city_field_label     = esc_html__( 'City', 'addonify-floating-cart' );
		$zip_code_field_label = esc_html__( 'ZIP code', 'addonify-floating-cart' );
		$submit_button_label  = esc_html__( 'Update address', 'addonify-floating-cart' );

		if ( '1' === $strings_from_setting ) {

			$saved_country_field_label = addonify_floating_cart_get_option( 'shipping_address_form_country_field_label' );
			if ( $saved_country_field_label ) {
				$country_field_label = $saved_country_field_label;
			}

			$saved_state_field_label = addonify_floating_cart_get_option( 'shipping_address_form_state_field_label' );
			if ( $saved_state_field_label ) {
				$state_field_label = $saved_state_field_label;
			}

			$saved_city_field_label = addonify_floating_cart_get_option( 'shipping_address_form_city_field_label' );
			if ( $saved_city_field_label ) {
				$city_field_label = $saved_city_field_label;
			}

			$saved_zip_code_field_label = addonify_floating_cart_get_option( 'shipping_address_form_zip_code_field_label' );
			if ( $saved_zip_code_field_label ) {
				$zip_code_field_label = $saved_zip_code_field_label;
			}

			$saved_submit_button_label = addonify_floating_cart_get_option( 'shipping_address_form_submit_button_label' );
			if ( $saved_submit_button_label ) {
				$submit_button_label = $saved_submit_button_label;
			}
		}
		?>
		<form id="adfy__woofc-shipping-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

			<section class="adfy__woofc-shipping-form-elements">

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
					<div class="adfy__woofc-shipping-form-item" id="adfy__woofc_shipping_country_field">
						<label for="addonify_floating_cart_shipping_country">
							<?php echo esc_html( $country_field_label ); ?>
						</label>
						<select
							name="addonify_floating_cart_shipping_country"
							id="addonify_floating_cart_shipping_country"
							class="country_to_state"
							rel="addonify_floating_cart_shipping_state"
						>
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
					<div class="adfy__woofc-shipping-form-item" id="adfy__woofc_shipping_state_field">
						<?php
						$current_cc = WC()->customer->get_shipping_country();
						$current_r  = WC()->customer->get_shipping_state();
						$states     = WC()->countries->get_states( $current_cc );

						if ( is_array( $states ) && empty( $states ) ) {
							?>
							<label for="addonify_floating_cart_shipping_state">
								<?php echo esc_html( $state_field_label ); ?>
							</label>
							<input
								type="hidden"
								name="addonify_floating_cart_shipping_state"
								id="addonify_floating_cart_shipping_state"
							/>
							<?php
						} elseif ( is_array( $states ) ) {
							?>
							<span>
								<label for="addonify_floating_cart_shipping_state">
									<?php echo esc_html( $state_field_label ); ?>
								</label>
								<select
									name="addonify_floating_cart_shipping_state"
									class="state_select"
									id="addonify_floating_cart_shipping_state"
								>
									<option value="">
										<?php esc_html_e( 'Select an option&hellip;', 'addonify-floating-cart' ); ?>
									</option>
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
							<label for="addonify_floating_cart_shipping_state">
								<?php echo esc_html( $state_field_label ); ?>
							</label>
							<input
								type="text"
								class="input-text"
								value="<?php echo esc_attr( $current_r ); ?>"
								name="addonify_floating_cart_shipping_state"
								id="addonify_floating_cart_shipping_state"
							/>
							<?php
						}
						?>
					</div>
				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
					<div class="adfy__woofc-shipping-form-item" id="adfy__woofc_shipping_city_field">
						<label for="addonify_floating_cart_shipping_city">
							<?php echo esc_html( $city_field_label ); ?>
						</label>
						<input
							type="text"
							class="input-text"
							value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" 
							name="addonify_floating_cart_shipping_city"
							id="addonify_floating_cart_shipping_city"
						/>
					</div>
				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
					<div class="adfy__woofc-shipping-form-item" id="adfy__woofc_shipping_postcode_field">
						<label for="addonify_floating_cart_shipping_postcode">
							<?php echo esc_html( $zip_code_field_label ); ?>
						</label>
						<input
							type="text"
							class="input-text"
							value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>"
							name="addonify_floating_cart_shipping_postcode"
							id="addonify_floating_cart_shipping_postcode"
						/>
					</div>
				<?php endif; ?>

				<div class="adfy__woofc-shipping-form-item">
					<button type="submit" name="addonify_floating_cart_shipping" value="1" class="button addonify_floating_cart-button">
						<?php echo esc_html( $submit_button_label ); ?>
					</button>
				</div>

				<?php wp_nonce_field( 'addonify-floating-cart-shipping', 'addonify-floating-cart-shipping-nonce' ); ?>
			</section>
		</form>
		<?php
	}
	?>
</div>
