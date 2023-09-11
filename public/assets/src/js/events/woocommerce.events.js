import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { openCartOnAddedToCart } from "src/js/global/localize.data";

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

    $(document.body).on('wc_cart_emptied', function (event) {


    });
}