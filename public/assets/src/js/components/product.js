import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import {
    nonce,
    ajaxUrl,
    ajaxUpdateCartAction,
    ajaxRemoveFromCartAction,
    ajaxRestoreCartItemAction
} from "src/js/global/localize.data";
import { alertVisibilityHandler } from "src/js/utilities/alert.helpers";
import { setSpinnerVisibility } from "src/js/components/spinner";

const { $ } = AFC;
const { __ } = wp.i18n;

/**
* Handles quantity adjustment in cart.
*
* @return {void} void.
* @since: 1.0.0
*/
export function listenProductQtyFormEvents() {

    // Handle quantity increment event.
    $(document).on('click', '.adfy__woofc-item .adfy__woofc-inc-quantity', function (e) {

        e.preventDefault();

        const inputField = $(this).prev();

        if (
            parseInt(inputField.val()) < parseInt(inputField.attr('max')) ||
            inputField.attr('max') === ''
        ) {
            updateProductQtyViaAjax(this, 'add');
        }
    });

    // Handle quantity decrement event.
    $(document).on('click', '.adfy__woofc-item .adfy__woofc-dec-quantity', function (e) {

        e.preventDefault();

        const inputField = $(this).next();

        if (parseInt(inputField.val()) <= parseInt(inputField.attr('min'))) {
            return;
        }

        updateProductQtyViaAjax(this, 'sub');
    });

    // Handle manual quantity input event.
    $(document).on('change', '.adfy__woofc-item .adfy__woofc-quantity-input-field', function (e) {

        e.preventDefault();
        updateProductQtyViaAjax(this, 'update', $(this).val());
    });
}

/**
* Handles remove product from cart.
*
* @return {void} void.
* @since: 1.0.0
*/
export function listenProductRemoveEvents() {

    $(document).on('click', '.adfy__woofc-item .thumb .product-remove', function (e) {

        e.preventDefault();

        const productId = $(this).attr("data-product_id");
        const cartItemKey = $(this).attr("data-cart_item_key");
        const thisButton = $(this);

        // Display spinner.
        setSpinnerVisibility("show");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxUrl,
            data: {
                action: ajaxRemoveFromCartAction,
                product_id: productId,
                cart_item_key: cartItemKey,
                nonce: nonce
            },
            success: function (res) {

                if (!res || res.error) {

                    throw new Error("Error removing product from cart!");
                }

                $('.post-' + productId).find('a.wc-forward').remove();
                $('.post-' + productId).find('a.add_to_cart_button').removeClass('added');

                let fragments = res.fragments;

                // Replace the fragments.
                if (fragments) {

                    $.each(fragments, function (key, value) {

                        $(key).replaceWith(value);
                    });
                }

                // Fire the alert message.
                alertVisibilityHandler('show', 'info', res.undo_product_link);

                if (res.cart_items_count === 0) {

                    // Dispatch cartEmptied event.
                    AFC.api.event.cartEmptied();

                    $('.adfy__woofc-content-entry').html(res.empty_cart_message);
                }

                // Dispatch removed_from_cart event.
                $(document).trigger('removed_from_cart', [res.fragments, res.cart_hash, thisButton]);

                // Dispatch WC event.
                $(document).trigger('wc_update_cart');

                // Dispatch event cart updated.
                AFC.api.event.cartUpdated(res);
            },
            error: function (err) {

                console.log(err);
                const message = __('Error processing product removal request!', 'addonify-floating-cart');
                // Dispatch toast notification.
                AFC.action.toast.dispatch('error', message);
            },
            complete: function () {

                // Remove spinner.
                setSpinnerVisibility("hide");
            }
        })
    });
}

/**
* Restore product to cart event.
*
* @return {void} void.
* @since: 1.0.0
*/
export function listenProductRestoreEvents() {

    $(document).on('click', '#adfy__woofc_restore_item', function (e) {

        e.preventDefault();

        const itemKey = $(this).attr('data-item_key');

        // Add spinner.
        setSpinnerVisibility('show');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxUrl,
            data: {
                action: ajaxRestoreCartItemAction,
                cart_item_key: itemKey,
                nonce: nonce
            },
            success: function (res) {

                if (!res.fragments || res.error) throw new Error("Error restoring product to cart!");

                const fragments = res.fragments;
                const cartFooterEle = $('.adfy__woofc-colophon');
                const shoppingMeterEle = $('.adfy__woofc-shipping-bar');

                if (fragments) {

                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }

                if (cartFooterEle.hasClass('adfy__woofc-hidden')) {
                    cartFooterEle.removeClass('adfy__woofc-hidden');
                }

                if (shoppingMeterEle.hasClass('adfy__woofc-hidden')) {
                    shoppingMeterEle.removeClass('adfy__woofc-hidden');
                }

                // Dispatch event product restored.
                AFC.api.event.productRestored(fragments);

                // Hide alert messages if any.
                alertVisibilityHandler("hide");
            },
            error: function (err) {
                console.log(err);
                const message = __('Error processing product restore request!', 'addonify-floating-cart');
                // Dispatch toast notification.
                AFC.action.toast.dispatch('error', message);
            },
            complete: function () {
                // Hide spinner.
                setSpinnerVisibility('hide');
            }
        });
    });
}

/**
* Update cart qty via AJAX.
*
* @param {string} currentEle.
* @param {string} action.
* @param {number} quantity.
* @return {void} void.
* @since 1.0.0
*/
function updateProductQtyViaAjax(currentEle, action, quantity = 1) {

    if (!currentEle) {

        throw new Error("Function [updateCartViaAjax] requires current element!");
    }

    if (!action) {

        throw new Error("Function [updateCartViaAjax] requires action!");
    }

    let productQuantity;

    switch (action) {
        case "add":
            productQuantity = $(currentEle).next();
            break;
        case "sub":
            productQuantity = $(currentEle).prev();
            break;
        default:
            productQuantity = $(currentEle);
    }

    let productId = $(currentEle).attr("data-product_id");
    let cartItemKey = $(currentEle).attr("data-cart_item_key");
    let productContainer = $(currentEle).parents('.adfy__woofc-item');

    // Add loader
    setSpinnerVisibility('show');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajaxUrl,
        data: {
            action: ajaxUpdateCartAction,
            product_id: productId,
            cart_item_key: cartItemKey,
            nonce: nonce,
            type: action,
            quantity: quantity
        },
        success: function (res) {

            if (!res || res.error) {

                throw new Error("Error updating cart via AJAX!");
            }

            let fragments = res.fragments;

            // Replace the cart fragments.
            if (fragments) {
                $.each(fragments, function (key, value) {
                    $(key).replaceWith(value);
                });
            }

            let nQuantity = res.nQuantity;

            if (nQuantity === 'OoS') {
                alert('Out of stock range');
                productQuantity.val(nQuantity);
            } else if (nQuantity !== 'nil') {
                if (action === 'add') {
                    productQuantity.val(nQuantity);
                } else if (action === 'sub') {
                    productQuantity.val(nQuantity);
                } else {
                    productQuantity.val(nQuantity);
                }
            }

            productContainer.find($('.adfy__woofc-item-price-multiplier-quantity')).html(nQuantity);

            productContainer.unblock();

            // Update cart
            $(document.body).trigger('wc_update_cart');

            // Dispatch event cart updated.
            AFC.api.event.cartUpdated(res);
        },
        error: function (err) {

            const { __ } = wp.i18n;
            const message = __('Error processing cart update request!', 'addonify-floating-cart');
            // Dispatch toast notification.
            AFC.action.toast.dispatch('error', message);
            throw new Error(err);
        },
        complete: function () {
            // Remove loader
            setSpinnerVisibility('hide');
        }
    });
}