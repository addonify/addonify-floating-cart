import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { openCartOnTriggerHover, openCartOnViewCartClicked, hideTriggerButtonIfCartIsEmpty } from "src/js/global/localize.data";
import { handleProgressbarAnimation } from "src/js/components/shopping-meter";
import { setTriggerButtonVisibility } from "src/js/components/trigger";

const { $ } = AFC;

export function listenCartEvents() {

    /**
    * Prevent default event.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on('click', '.adfy__woofc-prevent-default', function (e) {

        e.preventDefault();
    });

    /**
    * Listen for cart open events.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on("click", ".adfy__show-woofc", function (e) {

        AFC.action.cart.open(e);
    });

    if (openCartOnTriggerHover) {

        $(document).on('mouseover', '.adfy__show-woofc', function (e) {

            AFC.action.cart.open(e);
        });
    }

    if (openCartOnViewCartClicked) {

        $(document).on('click', '.added_to_cart.wc-forward', function (e) {

            AFC.action.cart.open(e);
        });
    }

    /**
    * Listen for cart close event.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on("click", ".adfy__hide-woofc", function (e) {

        e.preventDefault();

        AFC.action.cart.close(e);
    });


    /**
    * Listen to cart updated event.
    * Trigger by internal API.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    document.addEventListener("addonifyFloatingCartUpdated", () => {

        /**
        * Always check shopping meter animation once "addonifyFloatingCartUpdated"
        * event is detected.
        *
        * @since 1.2.1
        */
        handleProgressbarAnimation();
    });

    /**
    * Listen to cart item restored event.
    * Trigger by internal API.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    document.addEventListener("addonifyFloatingCartItemRestored", () => {

        // Display trigger button if it was hidden initially.
        if (hideTriggerButtonIfCartIsEmpty) {

            setTriggerButtonVisibility('show');
        }
    });
}