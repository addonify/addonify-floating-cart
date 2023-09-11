import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { openCartOnAddedToCart, hideTriggerButtonIfCartIsEmpty } from "src/js/global/localize.data";
import { setTriggerButtonVisibility } from "src/js/components/trigger";

const { $ } = AFC;

export function listenWooCommerceEvents() {

    /**
    * Listen to WooCommerce events.
    *
    * @param {object} event.
    * @return {void} void.
    * @since 1.0.0
    */
    $(document).on("added_to_cart", function (e, fragments, cart_hash, button) {

        if (openCartOnAddedToCart) {

            AFC.action.cart.open(e);
        }
    });

    $(document).on('wc_cart_emptied', function (e) {

        // Hide the trigger button if cart is empty.
        if (hideTriggerButtonIfCartIsEmpty) {

            setTriggerButtonVisibility("hide");
        }
    });
}