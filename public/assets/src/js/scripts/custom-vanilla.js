'use strict';

document.addEventListener('DOMContentLoaded', function () {

    let body = document.querySelector('body');
    let triggerFloatingCartEle = document.querySelectorAll('.adfy__show-woofc');
    let closeFloatingCartEle = document.querySelectorAll('.adfy__hide-woofc');
    let cartVisbilityBodyCass = 'adfy__woofc-visible';

    let addonifyFloatingCart = {

        init: function () {

            this.triggerClickHandler();
            this.hideFloatingCartHandler();
        },

        triggerClickHandler: () => {

            if (triggerFloatingCartEle.length > 0) {

                triggerFloatingCartEle.forEach(function (triggerFloatingCart) {

                    triggerFloatingCart.addEventListener('click', function (e) {

                        e.preventDefault();
                        body.classList.add(cartVisbilityBodyCass);
                        console.log("👉 Show trigger is clicked & adfy__woofc-is-visible class is added to body.");
                    });
                });
            }
        },

        hideFloatingCartHandler: () => {

            if (closeFloatingCartEle.length > 0) {

                closeFloatingCartEle.forEach(function (triggerHideFoatingCart) {

                    triggerHideFoatingCart.addEventListener('click', function (e) {

                        e.preventDefault();
                        body.classList.remove(cartVisbilityBodyCass);
                        console.log("👉 Hide trigger is clicked & adfy__woofc-is-visible class is removed from body.");
                    });
                });
            }
        }
    }

    addonifyFloatingCart.init();
});

