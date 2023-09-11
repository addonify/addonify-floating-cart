import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import {
    nonce,
    ajaxUrl,
    ajaxApplyCouponCodeAction,
    ajaxRemoveCouponCodeAction
} from "src/js/global/localize.data";
import { couponAlertVisibilityHandler } from "src/js/utilities/alert.helpers";

const { $ } = AFC;

/**
 * Open close coupon container.
 * 
 * @return {void} void.
 * @since 1.2.1
 */
export function listenCouponContainerEvents() {

    const couponContainer = $('#adfy__woofc-coupon-container');

    $(document).on('click', '#adfy__woofc-coupon-trigger', function (e) {

        e.preventDefault();

        couponContainer.attr('data_display', 'visible');

        // Dispatch 'couponModalOpened' event.
        AFC.api.event.couponModalOpened();
    });

    $(document).on('click', '#adfy__woofc-hide-coupon-container', function (e) {

        e.preventDefault();

        couponContainer.attr('data_display', 'hidden');

        // Dispatch 'couponModalClosed' event.
        AFC.api.event.couponModalClosed();
    });
}

/**
 * Handle coupon apply event via AJAX.
 * 
 * @return {void} void.
 * @since 1.2.1
 */
export function applyCouponHandler() {

    const { __ } = wp.i18n;
    let message;

    // Apply coupon on cart items.
    $(document).on('submit', '#adfy__woofc-coupon-form', function (e) {

        e.preventDefault();

        let couponField = $(this).find('input[name=adfy__woofc-coupon-input-field]');
        let data = couponField.val();

        $.ajax({
            'url': ajaxUrl,
            'method': 'post',
            'data': {
                action: ajaxApplyCouponCodeAction,
                nonce: nonce,
                form_data: data
            },
            success: function (res) {

                let result = JSON.parse(res);

                if (!result) {

                    message = __('Error processing coupon request.', 'addonify-floating-cart');
                    AFC.action.toast.dispatch('error', message);
                    return;
                }

                const { appliedCoupons, couponApplied, html, status } = result;
                const subtotalEle = $('.adfy__woofc-cart-summary ul li.sub-total');
                const discountEle = $('.adfy__woofc-cart-summary ul li.discount');

                if (!couponApplied) {

                    // Display coupon alert messages.
                    couponAlertVisibilityHandler('show', {
                        style: 'error',
                        message: status
                    });

                    return;
                }

                if (couponApplied) {

                    couponField.val('');

                    $.each(html, function (i, val) {

                        $(i).replaceWith(val);
                    });

                    // Display coupon alert messages.
                    couponAlertVisibilityHandler('show', {
                        style: 'success',
                        message: status
                    });

                    // Dispatch 'couponApplied' event.
                    AFC.api.event.couponApplied(result);

                    if (appliedCoupons > 0) {

                        subtotalEle.removeClass('adfy__woofc-hidden');
                        discountEle.removeClass('adfy__woofc-hidden')
                    }
                }
            },
            error: function (err) {

                console.log(err);
                message = __('Error processing coupon request.', 'addonify-floating-cart');

                // Dispatch toast.
                AFC.action.toast.dispatch('error', message);

                // Display coupon alert messages.
                couponAlertVisibilityHandler('show', {
                    style: 'error',
                    message: message
                });
            }
        });
    });
}

/**
 * Handle coupon remove event via AJAX.
 * 
 * @return {void} void.
 * @since 1.2.1
 */
export function removeCouponHandler() {

    const { __ } = wp.i18n;
    let message;

    $(document).on('click', '.adfy__woofc-remove-applied-coupon-button', function (e) {

        e.preventDefault();

        let couponEle = $(this).closest('li');
        let coupon = $(this).attr('data-coupon');

        $.ajax({
            'url': ajaxUrl,
            'method': 'post',
            'data': {
                action: ajaxRemoveCouponCodeAction,
                nonce: nonce,
                form_data: coupon
            },
            success: function (res) {

                let result = JSON.parse(res);

                console.log(result);

                if (!result) {

                    message = __('Error processing coupon request.', 'addonify-floating-cart');

                    couponAlertVisibilityHandler('show', {
                        style: 'error',
                        message: message
                    });

                    return;
                }

                const { appliedCoupons, couponRemoved, html, status } = result;

                if (couponRemoved) {

                    const subtotalEle = $('.adfy__woofc-cart-summary ul li.sub-total');
                    const discountEle = $('.adfy__woofc-cart-summary ul li.discount');

                    $.each(html, function (i, val) {

                        $(i).replaceWith(val);
                    });

                    couponAlertVisibilityHandler('show', {
                        style: 'success',
                        message: status
                    });

                    // Remove coupon element.
                    couponEle.remove();

                    // Dispatch 'couponRemoved' event.
                    AFC.api.event.couponRemoved(result);

                    if (appliedCoupons > 0) {

                        subtotalEle.removeClass('adfy__woofc-hidden');
                        discountEle.removeClass('adfy__woofc-hidden')
                    }
                }
            },
            error: function (err) {

                console.log(err);

                message = __('Error processing coupon request.', 'addonify-floating-cart');

                couponAlertVisibilityHandler('show', {
                    style: 'error',
                    message: message
                });
            }
        });
    });
}