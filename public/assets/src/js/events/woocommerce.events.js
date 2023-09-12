import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { setTriggerButtonVisibility } from "src/js/components/trigger";
import { alertVisibilityHandler } from "src/js/utilities/alert.helpers";
import { setCartColophonBlocksVisibility } from "src/js/components/colophon";
import { setShoppingMeterVisibility } from "src/js/components/shopping-meter";
import { handleCustomToastContent } from "src/js/utilities/toast.helpers";
import {
    showNotfy,
    openCartOnAddedToCart,
    hideTriggerButtonIfCartIsEmpty,
    openCartOnViewCartClicked
} from "src/js/global/localize.data";

const { $ } = AFC;

export function listenWooCommerceEvents() {

    /**
    * Listen to WooCommerce events.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on("added_to_cart", function (event, data) {

        if (openCartOnAddedToCart) {

            AFC.action.cart.open(event);
        }

        // Dispatch toast notification with custom content payload.
        if (showNotfy) {
            handleCustomToastContent(data);
        }

        // Hide all alert messages.
        alertVisibilityHandler("hide");

        // Display shopping meter.
        setShoppingMeterVisibility("show");

        // Show cart colophon.
        setCartColophonBlocksVisibility("show", {
            discountVisibility: "show",
            subTotalVisibility: "show"
        });

        // Dispatch cart event.
        AFC.api.event.cartUpdated(data);
    });

    $(document).on('click', '.added_to_cart.wc-forward', function (e) {

        if (openCartOnViewCartClicked) {

            e.preventDefault();

            AFC.action.cart.open(e);
        }
    });

    $(document).on('wc_cart_emptied', function (e) {

        // Hide the trigger button if cart is empty.
        if (hideTriggerButtonIfCartIsEmpty) {

            setTriggerButtonVisibility("hide");
        }

        // Display shopping meter.
        setShoppingMeterVisibility("hide");

        // Show cart colophon.
        setCartColophonBlocksVisibility("hide");

        // Dispatch event.
        AFC.api.event.cartUpdated(e);
    });
}