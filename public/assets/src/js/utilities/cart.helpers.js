import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { ajaxUrl, refreshCartFragmentsAction, nonce } from "src/js/global/localize.data";
import { setSpinnerVisibility } from "src/js/components/spinner";

const { $, action, api } = AFC;

export function registerCartActionEvents() {

    action.cart = {

        /**
        * Handle cart open event.
        *
        * @param {*} e 
        * @return {void} void.
        * @since 1.2.1
        */
        open: (e) => {

            e.preventDefault();

            $("body").addClass("adfy__woofc-visible");

            // Dispatch custom event.
            api.event.cartOpened(e);
        },

        /**
        * Handle close open event.
        *
        * @param {*} e 
        * @return {void} void.
        * @since 1.0.0
        */
        close: (e) => {

            e.preventDefault();

            $("body").removeClass("adfy__woofc-visible");

            // Dispatch custom event.
            api.event.cartClosed(e);
        },

        /**
        * Handle cart refresh.
        *
        * @return {void} void.
        * @since 1.2.1
        */
        refresh: () => {

            refreshCart();
        }
    };
}

/**
* Refresh cart fragments.
*
* @return {void} void.
* @since 1.0.0
*/
export const refreshCart = async () => {
    try {
        setSpinnerVisibility('show');
        const { fragments } = await $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxUrl,
            data: {
                action: refreshCartFragmentsAction,
                nonce: nonce,
            },
        });

        if (!fragments) {

            throw new Error('Fragments not fetched! aborting...');
        }

        // Replace fragments.
        $.each(fragments, function (key, value) {
            $(key).replaceWith(value);
        });

        // Update cart.
        $(document).trigger('wc_update_cart');

        // Dispatch event cart updated. Since 1.2.1
        AFC.api.event.cartUpdated(fragments);

    } catch (err) {
        throw new Error(err);
    } finally {
        setSpinnerVisibility('hide');
    }
}
