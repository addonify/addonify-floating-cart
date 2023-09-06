import { dispatchCustomEvent } from "src/js/api/custom-events";

export class Helpers {

    constructor() { }

    /**
    * Handle cart open event.
    *
    * @param {*} e 
    * @return {void} void.
    * @since 1.0.0
    */
    static openCartHandler(e) {

        e.preventDefault();

        $('body').addClass('adfy__woofc-visible');

        dispatchCustomEvent.cartOpened(e);
    }

    /**
    * Handle close open event.
    *
    * @param {*} e 
    * @return {void} void.
    * @since 1.0.0
    */
    static closeCartHandler(e) {

        e.preventDefault();

        $('body').removeClass('adfy__woofc-visible');

        dispatchCustomEvent.cartClosed(e);
    }

    /**
    * Refresh cart.
    *
    * @return {void} void.
    * @since 1.0.0
    */
    static refreshCart() {

    }

    /**
    * Handle cart trigger button events.
    *
    * @param {string} action. hide | show.
    * @return {void} void.
    * @since 1.0.0
    */
    static displayHideCartTriggerBtn(action) {

        const buttonEle = document.getElementById("adfy__woofc-trigger");

        if (
            (action !== '') &&
            (buttonEle !== null) &&
            (buttonEle !== undefined) &&
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