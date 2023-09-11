import {
    showNotfy,
    notyfDuration,
    notfyIsDismissible,
    notfyPosition
} from 'src/js/global/localize.data.js';

import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { action } = AFC;

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

                // Check if notification toast is enabled in backend.
                if (style === 'success') {

                    if (showNotfy) {

                        notyf.success({
                            className: 'adfy__woofc-notfy-success',
                            message: data,
                        })
                    }
                }

                // Do not disable error notification toast.
                if (style === 'error') {

                    notyf.error({

                        className: 'adfy__woofc-notfy-error',
                        message: data,
                    })
                }
            }
        }
    }
}