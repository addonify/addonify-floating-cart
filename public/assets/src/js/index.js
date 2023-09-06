"use strict";

import { listenCartEvents } from 'src/js/events/cart.events.js';
import { listenWooCommerceEvents } from 'src/js/events/woocommerce.events.js';
import { loadCartScrollbar } from 'src/js/components/scrollbar';

/**
* Main object.
* Includes all the functions that's required to run the plugin.
*
* @since 1.0.0
*/
const addonifyFloatingCart = {
    initJqueryScripts: function () {
        listenCartEvents();
        listenWooCommerceEvents();
    },
    initVanillaScripts: function () {
        loadCartScrollbar();
    }
};

/**
* "DOMContentLoaded" event listener.
* Vanilla JS.
*
* @since 1.0.0
*/
document.addEventListener('DOMContentLoaded', function () {
    addonifyFloatingCart.initVanillaScripts();
});

/**
* Document ready function.
* jQuery.
*
* @since 1.0.0
*/
(function ($) {
    $(document).ready(function () {
        addonifyFloatingCart.initJqueryScripts();
    });
})(jQuery)