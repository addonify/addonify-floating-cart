(function ($) {

    'use strict';

    var addonifyFloatingCartEle = $('#adfy__floating-cart');
    var addonifyFloatingCartCouponContainer = $('#adfy__woofc-coupon-container');

    var addonifyFloatingCart = {

        init: function () {

            this.notifyFloatingCartEventHandler();
            this.quantityFormInputHandler();
            this.handleFloatingCartCoupon();
        },

        /**
        *
        * Notification system event handler.
        * Since: 1.0.0
        */

        notifyFloatingCartEventHandler: () => {

            var notfyHtmlContent = "<button class='adfy__show-woofc adfy__woofc-fake-button adfy__woofc-notfy-button'>Show Cart</button>";

            // Configure Notyf.
            var notyf = new Notyf({
                duration: 5000,
                dismissible: true,
                ripple: true,
                position: {

                    x: 'right', // left | center | right
                    y: 'top', // top | center | bottom
                },
            });

            // Listen to WooCommerce product added to cart event.
            $(document).on('added_to_cart', function (event) {

                // Invoke the Notyf toast. Append the product name here.
                var notification = notyf.success({

                    className: 'adfy__woofc-notfy-success',
                    //background: '#111111',
                    message: "Product has been added to cart. " + notfyHtmlContent,
                });
                notification.on('click', function ({ target, event }) {
                    // target: the notification being clicked
                    // event: the mouseevent
                    $('body').addClass('adfy__woofc-visible');
                });
            });
        },

        quantityFormInputHandler: () => {

            var quantityInput = $('#adfy__floating-cart .adfy__woofc-quantity-input-button');
            var increaseQuantity = $('#adfy__floating-cart .adfy__woofc-inc-quantity');
            var decreaseQuantity = $('#adfy__floating-cart .adfy__woofc-dec-quantity');
            var steps = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('step');
            var value = $('#adfy__floating-cart .adfy__woofc-quantity-input-field').attr('value');

            // Handle the click event.
            $(quantityInput).on('click', function (e) {

                e.preventDefault();
            });
        },

        handleFloatingCartCoupon: () => {

            var showCouponFormEle = $('#adfy__woofc-coupon-trigger');
            var hideCouponFormEle = $('#adfy__woofc-hide-coupon-container');
            var couponFormSubmitButtonEle = $('#adfy__woofc-apply-coupon-button');

            // Handle the show click event.
            $(showCouponFormEle).on('click', function (e) {

                e.preventDefault();
                // Change attribute value.
                addonifyFloatingCartCouponContainer.attr('data_display', 'visible');
            });

            // Handle the hide event.
            $(hideCouponFormEle).on('click', function (e) {

                e.preventDefault();
                // Change attribute value.
                addonifyFloatingCartCouponContainer.attr('data_display', 'hidden');
            })

            // Handle the form submit event.
            $(couponFormSubmitButtonEle).on('click', function (e) {

                e.preventDefault();
                console.log('📌 Coupon form submit button is clicked.');
            })
        },
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();

        $(document.body).trigger('wc_fragment_refresh');

    });

    $(document).on('click', '.adfy__woofc-item .thumb .product-remove a.remove', function (e) {
        e.preventDefault();

        var product_id = $(this).attr("data-product_id"),
            cart_item_key = $(this).attr("data-cart_item_key"),
            product_container = $(this).parents('.adfy__woofc-item');

        let this_product = $(this);

        // Add loader
        product_container.block({
            message: null,
            overlayCSS: {
                cursor: 'none'
            }
        });
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: addonifyFloatingCartJSObject.ajax_url,
            data: {
                action: addonifyFloatingCartJSObject.ajax_remove_from_cart_action,
                product_id: product_id,
                cart_item_key: cart_item_key,
                nonce: addonifyFloatingCartJSObject.nonce
            },
            success: function (response) {
                if (!response || response.error)
                    return;

                var fragments = response.fragments;

                // Replace fragments
                if (fragments) {
                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }

                // Update cart
                $(document.body).trigger('wc_update_cart');
            }, 
            error: function(a){
                console.log("Error processing request");
            }
        });
    });

    let add_item = 0;
    let subtract_item = 0;

    $(document).on('click', '.adfy__woofc-item .adfy__woofc-inc-quantity', function (e) {
        e.preventDefault();

        var product_id = $(this).attr("data-product_id"),
            cart_item_key = $(this).attr("data-cart_item_key"),
            product_container = $(this).parents('.adfy__woofc-item');

        let this_product = $(this);

        // Add loader
        product_container.block({
            message: null,
            overlayCSS: {
                cursor: 'none'
            }
        });
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: addonifyFloatingCartJSObject.ajax_url,
            data: {
                action: addonifyFloatingCartJSObject.ajax_update_cart_item_action,
                product_id: product_id,
                cart_item_key: cart_item_key,
                nonce: addonifyFloatingCartJSObject.nonce,
                type: 'add'
            },
            success: function (response) {
                console.log(response.item_quantity);
                if (!response || response.error)
                    return;

                var fragments = response.fragments;

                // Replace fragments
                if (fragments) {
                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }

                // Update cart
                $(document.body).trigger('wc_update_cart');
            }, 
            error: function(a){
                console.log("Error processing request");
            }
        });
    });

    $(document).on('click', '.adfy__woofc-item .adfy__woofc-dec-quantity', function (e) {
        e.preventDefault();

        var product_id = $(this).attr("data-product_id"),
            cart_item_key = $(this).attr("data-cart_item_key"),
            product_container = $(this).parents('.adfy__woofc-item');

        let this_product = $(this);

        // Add loader
        product_container.block({
            message: null,
            overlayCSS: {
                cursor: 'none'
            }
        });
        debugger;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: addonifyFloatingCartJSObject.ajax_url,
            data: {
                action: addonifyFloatingCartJSObject.ajax_update_cart_item_action,
                product_id: product_id,
                cart_item_key: cart_item_key,
                nonce: addonifyFloatingCartJSObject.nonce,
                type: 'sub'
            },
            success: function (response) {
                if (!response || response.error)
                    return;

                var fragments = response.fragments;

                // Replace fragments
                if (fragments) {
                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }

                // Update cart
                $(document.body).trigger('wc_update_cart');
            }, 
            error: function(a){
                console.log("Error processing request");
            }
        });
    });

})(jQuery);