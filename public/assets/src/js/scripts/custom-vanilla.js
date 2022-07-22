'use strict';

document.addEventListener('DOMContentLoaded', function () {

    let body = document.body;
    let triggerFloatingCartEle = document.querySelectorAll('.adfy__show-woofc');
    let closeFloatingCartEle = document.querySelectorAll('.adfy__hide-woofc');
    let floatingCartVisbilityBodyCass = 'adfy__woofc-visible';

    let addonifyFloatingCart = {

        init: function () {

            // this.showFloatingCartHandler();
            // this.hideFloatingCartHandler();
            // this.handlePerfectScrollBar();
        },

        handlePerfectScrollBar: () => {

            let scrollableContainer = document.getElementById('adfy__woofc-scrollbar');

            if (scrollableContainer) {

                new PerfectScrollbar(scrollableContainer, {

                    wheelPropagation: true,
                    minScrollbarLength: 20
                });
            }
        },
    }

    // addonifyFloatingCart.init();
});

