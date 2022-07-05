(function ($) {

    'use strict';

    var addonifyFloatingCartEle = $('#adfy__floating-cart');
    var addonifyFloatingCartCouponContainer = $('#adfy__woofc-coupon-container');

    var addonifyFloatingCart = {

        init: function () {

            this.notifyFloatingCartEventHandler();
            this.quantityFormInputHandler();
            this.handleFloatingCartCoupon();
        },

        /**
        *
        * Notification system event handler.
        * Since: 1.0.0
        */

        notifyFloatingCartEventHandler: () => {

            // Configure Notyf.
            var notyf = new Notyf({
                duration: 5000,
                dismissible: true,
                ripple: true,
                position: {

                    x: 'right', // left | center | right
                    y: 'top', // top | center | bottom
                },
            });

            // Listen to WooCommerce product added to cart event.
            $(document).on('added_to_cart', function (event) {

                // Invoke the Notyf toast. Append the product name here.
                notyf.success('Product has been added to cart.');
            });
        },

        quantityFormInputHandler: () => {

            var quantityInput = $('#adfy__floating-cart .adfy__woofc-quantity-input-button');
            var increaseQuantity = $('#adfy__floating-cart .adfy__woofc-inc-quantity');
            var decreaseQuantity = $('#adfy__floating-cart .adfy__woofc-dec-quantity');
            var steps = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('step');
            var value = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('value');

            // Handle the click event.
            $(quantityInput).on('click', function (e) {

                e.preventDefault();
            });
        },

        handleFloatingCartCoupon: () => {

            var showCouponFormEle = $('#adfy__woofc-coupon-trigger');
            var hideCouponFormEle = $('#adfy__woofc-hide-coupon-container');

            // Handle the show click event.
            $(showCouponFormEle).on('click', function (e) {

                e.preventDefault();
                // Change attribute value.
                addonifyFloatingCartCouponContainer.attr('data_display', 'visible');
            });

            // Handle the hide event.
            $(hideCouponFormEle).on('click', (e) => {

                e.preventDefault();
                // Change attribute value.
                addonifyFloatingCartCouponContainer.attr('data_display', 'hidden');
            })
        },
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
    });

})(jQuery);