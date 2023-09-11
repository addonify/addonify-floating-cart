import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import { ajaxUrl, refreshCartFragmentsAction, nonce } from "src/js/global/localize.data";

const { $, action, api } = AFC;

export function registerCartActionEvents() {

    action.cart = {

        /**
        * Handle cart open event.
        *
        * @param {*} e 
        * @return {void} void.
        * @since 1.0.0
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
        }
    };

    action.trigger = function (action) {

        const buttonEle = document.getElementById("adfy__toggle-woofc");

        if (
            (action !== '') &&
            (buttonEle) &&
            (buttonEle.hasAttribute('data_display'))
        ) {
            if (action === 'hide') {

                buttonEle.setAttribute('data_display', 'hidden');
            }

            if (action === 'show') {

                buttonEle.setAttribute('data_display', 'visible');
            }
        }
    }
}

/**
* Refresh cart fragments.
*
* @param {null} null.
* @return {void} void.
* @since 1.0.0
*/
export const refreshCart = async () => {
    try {
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
    }
}
