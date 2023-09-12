import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { openCartOnTriggerHover, openCartOnViewCartClicked, hideTriggerButtonIfCartIsEmpty } from "src/js/global/localize.data";
import { handleProgressbarAnimation } from "src/js/components/shopping-meter";
import { setTriggerButtonVisibility } from "src/js/components/trigger";

const { $ } = AFC;

export function listenCartEvents() {

    /**
    * Prevent default event.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on('click', '.adfy__woofc-prevent-default', function (e) {

        e.preventDefault();
    });

    /**
    * Listen for cart open events.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on("click", ".adfy__show-woofc", function (e) {

        AFC.action.cart.open(e);
    });

    /**
    * Listen for mouse over event on trigger button.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on('mouseover', '.adfy__show-woofc', function (e) {

        if (openCartOnTriggerHover) {

            AFC.action.cart.open(e);
        }
    });

    /**
    * Listen for "view cart button" click event.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on('click', '.added_to_cart.wc-forward', function (e) {

        if (openCartOnViewCartClicked) {

            e.preventDefault();

            AFC.action.cart.open(e);
        }
    });

    /**
    * Listen for cart close event.
    *
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
    * @return {void} void.
    * @since 1.2.1
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
    *
    * @return {void} void.
    * @since 1.2.1
    */
    document.addEventListener("addonifyFloatingCartItemRestored", () => {

        // Display trigger button if it was hidden initially.
        if (hideTriggerButtonIfCartIsEmpty) {

            setTriggerButtonVisibility('show');
        }
    });
}