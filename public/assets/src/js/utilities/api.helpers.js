import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { $, api } = AFC;

export function registerCustomEventsDispatchers() {

    api.event = {

        /**
        * Cart opened.
        *
        * @param {object} event.
        * @return {void} void.
        * @since 1.2.2
        */
        cartOpened: (event) => {

            $(document).trigger("addonifyFloatingCartOpened");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartOpened"));
        },

        /**
        * Cart closed.
        *
        * @param {object} event.
        * @return {void} void.
        * @since 1.2.2
        */
        cartClosed: (event) => {

            $(document).trigger("addonifyFloatingCartClosed");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartClosed"));
        },

        /**
        * Cart updated.
        * Main event for cart changes. This event is triggered when any cart related changes occurs.
        *
        * @param {object} event.
        * @return {void} void.
        * @since 1.2.2
        */
        cartUpdated: (event) => {

            $(document).trigger("addonifyFloatingCartUpdated", event);

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartUpdated", {
                detail: event
            }));
        },

        /**
        * Cart emptied.
        * Main event triggered when cart is emptied.
        *
        * @return {void} void.
        * @since 1.2.2
        */
        cartEmptied: () => {

            $(document).trigger("addonifyFloatingCartEmptied");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartEmptied"));

            // Also trigger WooCommerce event.
            $(document).trigger('wc_cart_emptied');
        },

        /**
        * Product removed from cart.
        *
        * @param {object} event.
        * @return {void} void.
        * @since 1.2.2
        */
        productRemoved: (event) => {

            $(document).trigger("addonifyFloatingCartProductRemoved", event);

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartProductRemoved", {
                detail: event
            }));

            // Also, triggers event cart updated.
            AFC.api.event.cartUpdated(data);
        },

        /**
        * Product restored to cart.
        *
        * @param {object} data.
        * @return {void} void.
        * @since 1.2.2
        */
        productRestored: (data) => {

            $(document).trigger("addonifyFloatingCartProductRestored", data);

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartProductRestored", {
                detail: data
            }));

            // Also, triggers event cart updated.
            AFC.api.event.cartUpdated(data);
        },

        /**
        * Coupon modal opened.
        *
        * @return {void} void.
        * @since 1.2.2
        */
        couponModalOpened: () => {

            $(document).trigger("addonifyFloatingCartCouponModalOpened");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartCouponModalOpened"));
        },

        /**
        * Coupon modal closed.
        *
        * @return {void} void.
        * @since 1.2.2
        */
        couponModalClosed: () => {

            $(document).trigger("addonifyFloatingCartCouponModalClosed");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartCouponModalClosed"));
        },

        /**
        * Coupon applied.
        *
        * @param {object} data.
        * @return {void} void.
        * @since 1.2.2
        */
        couponApplied: (data) => {

            $(document).trigger("addonifyFloatingCartCouponApplied", data);

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartCouponApplied", {
                detail: data
            }));

            // Also trigger cart updated event.
            AFC.api.event.cartUpdated(data);
        },

        /**
        * Coupon removed.
        *
        * @param {object} data.
        * @return {void} void.
        * @since 1.2.2
        */
        couponRemoved: (data) => {

            $(document).trigger("addonifyFloatingCartCouponRemoved", data);

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartCouponRemoved", {
                detail: data
            }));

            // Also trigger cart updated event.
            AFC.api.event.cartUpdated(data);
        },

        /**
        * Shipping address updated.
        *
        * @param {object} event.
        * @return {void} void.
        * @since 1.2.2
        */
        shippingAddressUpdated: (event) => {

            // [.... code block]
        },


        /**
        * Shopping meter threshold reached.
        *
        * @param {null} null.
        * @return {void} void.
        * @since 1.2.2
        */
        shoppingMeterThresholdReached: () => {

            $(document).trigger("addonifyFloatingCartShoppingMeterThresholdReached");

            document.dispatchEvent(new CustomEvent("addonifyFloatingCartShoppingMeterThresholdReached"));
        }
    }
}



