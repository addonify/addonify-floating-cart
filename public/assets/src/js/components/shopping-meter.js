import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { $ } = AFC;

/**
* Set shopping meter progress bar visibility.
* 
* @param {action} action. [show|hide]
* @return {void} void.
* @since 1.1.8
*/
export function setShoppingMeterVisibility(action) {

    if (!action) {

        throw new Error("Function [setShoppingMeterVisibility] requires action!");
    }

    const meterEle = $('#adfy__floating-cart .adfy__woofc-shipping-bar');

    if (meterEle.length > 0) {

        if (action === "hide") {

            meterEle.addClass("adfy__woofc-hidden");

        } else {

            meterEle.removeClass("adfy__woofc-hidden");
        }
    }
}

/**
* Handle shopping meter animation.
* 
* @return {void} void.
* @since 1.1.8
*/
export const handleProgressbarAnimation = () => {

    const progressbarEle = $('#adfy__floating-cart .adfy__woofc-shipping-bar .progress-bars .live-progress-bar');

    if (progressbarEle) {

        const attrVal = parseInt(progressbarEle.attr('data_percentage'));

        if (attrVal >= 100) {

            progressbarEle.addClass("hide-animation");

            // Dispatch event, threshold reached.
            AFC.api.event.shoppingMeterThresholdReached();

        } else {

            progressbarEle.removeClass("hide-animation")
        }
    }
}