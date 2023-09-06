export class dispatchCustomEvent {

    constructor() {

        this.eventHandle = "addonifyFloatingCart";
    }

    /**
    * Cart opened.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static cartOpened(event) {

        $(document).trigger(this.eventHandle + "Opened", event);

        document.dispatchEvent(new CustomEvent(this.eventHandle + "Opened", { detail: event }));
    }

    /**
    * Cart closed.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static cartClosed(event) {

        $(document).trigger(this.eventHandle + "Closed", event);

        document.dispatchEvent(new CustomEvent(this.eventHandle + "Closed", { detail: event }));
    }

    /**
    * Cart updated.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static cartUpdated(event) {

        // [.... code block]
    }

    /**
    * Coupon applied.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static couponApplied(event) {

        // [.... code block]
    }

    /**
    * Coupon removed.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static couponRemoved(event) {

        // [.... code block]
    }

    /**
    * Shipping address updated.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static shippingAddressUpdated(event) {

        // [.... code block]
    }


    /**
    * Shopping meter threshold reached.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    static thresholdReached(event) {

    }
}