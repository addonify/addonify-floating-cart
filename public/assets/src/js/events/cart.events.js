import { Helpers } from "src/js/utilities/common.helpers";
import { openCartOnViewCartClicked, openCartOnTriggerHover } from "src/js/global/localize.data";

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

        Helpers.openCartHandler(e)
    });

    if (openCartOnTriggerHover) {

        $(document).on('mouseover', '.adfy__show-woofc', function (e) {

            Helpers.openCartHandler(e);
        });
    }

    if (openCartOnViewCartClicked) {

        $(document).on('click', '.added_to_cart.wc-forward', function (e) {

            Helpers.openCartHandler(e);
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

        Helpers.closeCartHandler(e);
    });
}
