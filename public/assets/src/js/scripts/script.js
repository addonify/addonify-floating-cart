(function ($) {

    'use strict';

    var addonifyFloatingCartCouponContainer = $('#adfy__woofc-coupon-container');
    var addonifyFloatingCartNotifyShow = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyShow == 1 ? true : false;
    var addonifyFloatingCartNotifyDuration = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyDuration;
    var addonifyFloatingCartNotifyDismissible = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyDismissible == 1 ? true : false;
    var addonifyFloatingCartNotifyShowHtmlContent = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyShowHtmlContent == 1 ? true : false;
    var addonifyFloatingCartNotifyMessage = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyMessage;
    var addonifyFloatingCartNotifyPosition = addonifyFloatingCartJSObject.toast_notification_display_position.split("-");

    var addonifyFloatingCart = {

        init: function () {

            this.showFloatingCartHandler();
            this.hideFloatingCartHandler();
            this.quantityFormInputHandler();
            this.handleFloatingCartCoupon();
            this.notifyFloatingCartEventHandler();
        },

        showFloatingCartHandler: () => {

            $(document).on('click', '.adfy__show-woofc', function () {

                document.body.classList.add('adfy__woofc-visible');
            })
        },

        hideFloatingCartHandler: () => {

            $(document).on('click', '.adfy__hide-woofc', function () {

                document.body.classList.remove('adfy__woofc-visible');
            })
        },


        /**
        *
        * Notification system event handler.
        * Since: 1.0.0
        */

        notifyFloatingCartEventHandler: () => {

            var notfyHtmlContent = addonifyFloatingCartNotifyShowHtmlContent ? "<button class='adfy__show-woofc adfy__woofc-fake-button adfy__woofc-notfy-button'>Show Cart</button>" : "";

            // Configure Notyf.
            var notyf = new Notyf({
                duration: addonifyFloatingCartNotifyDuration,
                dismissible: addonifyFloatingCartNotifyDismissible,
                ripple: true,
                position: {

                    x: addonifyFloatingCartNotifyPosition[1], // left | center | right
                    y: addonifyFloatingCartNotifyPosition[0], // top | center | bottom
                },
            });

            // Listen to WooCommerce product added to cart event.
            $(document).on('added_to_cart', function (event) {
                if (addonifyFloatingCartNotifyShow) {
                    // Invoke the Notyf toast. Append the product name here.
                    var notification = notyf.success({

                        className: 'adfy__woofc-notfy-success',
                        //background: '#111111',
                        message: addonifyFloatingCartNotifyMessage + " " + notfyHtmlContent,
                    });
                    notification.on('click', function ({ target, event }) {
                        // target: the notification being clicked
                        // event: the mouseevent
                        $('body').addClass('adfy__woofc-visible');
                    });
                }
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

            $(document).on('click', '#adfy__woofc-coupon-trigger', function () {

                addonifyFloatingCartCouponContainer.attr('data_display', 'visible');
            })
            $(document).on('click', '#adfy__woofc-hide-coupon-container', function () {

                addonifyFloatingCartCouponContainer.attr('data_display', 'hidden');
            });

            // var showCouponFormEle = $('#adfy__woofc-coupon-trigger');
            // var hideCouponFormEle = $('#adfy__woofc-hide-coupon-container');
            var couponFormSubmitButtonEle = $('#adfy__woofc-apply-coupon-button');
            // Handle the form submit event.
            $(couponFormSubmitButtonEle).on('click', function (e) {

                // e.preventDefault();
                console.log('📌 Coupon form submit button is clicked.');
            })
        },
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
        $('.adfy__woofc-alert').hide();
    });


    // remove product from cart
    $(document).on('click', '.adfy__woofc-item .thumb .product-remove', function (e) {
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
                this_product.closest('div.adfy__woofc-item').remove();

                if (response.cart_items == 0) {
                    $('.adfy__woofc-content-entry').html(
                        response.no_data_html
                    );
                }

                // Update cart
                $(document.body).trigger('wc_update_cart');
            },
            error: function (a) {
                console.log("Error processing request");
            }
        });
    });

    // increase product quantity
    $(document).on('click', '.adfy__woofc-item .adfy__woofc-inc-quantity', function (e) {
        e.preventDefault();
        AddonifyUpdateCartAjax(this, 'add');
    });

    //decrease product quantity
    $(document).on('click', '.adfy__woofc-item .adfy__woofc-dec-quantity', function (e) {
        e.preventDefault();
        AddonifyUpdateCartAjax(this, 'sub');
    });

    //manual update product quantity
    $(document).on('change', '.adfy__woofc-item .adfy__woofc-quantity-input-field', function (e) {
        e.preventDefault();
        AddonifyUpdateCartAjax(this, 'update', $(this).val());
    });

    // apply coupon on cart items
    $(document).on('submit', '#adfy__woofc-coupon-form', function (e) {
        e.preventDefault();
        let couponField = $(this).find('input[name=adfy__woofc-coupon-input-field]');
        let data = couponField.val();
        $.ajax({
            'url': addonifyFloatingCartJSObject.ajax_url,
            'method': 'post',
            'data': {
                action: addonifyFloatingCartJSObject.ajax_apply_coupon,
                nonce: addonifyFloatingCartJSObject.nonce,
                form_data: data
            },
            'success': function (data) {
                let result = JSON.parse(data);
                if (result.couponApplied == true) {
                    couponField.val('');
                    $.each(result.html, function (i, val) {
                        $(i).replaceWith(val);
                    })
                    show_coupon_alert_success(result.status);
                } else {
                    show_coupon_alert_error(result.status);
                }
            },
            'error': function (e) {
                alert('Error processing request');
            }
        });
    });

    // remove applied coupon from cart
    $(document).on('click', '.removeCoupon', function () {
        let coupon_div = $(this).closest('li');
        let coupon = $(this).attr('data-coupon');
        $.ajax({
            'url': addonifyFloatingCartJSObject.ajax_url,
            'method': 'post',
            'data': {
                action: addonifyFloatingCartJSObject.ajax_remove_coupon,
                nonce: addonifyFloatingCartJSObject.nonce,
                form_data: coupon
            },
            'success': function (data) {
                let result = JSON.parse(data);
                console.log(result);
                if (result.couponRemoved == true) {
                    $.each(result.html, function (i, val) {
                        $(i).replaceWith(val);
                    })
                    show_coupon_alert_success(result.status);
                } else {
                    show_coupon_alert_error(result.status);
                }
                coupon_div.remove();
            },
            'error': function (e) {
                alert('Error processing request');
            }
        });
    });

    // product quantity update function
    function AddonifyUpdateCartAjax(curr_el, type, quantity = 1) {
        let product_quantity
        if (type === 'add') {
            product_quantity = $(curr_el).next();
        } else if (type === 'sub') {
            product_quantity = $(curr_el).prev();
        } else {
            product_quantity = $(curr_el);
        }
        var product_id = $(curr_el).attr("data-product_id"),
            cart_item_key = $(curr_el).attr("data-cart_item_key"),
            product_container = $(curr_el).parents('.adfy__woofc-item');

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
                type: type,
                quantity: quantity
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
                let nQuantity = response.nQuantity;
                if (nQuantity === 'OoS') {
                    alert('Out of stock range');
                    product_quantity.val(nQuantity);
                } else if (nQuantity !== 'nil') {
                    if (type === 'add') {
                        product_quantity.val(nQuantity);
                    } else if (type === 'sub') {
                        product_quantity.val(nQuantity);
                    } else {
                        product_quantity.val(nQuantity);
                    }
                }

                product_container.find($('.adfy__woofc-item-price-multiplier-quantity')).html(nQuantity);

                product_container.unblock();

                // Update cart
                $(document.body).trigger('wc_update_cart');
            },
            error: function (a) {
                console.log("Error processing request");
            }
        });
    }

    //show coupon apply success alert message
    function show_coupon_alert_success(msg = false) {
        if (msg !== false) {
            $('.adfy__woofc-alert.success').html(
                `<p class="adfy__woofc-alert-text">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    `+ msg + `
                </p>`
            );
        }
        $('.adfy__woofc-alert.success').fadeIn();
        setTimeout(function () {
            $('.adfy__woofc-alert.success').fadeOut();
        }, 3000);
    }
    //show coupon apply failure alert message
    function show_coupon_alert_error(msg = false) {
        if (msg !== false) {
            $('.adfy__woofc-alert.error').html(
                `<p class="adfy__woofc-alert-text">
                    <svg fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    `+ msg + `
                </p>`
            );
        }
        $('.adfy__woofc-alert.error').fadeIn();
        setTimeout(function () {
            $('.adfy__woofc-alert.error').fadeOut();
        }, 3000);
    }

})(jQuery);