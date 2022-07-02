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

            var toastClassName = 'adfy__woofc-toast-notification';

            //var notyf = new $.notyf({
            //    duration: 5000,
            //    className: toastClassName,
            //    dismissible: true,
            //    ripple: true,
            //    position: {

            //        x: 'right', // left | center | right
            //        y: 'top', // top | center | bottom
            //    },
            //});

            //$(document).on('added_to_cart', function (event) {

            //    // Invoke the notify toast.
            //    notyf.success(`<strong>${event.originalEvent.detail.product_name}</strong> has been added to your cart.`);
            //});
        }
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
    });

})(jQuery);