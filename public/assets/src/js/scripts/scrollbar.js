'use strict';

const init = {

    /**
    * 
    * Function to initialize the scrollbar.
    *
    * @since: 1.0.9
    */

    scrollbar: () => {

        let scrollableEle = document.getElementById('adfy__woofc-scrollbar');

        if ((scrollableEle !== null) && (scrollableEle !== undefined)) {

            new SimpleBar(scrollableEle, {
                autoHide: false,
                clickOnTrack: true,
            });
        }
    },

    /**
    *
    * Function to observe the cart using mutation observer.
    *
    * @since: 1.0.9
    */

    observeCart: () => {

        const targetEle = document.getElementById('adfy__floating-cart');

        const config = { attributes: false, childList: true, subtree: true };

        const callback = (mutationList) => {

            for (const mutation of mutationList) {

                if (mutation.type === "childList") {

                    /**
                    *
                    * Initialize the scrollbar.
                    */

                    init.scrollbar();
                }
            }
        };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(callback);

        // Start observing the target node for configured mutations
        observer.observe(targetEle, config);
    }
}


/**
*
* DOMContentLoaded event listener.
*
* @since: 1.0.9
*/

document.addEventListener('DOMContentLoaded', init.observeCart());