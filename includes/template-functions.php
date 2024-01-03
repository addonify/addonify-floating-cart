<?php
/**
 * The file that defines template functions.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes
 */

if ( ! function_exists( 'addonify_floating_cart_locate_template' ) ) {
	/**
	 * Locate a template and return the path for inclusion.
	 *
	 * This is the load order:
	 *
	 * yourtheme/addonify/floating-cart/$template_path/$template_name
	 * yourtheme/addonify/floating-cart/$template_name
	 * $default_path/$template_name
	 *
	 * @param string $template_name Template name.
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path  Default path. (default: '').
	 * @return string
	 */
	function addonify_floating_cart_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		// Set template location for theme.
		if ( empty( $template_path ) ) {
			$template_path = 'addonify/floating-cart/';
		}

		// Set default plugin templates path.
		if ( ! $default_path ) {
			$default_path = plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/'; // Path to the template folder.
		}

		// Search template file in theme folder.
		$template = locate_template(
			array(
				$template_path . $template_name,
				$template_name,
			)
		);

		// Get plugins template file.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		return apply_filters( 'addonify_floating_cart_locate_template', $template, $template_name, $template_path, $default_path );
	}
}


if ( ! function_exists( 'addonify_floating_cart_get_template' ) ) {
	/**
	 * Get other templates passing attributes and including the file.
	 *
	 * @param string $template_name Template name.
	 * @param array  $args          Arguments. (default: array).
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path  Default path. (default: '').
	 */
	function addonify_floating_cart_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args ); // phpcs:ignore
		}

		$template_file = addonify_floating_cart_locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $template_file ) ) {
			/* translators: %s template */
			_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'addonify-floating-cart' ), '<code>' . $template_file . '</code>' ), '1.0.0' ); // phpcs:ignore
			return;
		}

		include $template_file;
	}
}


if ( ! function_exists( 'addonify_floating_cart_floating_button_template' ) ) {
	/**
	 * Display sidebar cart toggle button.
	 *
	 * @since 1.0.0
	 */
	function addonify_floating_cart_floating_button_template() {

		if ( (int) addonify_floating_cart_get_option( 'display_cart_modal_toggle_button' ) === 1 ) {

			$button_icon_choices = addonify_floating_cart_get_cart_modal_toggle_button_icons();

			$selected_button_icon = addonify_floating_cart_get_option( 'cart_modal_toggle_button_icon' );

			$template_args = array(
				'position'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_display_position' ),
				'display_badge'  => (int) addonify_floating_cart_get_option( 'display_cart_items_number_badge' ),
				'badge_position' => addonify_floating_cart_get_option( 'cart_items_number_badge_position' ),
				'button_icon'    => isset( $button_icon_choices[ $selected_button_icon ] ) ? $button_icon_choices[ $selected_button_icon ] : $button_icon_choices['icon_1'],
			);

			addonify_floating_cart_get_template( 'floating-button.php', $template_args );
		}
	}

	add_action( 'addonify_floating_cart_footer_template', 'addonify_floating_cart_floating_button_template' );
}


if ( ! function_exists( 'addonify_floating_cart_add_template' ) ) {
	/**
	 * Display sidebar cart.
	 *
	 * @since 1.0.0
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_add_template( $strings_from_setting ) {

		$template_args = array(
			'position'             => addonify_floating_cart_get_option( 'cart_position' ),
			'overlay_class'        => ( (int) addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ) === 1 ) ? 'adfy__hide-woofc' : '',
			'strings_from_setting' => $strings_from_setting,
		);

		addonify_floating_cart_get_template( 'sidebar-cart.php', $template_args );
	}

	add_action( 'addonify_floating_cart_footer_template', 'addonify_floating_cart_add_template' );
}


if ( ! function_exists( 'addonify_floating_cart_sidebar_cart' ) ) {
	/**
	 * Display sidebar cart content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_sidebar_cart( $strings_from_setting ) {

		do_action( 'addonify_floating_cart_sidebar_cart_header', $strings_from_setting );
		do_action( 'addonify_floating_cart_sidebar_cart_shipping_bar', $strings_from_setting );
		do_action( 'addonify_floating_cart_sidebar_cart_notice', $strings_from_setting );
		do_action( 'addonify_floating_cart_sidebar_cart_body', $strings_from_setting );
		do_action( 'addonify_floating_cart_sidebar_cart_footer', $strings_from_setting );
	}

	add_action( 'addonify_floating_cart_sidebar_cart', 'addonify_floating_cart_sidebar_cart' );
}


// -----------------------------------------------------------------------------------------------------
//
// Cart template functions with hooks    ---------------------------------------------------------------
//
// -----------------------------------------------------------------------------------------------------
if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_header_template' ) ) {
	/**
	 * Display sidebar cart footer section.
	 *
	 * @since 1.0.0
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_header_template( $strings_from_setting ) {

		addonify_floating_cart_get_template(
			'cart-sections/header.php',
			apply_filters(
				'addonify_floating_cart_sidebar_cart_header_template_args',
				array(
					'strings_from_setting' => $strings_from_setting,
				)
			)
		);
	}

	add_action( 'addonify_floating_cart_sidebar_cart_header', 'addonify_floating_cart_get_sidebar_cart_header_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_body_template' ) ) {
	/**
	 * Display sidebar cart body section.
	 *
	 * @since 1.0.0
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_body_template( $strings_from_setting ) {

		addonify_floating_cart_get_template(
			'cart-sections/body.php',
			apply_filters(
				'addonify_floating_cart_sidebar_cart_body_template_args',
				array(
					'strings_from_setting' => $strings_from_setting,
				)
			)
		);
	}

	add_action( 'addonify_floating_cart_sidebar_cart_body', 'addonify_floating_cart_get_sidebar_cart_body_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_coupon_template' ) ) {
	/**
	 * Display sidebar cart coupon section.
	 *
	 * @since 1.0.0
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_coupon_template( $strings_from_setting ) {

		addonify_floating_cart_get_template(
			'cart-sections/coupon.php',
			apply_filters(
				'addonify_floating_cart_sidebar_cart_coupon_template_args',
				array(
					'strings_from_setting' => $strings_from_setting,
				)
			)
		);
	}

	add_action( 'addonify_floating_cart_sidebar_cart_coupon', 'addonify_floating_cart_get_sidebar_cart_coupon_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_applied_coupons_template' ) ) {
	/**
	 * Display sidebar cart applied coupons section.
	 *
	 * @since 1.0.0
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_applied_coupons_template( $strings_from_setting ) {

		if ( (int) addonify_floating_cart_get_option( 'display_applied_coupons' ) === 1 ) {

			addonify_floating_cart_get_template(
				'cart-sections/coupons-applied.php',
				apply_filters(
					'addonify_floating_cart_sidebar_cart_applied_coupons_template_args',
					array(
						'strings_from_setting' => $strings_from_setting,
					)
				)
			);
		}
	}
	add_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', 'addonify_floating_cart_get_sidebar_cart_applied_coupons_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_shipping_bar_template' ) ) {
	/**
	 * Display sidebar cart shopping meter section.
	 *
	 * @since 1.0.0
	 * @param array $args  Arguments passed.
	 */
	function addonify_floating_cart_get_sidebar_cart_shipping_bar_template( $args = array() ) {

		$shopping_meter                   = (bool) addonify_floating_cart_get_option( 'enable_shopping_meter' );
		$free_shipping_eligibility_amount = (int) addonify_floating_cart_get_option( 'customer_shopping_meter_threshold' );

		$pre_threshold_label  = addonify_floating_cart_get_option( 'customer_shopping_meter_pre_threshold_label' );
		$post_threshold_label = addonify_floating_cart_get_option( 'customer_shopping_meter_post_threshold_label' );

		if (
			! $shopping_meter ||
			(
				0 === $free_shipping_eligibility_amount &&
				empty( $pre_threshold_label ) &&
				empty( $post_threshold_label )
			)
		) {
			return;
		}

		$template_args = array(
			'pre_threshold_label'  => $pre_threshold_label,
			'post_threshold_label' => $post_threshold_label,
		);

		if ( WC()->cart->get_cart_contents_count() > 0 ) {
			if ( WC()->cart->display_prices_including_tax() ) {
				$template_args['total'] = WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax();
			} else {
				$template_args['total'] = WC()->cart->get_subtotal();
			}
			if ( addonify_floating_cart_get_option( 'include_discount_amount_in_threshold' ) ) {
				if ( WC()->cart->display_prices_including_tax() ) {
					$discount = WC()->cart->get_discount_tax() + WC()->cart->get_discount_total();
				} else {
					$discount = WC()->cart->get_discount_total();
				}
				$template_args['total'] = $template_args['total'] - $discount;
			}
			if ( $template_args['total'] >= $free_shipping_eligibility_amount ) {
				$template_args['per']  = 100;
				$template_args['left'] = 0;
			} else {
				$template_args['per']  = 100 - ( ( $free_shipping_eligibility_amount - $template_args['total'] ) / $free_shipping_eligibility_amount * 100 );
				$template_args['left'] = $free_shipping_eligibility_amount - $template_args['total'];
			}
		} else {
			$template_args['left']  = 0;
			$template_args['total'] = 0;
			$template_args['per']   = 0;
		}

		addonify_floating_cart_get_template(
			'cart-sections/shipping-bar.php',
			apply_filters(
				'addonify_floating_cart_sidebar_shipping_bar_template_args',
				$template_args
			)
		);
	}

	add_action( 'addonify_floating_cart_sidebar_cart_shipping_bar', 'addonify_floating_cart_get_sidebar_cart_shipping_bar_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_shipping_template' ) ) {
	/**
	 * Display sidebar cart shipping section.
	 *
	 * @since 1.0.0
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_shipping_template( $strings_from_setting ) {

		$packages = WC()->cart->get_shipping_packages();
		$packages = WC()->shipping()->calculate_shipping( $packages );
		$first    = true;

		foreach ( $packages as $i => $package ) {
			$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
			$product_names = array();

			if ( count( $packages ) > 1 ) {
				foreach ( $package['contents'] as $item_id => $values ) {
					$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
				}
				$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
			}

			$args = array(
				'package'                  => $package,
				'available_methods'        => $package['rates'],
				'show_package_details'     => count( $packages ) > 1,
				'show_shipping_calculator' => apply_filters( 'woocommerce_shipping_show_shipping_calculator', $first, $i, $package ),
				'package_details'          => implode( ', ', $product_names ),
				/* translators: %d: shipping package number */
				'package_name'             => apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'addonify-floating-cart' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'addonify-floating-cart' ), $i, $package ),
				'index'                    => $i,
				'chosen_method'            => $chosen_method,
				'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
				'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
				'strings_from_setting'     => $strings_from_setting,
			);

			addonify_floating_cart_get_template(
				'cart-sections/shipping.php',
				apply_filters(
					'addonify_floating_cart_sidebar_cart_shipping_template_args',
					$args
				)
			);

			$first = false;
		}
	}

	add_action( 'addonify_floating_cart_sidebar_cart_shipping', 'addonify_floating_cart_get_sidebar_cart_shipping_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_sidebar_cart_footer_template' ) ) {
	/**
	 * Display sidebar cart footer section.
	 *
	 * @since 1.0.0
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_get_sidebar_cart_footer_template( $strings_from_setting ) {

		addonify_floating_cart_get_template(
			'cart-sections/footer.php',
			apply_filters(
				'addonify_floating_cart_sidebar_cart_footer_template_args',
				array(
					'strings_from_setting' => $strings_from_setting,
				)
			)
		);
	}

	add_action( 'addonify_floating_cart_sidebar_cart_footer', 'addonify_floating_cart_get_sidebar_cart_footer_template' );
}


if ( ! function_exists( 'addonify_floating_cart_footer_close_button_template' ) ) {
	/**
	 * Display cart close button in the cart footer.
	 *
	 * @since 1.0.0
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_footer_close_button_template( $strings_from_setting ) {

		$button_action = addonify_floating_cart_get_option( 'continue_shopping_button_action' );

		if (
			(int) addonify_floating_cart_get_option( 'display_continue_shopping_button' ) === 1 &&
			$button_action
		) {

			$button_label = '';

			$btn_label = addonify_floating_cart_get_option( 'continue_shopping_button_label' );

			if (
				'open_cart_page' === $button_action &&
				! empty( wc_get_cart_url() )
			) {
				if ( '1' === $strings_from_setting && $btn_label ) {
					$button_label = $btn_label;
				} else {
					$button_label = esc_html__( 'Cart', 'addonify-floating-cart' );
				}
				?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="adfy__woofc-button">
					<?php echo esc_html( $button_label ); ?>
				</a>
				<?php
			} else {
				if ( '1' === $strings_from_setting && $btn_label ) {
					$button_label = $btn_label;
				} else {
					$button_label = esc_html__( 'Close', 'addonify-floating-cart' );
				}
				?>
				<button class="adfy__woofc-button adfy__hide-woofc secondary">
					<?php echo esc_html( $button_label ); ?>
				</button>
				<?php
			}
		}
	}

	add_action( 'addonify_floating_cart_cart_footer_button', 'addonify_floating_cart_footer_close_button_template' );
}


if ( ! function_exists( 'addonify_floating_cart_footer_checkout_button_template' ) ) {
	/**
	 * Display checkout link in the cart footer.
	 *
	 * @since 1.0.0
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_footer_checkout_button_template( $strings_from_setting ) {

		$checkout_button_label = esc_html__( 'Checkout', 'addonify-floating-cart' );
		if ( '1' === $strings_from_setting ) {
			$saved_checkout_button_label = addonify_floating_cart_get_option( 'checkout_button_label' );
			if ( $saved_checkout_button_label ) {
				$checkout_button_label = $saved_checkout_button_label;
			}
		}
		?>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="adfy__woofc-button proceed-to-checkout">
			<?php echo esc_html( $checkout_button_label ); ?>
		</a>
		<?php
	}

	add_action( 'addonify_floating_cart_cart_footer_button', 'addonify_floating_cart_footer_checkout_button_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_product_image_template' ) ) {
	/**
	 * Display product image in the cart.
	 *
	 * @since 1.0.0
	 * @param array $args  Arguments passed.
	 */
	function addonify_floating_cart_get_product_image_template( $args = array() ) {

		$template_args = array(
			'product'           => $args['product'],
			'product_permalink' => $args['product']->is_visible() ? $args['product']->get_permalink() : '',
			'image'             => ( ! empty( $args['variation'] ) ) ? $args['variation']->get_image() : $args['product']->get_image(),
			'cart_item_key'     => $args['cart_item_key'],
		);

		addonify_floating_cart_get_template(
			'cart-loop/image.php',
			apply_filters(
				'addonify_floating_cart_product_image_template_args',
				$template_args
			)
		);
	}

	add_action( 'addonify_floating_cart_product_image', 'addonify_floating_cart_get_product_image_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_product_quantity_field_template' ) ) {
	/**
	 * Display product quantiy field in the cart.
	 *
	 * @since 1.0.0
	 * @param array $args  Arguments passed.
	 */
	function addonify_floating_cart_get_product_quantity_field_template( $args = array() ) {

		$max = ( $args['product']->get_max_purchase_quantity() < 0 ) ? '' : $args['product']->get_max_purchase_quantity();

		$template_args = array(
			'step'          => apply_filters( 'woocommerce_quantity_input_step', 1, $args['product'] ),
			'min'           => apply_filters( 'woocommerce_quantity_input_min', $args['product']->get_min_purchase_quantity(), $args['product'] ),
			'max'           => apply_filters( 'woocommerce_quantity_input_max', $max, $args['product'] ),
			'item_quantity' => $args['cart_item']['quantity'],
			'product_id'    => $args['product']->get_id(),
			'product_sku'   => $args['product']->get_sku(),
			'cart_item_key' => $args['cart_item_key'],
		);

		addonify_floating_cart_get_template(
			'cart-loop/quantity-field.php',
			apply_filters(
				'addonify_floating_cart_product_quantity_field_template_args',
				$template_args
			)
		);
	}

	add_action( 'addonify_floating_cart_product_quantity_field', 'addonify_floating_cart_get_product_quantity_field_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_product_quantity_price_template' ) ) {
	/**
	 * Display product quantiy and price in the cart.
	 *
	 * @since 1.0.0
	 * @param array $args  Arguments passed.
	 */
	function addonify_floating_cart_get_product_quantity_price_template( $args = array() ) {

		$_product      = apply_filters( 'woocommerce_cart_item_product', $args['cart_item']['data'], $args['cart_item'], $args['cart_item_key'] );
		$template_args = array(
			'price'    => apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $args['cart_item'], $args['cart_item_key'] ),
			'quantity' => $args['cart_item']['quantity'],
		);

		addonify_floating_cart_get_template(
			'cart-loop/quantity-price.php',
			apply_filters(
				'addonify_floating_cart_product_quantity_price_template_args',
				$template_args
			)
		);
	}

	add_action( 'addonify_floating_cart_product_quantity_price', 'addonify_floating_cart_get_product_quantity_price_template' );
}


if ( ! function_exists( 'addonify_floating_cart_get_product_title_template' ) ) {
	/**
	 * Display product title in the cart.
	 *
	 * @since 1.0.0
	 * @param array $args  Arguments passed.
	 */
	function addonify_floating_cart_get_product_title_template( $args = array() ) {

		$cart_item     = $args['cart_item'];
		$cart_item_key = $args['cart_item_key'];

		$cart_item_product = apply_filters(
			'woocommerce_cart_item_product',
			$cart_item['data'],
			$cart_item,
			$cart_item_key
		);

		$product_permalink = apply_filters(
			'woocommerce_cart_item_permalink',
			$cart_item_product->is_visible() ? $cart_item_product->get_permalink( $cart_item ) : '',
			$cart_item,
			$cart_item_key
		);

		$template_args = array(
			'attributes'        => array(),
			'product_title'     => $cart_item_product->get_title(),
			'product_permalink' => $product_permalink,
		);

		$item_data = array();

		// Variation values are shown only if they are not found in the title as of 3.0.
		// This is because variation titles display the attributes.
		if ( $args['product']->get_type() === 'variable' && is_array( $cart_item['variation'] ) ) {
			foreach ( $cart_item['variation'] as $name => $value ) {
				$taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

				if ( taxonomy_exists( $taxonomy ) ) {
					// If this is a term slug, get the term's nice name.
					$term = get_term_by( 'slug', $value, $taxonomy );
					if ( ! is_wp_error( $term ) && $term && $term->name ) {
						$value = $term->name;
					}
					$label = wc_attribute_label( $taxonomy );
				} else {
					// If this is a custom option slug, get the options name.
					$value = apply_filters( 'woocommerce_variation_option_name', $value, null, $taxonomy, $cart_item['data'] );
					$label = wc_attribute_label( str_replace( 'attribute_', '', $name ), $cart_item['data'] );
				}

				if ( empty( $label ) || empty( $value ) ) {
					continue;
				}

				$item_data[] = $label . ': ' . $value;
			}
		}

		$template_args['aattributes'] = ( is_array( $item_data ) && ! empty( $item_data ) ) ? implode( ', ', $item_data ) : '';

		addonify_floating_cart_get_template(
			'cart-loop/title.php',
			apply_filters(
				'addonify_floating_cart_product_title_template_args',
				$template_args
			)
		);
	}

	add_action( 'addonify_floating_cart_product_title', 'addonify_floating_cart_get_product_title_template' );
}


if ( ! function_exists( 'addonify_floating_cart_sidebar_cart_notice_template' ) ) {
	/**
	 * Display cart action notice before the products list.
	 *
	 * @since 1.0.0
	 */
	function addonify_floating_cart_sidebar_cart_notice_template() {

		addonify_floating_cart_get_template( 'cart-sections/notice.php', array() );
	}

	add_action( 'addonify_floating_cart_sidebar_cart_notice', 'addonify_floating_cart_sidebar_cart_notice_template' );
}


if ( ! function_exists( 'addonify_floating_cart_display_items_count' ) ) {
	/**
	 * Renders cart quantity count.
	 *
	 * @since 1.2.4
	 *
	 * @param int    $cart_items_count Cart items count.
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_display_items_count( $cart_items_count, $strings_from_setting ) {

		$item_counter_singular_text = esc_html__( 'Item', 'addonify-floating-cart' );
		$item_counter_plural_text   = esc_html__( 'Items', 'addonify-floating-cart' );

		if ( '1' === $strings_from_setting ) {

			$saved_item_counter_singular_text = addonify_floating_cart_get_option( 'item_counter_singular_text' );
			if ( $saved_item_counter_singular_text ) {
				$item_counter_singular_text = $saved_item_counter_singular_text;
			}

			$saved_item_counter_plural_text = addonify_floating_cart_get_option( 'item_counter_plural_text' );
			if ( $saved_item_counter_plural_text ) {
				$item_counter_plural_text = $saved_item_counter_plural_text;
			}
		}
		?>
		<span class="adfy__woofc-badge">
			<?php
			if ( 1 === $cart_items_count ) {
				echo esc_html( number_format_i18n( $cart_items_count ) . ' ' . $item_counter_singular_text );
			} else {
				echo esc_html( number_format_i18n( $cart_items_count ) . ' ' . $item_counter_plural_text );
			}
			?>
		</span>
		<?php
	}
}


if ( ! function_exists( 'addonify_floating_cart_empty_template' ) ) {
	/**
	 * Renders empty cart template.
	 *
	 * @since 1.2.6
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_empty_template( $strings_from_setting ) {

		$empty_cart_text = esc_html__( 'Your cart is currently empty.', 'addonify-floating-cart' );
		if ( '1' === $strings_from_setting ) {
			$saved_empty_cart_text = addonify_floating_cart_get_option( 'empty_cart_text' );
			if ( $saved_empty_cart_text ) {
				$empty_cart_text = $saved_empty_cart_text;
			}
		}
		?>
		<div id="adfy__woofc_empty_cart_section">
			<?php
			if ( addonify_floating_cart_get_option( 'display_empty_cart_icon' ) === '1' ) {
				?>
				<div id="adfy__woofc_empty_cart_icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.95,6.99l-.88,4.39c-.42,2.1-2.27,3.62-4.41,3.62H6.02c.25,1.71,1.73,3,3.46,3h10.02c.28,0,.5,.22,.5,.5s-.22,.5-.5,.5H9.48c-2.23,0-4.15-1.67-4.46-3.88L3.24,2.29c-.1-.74-.74-1.29-1.49-1.29H.5c-.28,0-.5-.22-.5-.5S.22,0,.5,0H1.76c1.24,0,2.31,.93,2.48,2.16l.26,1.84h6.01c.28,0,.5,.22,.5,.5s-.22,.5-.5,.5H4.63l1.25,9h12.78c1.66,0,3.11-1.18,3.43-2.81l.88-4.39c.09-.44-.03-.9-.31-1.25-.29-.35-.71-.55-1.16-.55h-5c-.28,0-.5-.22-.5-.5s.22-.5,.5-.5h5c.75,0,1.46,.33,1.93,.92,.48,.58,.67,1.34,.52,2.08Zm-14.95,15.01c0,1.1-.9,2-2,2s-2-.9-2-2,.9-2,2-2,2,.9,2,2Zm-1,0c0-.55-.45-1-1-1s-1,.45-1,1,.45,1,1,1,1-.45,1-1Zm11,0c0,1.1-.9,2-2,2s-2-.9-2-2,.9-2,2-2,2,.9,2,2Zm-1,0c0-.55-.45-1-1-1s-1,.45-1,1,.45,1,1,1,1-.45,1-1ZM10.34,7.63c-.2-.19-.52-.17-.71,.03-.19,.2-.17,.52,.03,.71l2.07,1.9c.49,.49,1.13,.73,1.77,.73s1.27-.24,1.75-.72l2.09-1.91c.2-.19,.22-.5,.03-.71-.19-.2-.5-.22-.71-.03l-2.1,1.93c-.16,.16-.36,.28-.56,.35V.5c0-.28-.22-.5-.5-.5s-.5,.22-.5,.5V9.91c-.21-.07-.41-.2-.58-.36l-2.09-1.91Z"></path></svg>
				</div>
				<?php
			}
			?>
			<p id="adfy__woofc_empty_cart_text"><?php echo esc_html( $empty_cart_text ); ?></p>
		</div>
		<?php
	}

	add_action( 'addonify_floating_cart_render_empty_cart', 'addonify_floating_cart_empty_template' );
}


if ( ! function_exists( 'addonify_floating_cart_coupon_shipping_modal_close_button_template' ) ) {
	/**
	 * Renders coupon and shipping modal close button.
	 *
	 * @since 1.2.6
	 *
	 * @param string $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_coupon_shipping_modal_close_button_template( $strings_from_setting ) {

		$modal_close_label = esc_html__( 'Go Back', 'addonify-floating-cart' );

		if ( '1' === $strings_from_setting ) {
			$saved_modal_close_label = addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' );
			if ( $saved_modal_close_label ) {
				$modal_close_label = $saved_modal_close_label;
			}
		}
		?>
		<button class="adfy__woofc-fake-button" id="adfy__woofc-hide-shipping-container">
			<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
			</svg>
			<?php echo esc_html( $modal_close_label ); ?>
		</button>
		<?php
	}

	add_action(
		'addonify_floating_cart_coupon_shipping_modal_close_button',
		'addonify_floating_cart_coupon_shipping_modal_close_button_template'
	);
}
