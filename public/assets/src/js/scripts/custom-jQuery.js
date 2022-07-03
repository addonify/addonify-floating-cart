(function ($) {

    'use strict';

    var addonifyFloatingCart = {

        init: function () {

            this.notifyFloatingCartEventHandler();
            this.quantityFormInputHandler();
        },

        /**
        *
        * Notification system event handler.
        * Since: 1.0.0
        */

        notifyFloatingCartEventHandler: () => {

            /**
            *
            * Listen to WooCommerce product added to cart event.
            */

            var notyf = new Notyf({
                duration: 5000,
                dismissible: true,
                ripple: true,
                position: {

                    x: 'right', // left | center | right
                    y: 'top', // top | center | bottom
                },
            });

            $(document).on('added_to_cart', function (event) {

                // Invoke the Notyf toast. Append the product name here.
                notyf.success('Product has been added to cart.');
            });
        },

        quantityFormInputHandler: () => {

            var increaseQuantity = $('#adfy__floating-cart .adfy__woofc-inc-quantity');
            var decreaseQuantity = $('#adfy__floating-cart .adfy__woofc-dec-quantity');
            var steps = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('step');
            var value = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('value');
        }
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
    });

})(jQuery);