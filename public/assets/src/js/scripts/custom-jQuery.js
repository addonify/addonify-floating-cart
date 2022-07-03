(function ($) {

    'use strict';

    var addonifyFloatingCart = {

        init: function () {

            this.notifyFloatingCartEventHandler();
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
                className: 'adfy__woofc-toast-notification',
                dismissible: true,
                ripple: true,
                position: {

                    x: 'right', // left | center | right
                    y: 'top', // top | center | bottom
                },
            });

            $(document).on('added_to_cart', function (event) {

                // Invoke the Notyf toast.
                notyf.success('Product has been added to cart.');
            });
        }
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
    });

})(jQuery);