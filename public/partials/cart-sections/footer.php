<?php
/**
 * The Template for displaying footer of floating cart.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/footer.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="adfy__woofc-colophon <?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'adfy__woofc-hidden'; ?>" >
	<?php if ( wc_coupons_enabled() ) { ?>
	<div class="adfy__woofc-coupon">
		<p class="coupon-text">
			<span class="icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.137,24a2.8,2.8,0,0,1-1.987-.835L12,17.051,5.85,23.169a2.8,2.8,0,0,1-3.095.609A2.8,2.8,0,0,1,1,21.154V5A5,5,0,0,1,6,0H18a5,5,0,0,1,5,5V21.154a2.8,2.8,0,0,1-1.751,2.624A2.867,2.867,0,0,1,20.137,24ZM6,2A3,3,0,0,0,3,5V21.154a.843.843,0,0,0,1.437.6h0L11.3,14.933a1,1,0,0,1,1.41,0l6.855,6.819a.843.843,0,0,0,1.437-.6V5a3,3,0,0,0-3-3Z"/></svg>
			</span>
			<?php echo esc_html( apply_filters( 'addonify_floating_cart_have_a_coupon_label', __( 'Have a coupon?', 'addonify-floating-cart' ) ) ); ?>
			<a href="#" id="adfy__woofc-coupon-trigger" class="adfy__woofc-link has-underline">
				<?php echo esc_html( apply_filters( 'addonify_floating_cart_click_to_apply_button_label', __( 'Click here to apply', 'addonify-floating-cart' ) ) ); ?>
			</a>
		</p>
	</div>
	<?php } ?>
	<div class="adfy__woofc-cart-summary <?php echo ( WC()->cart->get_applied_coupons() ) ? 'discount' : ''; ?>">
		<ul>
			<li class="sub-total <?php echo ( ( WC()->cart->get_subtotal() !== WC()->cart->get_total() ) && WC()->cart->get_subtotal() ) ? '' : 'adfy__woofc-hidden'; ?>">
				<span class="label"><?php echo esc_html( addonify_floating_cart_get_option( 'sub_total_label' ) ); ?></span>
				<span class="value">
					<span class="addonify-floating-cart-Price-amount subtotal-amount">
						<?php
						if ( (bool) addonify_floating_cart_get_option( 'display_tax_amount' ) && get_option( 'woocommerce_tax_display_cart' ) === 'incl' ) {
							$sub_total = wc_price( WC()->cart->get_subtotal() );
						} else {
							$sub_total = WC()->cart->get_cart_subtotal();
						}
						?>
						<?php echo wp_kses_post( $sub_total ); ?>
					</span>
				</span>
			</li>
			<li class="discount <?php echo ( WC()->cart->get_discount_total() ) ? '' : 'adfy__woofc-hidden'; ?>">
				<span class="label"><?php echo esc_html( addonify_floating_cart_get_option( 'discount_label' ) ); ?></span>
				<span class="value">
					<span class="addonify-floating-cart-Price-amount discount-amount">
						<bdi>
						<?php
						if ( (bool) addonify_floating_cart_get_option( 'display_tax_amount' ) && get_option( 'woocommerce_tax_display_cart' ) === 'incl' ) {
							$discount = wc_price( WC()->cart->get_discount_total() );
						} else {
							$discount = wc_price( WC()->cart->get_discount_tax() + WC()->cart->get_discount_total() );
						}
						?>
						<?php echo wp_kses_post( $discount ); ?>
						</bdi>
					</span>
				</span>
			</li>
			<?php if ( ( count( WC()->countries->get_allowed_countries() ) > 0 ) ) : ?>
			<li class="shipping">
				<span class="label"><?php echo esc_html( addonify_floating_cart_get_option( 'shipping_label' ) ); ?>
					<?php if ( (bool) addonify_floating_cart_get_option( 'enable_shipping_calculation' ) ) : ?>
						<a id="adfy__woofc-shipping-trigger" class="adfy__woofc-link adfy__woofc-prevent-default has-underline" href='#'>
							( <?php echo esc_html( addonify_floating_cart_get_option( 'open_shipping_label' ) ); ?> )
						</a>
					<?php endif; ?>
				</span>

				<span class="value">
					<span class="addonify_floating_cart-Price-amount shipping-amount">
						<bdi>
						<?php
						if ( (bool) WC()->cart->show_shipping() ) {
							WC()->cart->calculate_shipping();
							if ( (bool) addonify_floating_cart_get_option( 'display_tax_amount' ) && get_option( 'woocommerce_tax_display_cart' ) === 'incl' ) {
								if ( WC()->customer->get_shipping_country() !== 'default' ) {
									$shipping_total = ( absint( WC()->cart->get_shipping_total() ) > 0 ) ? ( wc_price( WC()->cart->get_shipping_total() ) ) : __( 'Free!', 'woocommerce' );
								} else {
									$shipping_total = ( absint( WC()->cart->get_shipping_total() ) > 0 ) ? ( wc_price( WC()->cart->get_shipping_total() ) ) : '-';
								}
							} else {
								if ( WC()->customer->get_shipping_country() !== 'default' ) {
									$shipping_total = WC()->cart->get_cart_shipping_total();
								} else {
									$shipping_total = ( WC()->cart->get_cart_shipping_total() === __( 'Free!', 'woocommerce' ) ) ? '-' : WC()->cart->get_cart_shipping_total();
								}
							}
						} else {
							$shipping_total = '-';
						}
						?>
						<?php echo wp_kses_post( $shipping_total ); ?>
						</bdi>
					</span>
				</span>
			</li>
			<?php endif; ?>
			<?php if ( (bool) addonify_floating_cart_get_option( 'display_tax_amount' ) && get_option( 'woocommerce_tax_display_cart' ) === 'incl' ) : ?>
				<li class="tax <?php echo ( WC()->cart->get_cart_tax() ) ? '' : 'adfy__woofc-hidden'; ?>">
					<span class="label"><?php echo esc_html( addonify_floating_cart_get_option( 'tax_label' ) ); ?></span>
					<span class="value">
						<span class="addonify-floating-cart-Price-amount tax-amount">
							<bdi>
							<?php echo wp_kses_post( WC()->cart->get_cart_tax() ); ?>
							</bdi>
						</span>
					</span>
				</li>
			<?php endif; ?>
			<li class="total">
				<span class="label"><?php echo esc_html( addonify_floating_cart_get_option( 'total_label' ) ); ?></span>
				<span class="value">
					<span class="addonify-floating-cart-Price-amount total-amount">
						<?php echo wp_kses_post( WC()->cart->get_total() ); ?>
					</span>
				</span>
			</li>
		</ul>
	</div>
	<div class="adfy__woofc-actions <?php echo ( (int) addonify_floating_cart_get_option( 'display_continue_shopping_button' ) === 0 || empty( addonify_floating_cart_get_option( 'continue_shopping_button_label' ) ) ) ? 'adfy__woofc-fullwidth' : ''; ?>">
		<?php do_action( 'addonify_floating_cart_cart_footer_button', array() ); ?>
	</div>
</footer>
