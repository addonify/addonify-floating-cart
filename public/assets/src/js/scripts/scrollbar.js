'use strict';

const init = {

    /**
    * 
    * Function to initialize the scrollbar.
    *
    * @since: 1.0.9
    */

    scrollbar: () => {

        const scrollableEle = document.getElementById('adfy__woofc-scrollbar');
        const psInitiliazed = scrollableEle.classList.contains('ps');

        //console.log(psInitiliazed);

        if ((scrollableEle !== null) && (scrollableEle !== undefined)) {

            if (psInitiliazed === false) {

                new PerfectScrollbar(scrollableEle, {

                    wheelSpeed: 1,
                    wheelPropagation: true,
                    minScrollbarLength: 20
                });

                //console.log('PerfectScrollbar initialized!', new Date());
            }
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

            if (mutationList.length > 0) {

                /**
                *
                * Initialize the scrollbar.
                */

                init.scrollbar();
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

document.addEventListener('DOMContentLoaded', () => init.observeCart());