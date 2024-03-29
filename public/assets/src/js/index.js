"use strict";

import { registerCartActionEvents, refreshCart } from 'src/js/utilities/cart.helpers';
import { registerCustomEventsDispatchers } from 'src/js/utilities/api.helpers';
import { registerToastEvent } from 'src/js/utilities/toast.helpers';

import { listenCartEvents } from 'src/js/events/cart.events';
import { listenWooCommerceEvents } from 'src/js/events/woocommerce.events';

import { initCustomScrollbar } from 'src/js/components/scrollbar';
import { listenProductQtyFormEvents, listenProductRemoveEvents, listenProductRestoreEvents } from 'src/js/components/product';
import { listenCouponContainerEvents, applyCouponHandler, removeCouponHandler } from 'src/js/components/coupon';
import { listenShippingContainerEvents, handleShippingAddressChange, handleShippingMethodChange } from 'src/js/components/shipping';

/**
* DOMContentLoaded event listener.
*
* @since 1.0.0
*/
document.addEventListener("DOMContentLoaded", function () {

    initCustomScrollbar();
});

/**
* jQuery self executing function.
*
* @since 1.2.2
*/
(function ($) {

    registerCartActionEvents();
    registerCustomEventsDispatchers();
    registerToastEvent();

    $(document).ready(function () {

        // Refresh cart.
        refreshCart();

        // Cart related events.
        listenCartEvents();
        listenWooCommerceEvents();

        // Product related events.
        listenProductQtyFormEvents();
        listenProductRemoveEvents();
        listenProductRestoreEvents();

        // Coupon related events.
        listenCouponContainerEvents();
        applyCouponHandler();
        removeCouponHandler();

        // Shipping related events.
        listenShippingContainerEvents();
        handleShippingAddressChange();
        handleShippingMethodChange();
    });

})(jQuery);

