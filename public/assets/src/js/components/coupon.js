import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import {
    nonce,
    ajaxUrl,
    ajaxApplyCouponCodeAction,
    ajaxRemoveCouponCodeAction
} from "src/js/global/localize.data";
import { couponAlertVisibilityHandler, audoHideCouponAlerts } from "src/js/utilities/alert.helpers";
import { setSpinnerVisibility } from "src/js/components/spinner";

const { $ } = AFC;

/**
 * Open close coupon container.
 * 
 * @return {void} void.
 * @since 1.0.0
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
 * @since 1.0.0
 */
export function applyCouponHandler() {

    const { __ } = wp.i18n;
    let message;

    // Apply coupon on cart items.
    $(document).on('submit', '#adfy__woofc-coupon-form', function (e) {

        e.preventDefault();

        // Display spinner.
        setSpinnerVisibility("show");

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

                if (!res) {

                    message = __('Error processing coupon request.', 'addonify-floating-cart');

                    // Display coupon alert messages.
                    couponAlertVisibilityHandler('show', {
                        style: 'error',
                        message: message
                    });

                    return;
                }

                const { couponApplied, html } = res;

                if (couponApplied) {

                    couponField.val('');

                    // Dispatch 'couponApplied' event.
                    AFC.api.event.couponApplied(res);
                }

                $.each(html, function (i, val) {

                    $(i).replaceWith(val);
                });

                audoHideCouponAlerts();
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
            },
            complete: function () {

                // Hide spinner.
                setSpinnerVisibility("hide");
            }
        });
    });
}

/**
 * Handle coupon remove event via AJAX.
 * 
 * @return {void} void.
 * @since 1.0.0
 */
export function removeCouponHandler() {

    const { __ } = wp.i18n;
    let message;

    $(document).on('click', '.adfy__woofc-remove-applied-coupon-button', function (e) {

        e.preventDefault();

        // Display spinner.
        setSpinnerVisibility("show");

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

                if (!res) {

                    message = __('Error processing coupon request.', 'addonify-floating-cart');

                    couponAlertVisibilityHandler('show', {
                        style: 'error',
                        message: message
                    });

                    return;
                }

                const { couponRemoved, html } = res;

                if (couponRemoved) {

                    // Remove coupon element.
                    couponEle.remove();

                    // Dispatch 'couponRemoved' event.
                    AFC.api.event.couponRemoved(res);
                }

                $.each(html, function (i, val) {

                    $(i).replaceWith(val);
                });

                audoHideCouponAlerts();
            },
            error: function (err) {

                console.log(err);

                message = __('Error processing coupon request.', 'addonify-floating-cart');

                couponAlertVisibilityHandler('show', {
                    style: 'error',
                    message: message
                });
            },
            complete: function () {

                // Hide spinner.
                setSpinnerVisibility("hide");
            }
        });
    });
}