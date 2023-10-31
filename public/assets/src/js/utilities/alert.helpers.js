import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { $ } = AFC;

let timeoutId;

/**
* Display/Hide alert messages.
*
* @param {string} action to perform. (show | hide)
* @param {string} style of alert message. (info | error)
* @param {string} data, may also contain HTML.
* @since: 1.1.9
*/
export function alertVisibilityHandler(action = "hide", style = "info", data = "") {

    const alertEle = $("#adfy__floating-cart #adfy__woofc-cart-errors");

    const hideAlert = () => {

        if (timeoutId) {

            clearTimeout(timeoutId);
        }

        if (alertEle.hasClass('error')) {

            alertEle.removeClass('error');
        }

        alertEle.html(" ").addClass('hidden');
    }

    const showAlert = () => {

        if (timeoutId) {

            clearTimeout(timeoutId);
        }

        if (style === "error") {

            alertEle.addClass("error")
        }

        alertEle.html(" ").html(data).removeClass('hidden');

        timeoutId = setTimeout(() => hideAlert(), 10000);
    }

    if (action === "hide") {

        hideAlert();

    } else {

        if (data.length > 0) {

            showAlert();
        }
    }
}

/**
* Display/Hide coupon alert messages.
*
* @param {string} action. - (hide | show)
* @param {object} data. - (style, message).
* @return {void} void.
* @since: 1.1.9
*/
export function couponAlertVisibilityHandler(action, data = null) {

    if (!action) {

        throw new Error("Coupon alert action is required!");
    }

    let alertsEle = $('#adfy__floating-cart .adfy__woofc-alert');

    const hideAlert = () => {

        let timeout;

        clearTimeout(timeout);

        timeout = setTimeout(() => {

            $(alertsEle).fadeOut();

            clearTimeout(timeout);

        }, 10000);
    }

    if (action === "hide") {

        hideAlert();
        return;

    } else {

        if (alertsEle.length > 0) {

            const icons = {
                "success": '<svg fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></svg>',
                "error": '<svg fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></svg>'
            };

            if (!data) {

                throw new Error("Coupon alert data is required!");
            }

            const { style, message } = data;

            if (!style || !message) {

                throw new Error("Coupon alert style & message is required!");
            }

            let content;

            switch (style) {
                case "success":
                    content = `<p class="adfy__woofc-alert-text">
                        ${icons['success']}
                        ${message}
                    </p>`;

                    $('.adfy__woofc-alert.success').html(" ").html(content).fadeIn();
                    hideAlert();
                    break;

                case "error":
                    content = `<p class="adfy__woofc-alert-text">
                        ${icons['error']}
                        ${message}
                    </p>`;

                    $('.adfy__woofc-alert.error').html(" ").html(content).fadeIn();
                    hideAlert();
                    break;

                default:
                    break;
            }
        }
    }
}