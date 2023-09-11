import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";

const { $ } = AFC;

/**
* Handle shopping meter animation.
* 
* @param {null} null.
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