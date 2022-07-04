(function ($) {

    'use strict';

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

            // Handle the click event.
            var showCouponFormEle = $('#adfy__woofc-coupon-trigger');

            $(showCouponFormEle).on('click', function (e) {

                e.preventDefault();
                console.log('📌 Coupon trigger is clicked. Open the coupon form.');
            });

            // Handle the coupon form submit event.
        },
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
    });

})(jQuery);