(function ($) {

    'use strict';

    var addonifyFloatingCartCouponContainer = $('#adfy__woofc-coupon-container');
    var addonifyFloatingCartNotifyShow = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyShow == 1;
    var addonifyFloatingCartNotifyDuration = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyDuration;
    var addonifyFloatingCartNotifyDismissible = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyDismissible == 1;
    var addonifyFloatingCartNotifyShowHtmlContent = addonifyFloatingCartJSObject.displayToastNotificationButton == 1;
    var addonifyFloatingCartNotifyMessage = addonifyFloatingCartJSObject.addonifyFloatingCartNotifyMessage;
    var addonifyFloatingCartNotifyPosition = addonifyFloatingCartJSObject.toast_notification_display_position.split("-");

    var addonifyFloatingCartOpenCartOnAdd = addonifyFloatingCartJSObject.open_cart_modal_immediately_after_add_to_cart;
    var addonifyFloatingCartOpenCartOnClickOnViewCart = addonifyFloatingCartJSObject.open_cart_modal_after_click_on_view_cart;

    var product_name;

    var subtotalEle = $('.adfy__woofc-cart-summary ul li.sub-total');
    var discountEle = $('.adfy__woofc-cart-summary ul li.discount');
    var footerEle = $('.adfy__woofc-colophon');
    var shoppingMeterEle = $('.adfy__woofc-shipping-bar');
    var cartSummaryEle = $('.adfy__woofc-cart-summary');

    var addonifyFloatingCart = {

        init: function () {

            this.showFloatingCartHandler();
            this.hideFloatingCartHandler();
            this.quantityFormInputHandler();
            this.handleFloatingCartCoupon();
            this.notifyFloatingCartEventHandler();
            this.handleCartItems();
        },

        showFloatingCartHandler: () => {

            $(document).on('click', '.adfy__show-woofc', function () {

                document.body.classList.add('adfy__woofc-visible');
            });
            $(document).on('click','.added_to_cart.wc-forward', function(e){

                if(addonifyFloatingCartOpenCartOnClickOnViewCart == true){
                    e.preventDefault();
                    document.body.classList.add('adfy__woofc-visible');
                }
            });

            $( document.body ).on( 'added_to_cart', function(e, fragments, cart_hash, button) {

                if(addonifyFloatingCartOpenCartOnAdd === true){
                    document.body.classList.add('adfy__woofc-visible');
                }

                $('#adfy__woofc-cart-errors').html('');

                if ( footerEle.hasClass('adfy__woofc-hidden') ) {
                    footerEle.removeClass('adfy__woofc-hidden');
                }

                if ( cartSummaryEle.hasClass('discount') ) {
                    var subtotalEle = $('.adfy__woofc-cart-summary li.sub-total');
                    var discountEle = $('.adfy__woofc-cart-summary li.discount');
                    if ( subtotalEle.hasClass('adfy__woofc-hidden') ) {
                        subtotalEle.removeClass('adfy__woofc-hidden');
                    }
                    if ( discountEle.hasClass('adfy__woofc-hidden') ) {
                        discountEle.removeClass('adfy__woofc-hidden');
                    }
                }

                if ( shoppingMeterEle.hasClass('adfy__woofc-hidden') ) {
                    shoppingMeterEle.removeClass('adfy__woofc-hidden');
                }                
            });

            $(document.body).on('wc_cart_emptied', function(event){

                footerEle.addClass('adfy__woofc-hidden');
                shoppingMeterEle.addClass('adfy__woofc-hidden');
            });
        },

        hideFloatingCartHandler: () => {

            $(document).on('click', '.adfy__hide-woofc', function () {

                document.body.classList.remove('adfy__woofc-visible');
            });
        },

        /**
        *
        * Notification system event handler.
        * Since: 1.0.0
        */

        notifyFloatingCartEventHandler: () => {

            var notfyHtmlContent = addonifyFloatingCartNotifyShowHtmlContent ? addonifyFloatingCartJSObject.toastNotificationButton : "";

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
            $(document).on('added_to_cart', function (event, data) {
                if (addonifyFloatingCartNotifyShow) {
                    product_name = data.product.charAt(0).toUpperCase() + data.product.slice(1);
                    // Invoke the Notyf toast. Append the product name here.
                    var notification = notyf.success({

                        className: 'adfy__woofc-notfy-success',
                        //background: '#111111',
                        message: addonifyFloatingCartNotifyMessage.replace('{product_name}',product_name) + " " + notfyHtmlContent,
                    });
                    notification.on('click', function ({ target, event }) {
                        // target: the notification being clicked
                        // event: the mouseevent
                        if(addonifyFloatingCartNotifyShowHtmlContent){
                            $('body').addClass('adfy__woofc-visible');
                        }
                    });
                }
            });
        },

        quantityFormInputHandler: () => {

            // increase product quantity
            $(document).on('click', '.adfy__woofc-item .adfy__woofc-inc-quantity', function (e) {
                e.preventDefault();
                let input_field = $(this).next();
                if(parseInt(input_field.val()) < parseInt(input_field.attr('max')) || input_field.attr('max') == ''){
                    AddonifyUpdateCartAjax(this, 'add');
                }
            });

            //decrease product quantity
            $(document).on('click', '.adfy__woofc-item .adfy__woofc-dec-quantity', function (e) {
                e.preventDefault();
                let input_field = $(this).prev();
                if(parseInt(input_field.val()) <= parseInt(input_field.attr('min'))){
                    return;
                }
                AddonifyUpdateCartAjax(this, 'sub');
            });

            //manual update product quantity
            $(document).on('change', '.adfy__woofc-item .adfy__woofc-quantity-input-field', function (e) {
                e.preventDefault();
                AddonifyUpdateCartAjax(this, 'update', $(this).val());
            });

            // product quantity update function
            function AddonifyUpdateCartAjax(curr_el, type, quantity = 1) {
                var product_quantity;
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

        },

        handleFloatingCartCoupon: () => {

            $(document).on('click', '#adfy__woofc-coupon-trigger', function () {

                addonifyFloatingCartCouponContainer.attr('data_display', 'visible');
            })
            $(document).on('click', '#adfy__woofc-hide-coupon-container', function () {

                addonifyFloatingCartCouponContainer.attr('data_display', 'hidden');
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
                        console.log(result);
                        if (result.couponApplied === true) {
                            couponField.val('');
                            $.each(result.html, function (i, val) {
                                $(i).replaceWith(val);
                            })
                            show_coupon_alert_success(result.status);

                            $(document.body).trigger( 'applied_coupon', [ data ] );

                            if(result.appliedCoupons > 0 && subtotalEle.hasClass('adfy__woofc-hidden') && discountEle.hasClass('adfy__woofc-hidden')) {
                                subtotalEle.removeClass('adfy__woofc-hidden');
                                discountEle.removeClass('adfy__woofc-hidden')
                            }
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
            $(document).on('click', '.adfy__woofc-remove-applied-coupon-button', function () {
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
                        if (result.couponRemoved === true) {
                            $.each(result.html, function (i, val) {
                                $(i).replaceWith(val);
                            });
                            $( document.body ).trigger( 'removed_coupon', [ coupon ] );
                            show_coupon_alert_success(result.status);
                            if(result.appliedCoupons === 0 && ! subtotalEle.hasClass('adfy__woofc-hidden') && ! discountEle.hasClass('adfy__woofc-hidden')) {
                                subtotalEle.addClass('adfy__woofc-hidden');
                                discountEle.addClass('adfy__woofc-hidden')
                            }
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

        },

        handleCartItems: () => {

            // remove product from cart
            $(document).on('click', '.adfy__woofc-item .thumb .product-remove', function (e) {
                e.preventDefault();

                var product_id = $(this).attr("data-product_id"),
                    cart_item_key = $(this).attr("data-cart_item_key"),
                    product_container = $(this).parents('.adfy__woofc-item');

                var $thisbutton = $(this);

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

                        if ( ! response || response.success === false ) {
                            $('#adfy__woofc-cart-errors').html(response.message);
                            return;
                        }

                        $('.post-'+product_id).find('a.wc-forward').remove();
                        $('.post-'+product_id).find('a.add_to_cart_button').removeClass('added');

                        var fragments = response.fragments;

                        // Replace fragments
                        if (fragments) {
                            $.each(fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });
                        }

                        $('#adfy__woofc-cart-errors').html(response.undo_product_link);

                        if (response.cart_items_count === 0 ) {

                            $(document.body).trigger('wc_cart_emptied');
                            $('.adfy__woofc-content-entry').html( response.empty_cart_message );
                        }

                        $(document.body).trigger( 'removed_from_cart', [ response.fragments, response.cart_hash, $thisbutton ] )

                        // Update cart
                        $(document.body).trigger('wc_update_cart');
                    },
                    error: function (a) {
                        console.log("Error processing request");
                    }
                });
            });

            //restore item to cart
            $(document).on('click', '#adfy__woofc_restore_item', function (e) {
                e.preventDefault();
                let item_key = $(this).attr('data-item_key');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: addonifyFloatingCartJSObject.ajax_url,
                    data: {
                        action: addonifyFloatingCartJSObject.ajax_restore_in_cart_action,
                        cart_item_key: item_key,
                        nonce: addonifyFloatingCartJSObject.nonce
                    },
                    success: function (response) {
                        if (!response)
                            return;
                        
                        // Replace fragments
                        if (response.fragments) {
                            $.each(response.fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });
                        }

                        // $(document.body).trigger('added_to_cart', [response.fragments]);

                        if ( footerEle.hasClass('adfy__woofc-hidden') ) {
                            footerEle.removeClass('adfy__woofc-hidden');
                        }

                        if ( shoppingMeterEle.hasClass('adfy__woofc-hidden') ) {
                            shoppingMeterEle.removeClass('adfy__woofc-hidden');
                        }

                        $('#adfy__woofc-cart-errors').html('');

                        if(response.error){
                            console.log(response.messsage);
                        }
                    }
                });
            });
        }
    }

    $(document).ready(function () {

        addonifyFloatingCart.init();
        $('.adfy__woofc-alert').hide();
    });

})(jQuery);
