import { openCartOnAddedToCart } from "src/js/global/localize.data";
import { Helpers } from "src/js/utilities/common.helpers";

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

            Helpers.openCartHandler(e);
        }
    });

    $(document.body).on('wc_cart_emptied', function (event) {


    });
}