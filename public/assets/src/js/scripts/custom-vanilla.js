'use strict';

document.addEventListener('DOMContentLoaded', function () {

    let body = document.body;
    let triggerFloatingCartEle = document.querySelectorAll('.adfy__show-woofc');
    let closeFloatingCartEle = document.querySelectorAll('.adfy__hide-woofc');
    let floatingCartVisbilityBodyCass = 'adfy__woofc-visible';

    let addonifyFloatingCart = {

        init: function () {

            this.showFloatingCartHandler();
            this.hideFloatingCartHandler();
            this.handlePerfectScrollBar();
        },

        showFloatingCartHandler: () => {

            if (triggerFloatingCartEle.length > 0) {

                triggerFloatingCartEle.forEach(function (showWooFCEle) {

                    showWooFCEle.addEventListener('click', function (e) {

                        e.preventDefault();
                        body.classList.add(floatingCartVisbilityBodyCass);
                        console.log('📌 Show trigger is clicked. => ' + `"${floatingCartVisbilityBodyCass}"` + ' class is added to the body.');
                    });
                });
            }
        },

        hideFloatingCartHandler: () => {

            if (closeFloatingCartEle.length > 0) {

                closeFloatingCartEle.forEach(function (hideWooFCEle) {

                    hideWooFCEle.addEventListener('click', function (e) {

                        e.preventDefault();
                        body.classList.remove(floatingCartVisbilityBodyCass);
                        console.log('📌 Hide trigger is clicked. => ' + `"${floatingCartVisbilityBodyCass}"` + ' class is removed from the body.');
                    });
                });
            }
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

    addonifyFloatingCart.init();
});

