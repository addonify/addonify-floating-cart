import {
    showNotfy,
    notyfDuration,
    notfyIsDismissible,
    notfyPosition,
    notfyShowHTMLContent,
    notfyMessage,
    notfyButton
} from 'src/js/global/localize.data.js';

import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { action } = AFC;

/**
 * Register toast event.
 *
 * @return {void} void.
 * @since 1.2.1
 */
export function registerToastEvent() {

    action.toast = {

        /**
        * Dispatch notification toast messages.
        *
        * @param {string} style. [success | error]
        * @param {string} data. may also contain HTML.
        * @since: 1.1.9
        */
        dispatch: (style = 'success', data) => {

            if (typeof Notyf !== 'undefined') {

                let notyf = new Notyf({
                    duration: notyfDuration,
                    dismissible: notfyIsDismissible,
                    ripple: true,
                    position: {
                        x: notfyPosition[1], // left | center | right
                        y: notfyPosition[0], // top | center | bottom
                    },
                });

                if (!data) {

                    throw new Error("Notification toast data/message is empty, bailing out...");
                }

                // Do not disable error notification toast.
                if (style === 'error') {

                    notyf.error({

                        className: 'adfy__woofc-notfy-error',
                        message: data,
                    })
                }

                // Check if notification toast is enabled in backend.
                if (showNotfy) {

                    if (style === 'success') {

                        notyf.success({
                            className: 'adfy__woofc-notfy-success',
                            message: data,
                        })
                    }
                }
            }
        }
    }
}

/**
 * Handle toast message.
 * Alternative way to dispatch toast with custom message.
 *
 * @param {object} data.
 * @return {void} void.
 * @since 1.2.1
 */
export function handleCustomToastContent(data) {

    if (!data || typeof data !== 'object') {

        throw new Error('Toast message data invalid!');
    }

    if (data && typeof data === 'object') {

        let toastContent;
        let productName;

        if (Object.hasOwn(data, "product")) {

            productName = data.product.charAt(0).toUpperCase() + data.product.slice(1);

        } else {

            productName = __('Product', 'addonify-floating-cart');
        }

        if (notfyShowHTMLContent) {

            // Add button to toast content.
            toastContent = notfyMessage.replace('{product_name}', productName) + " " + notfyButton;

        } else {

            toastContent = notfyMessage.replace('{product_name}', productName);
        }

        // Done with the content manipulation, now dispatch toast.
        AFC.action.toast.dispatch('success', toastContent);
    }
}