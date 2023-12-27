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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param mixed $args Shipping template arguments.
	 */
	function addonify_floating_cart_get_sidebar_cart_shipping_template( $args = array() ) {

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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
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
	 * @param array $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_footer_checkout_button_template( $strings_from_setting ) {

		$checkout_button_label = esc_html__( 'Checkout', 'addonify-floating-cart' );
		if ( '1' === $strings_from_setting ) {
			$saved_checkout_button_label = addonify_floating_cart_get_optoin( 'checkout_button_label' );
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
	 * @param int   $cart_items_count Cart items count.
	 * @param array $strings_from_setting Strings enabled from setting.
	 */
	function addonify_floating_cart_display_items_count( $cart_items_count, $strings_from_setting ) {

		$item_counter_singular_text = esc_html__( 'Item', 'addonify-floating-cart' );
		$item_counter_plural_text   = esc_html__( 'Items', 'addonify-floating-cart' );

		if ( '1' === $strings_from_setting ) {

			$saved_item_counter_singular_text = addonify_floating_cart_get_optoin( 'item_counter_singular_text' );
			if ( $saved_item_counter_singular_text ) {
				$item_counter_singular_text = $saved_item_counter_singular_text;
			}

			$saved_item_counter_plural_text = addonify_floating_cart_get_optoin( 'item_counter_plural_text' );
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
