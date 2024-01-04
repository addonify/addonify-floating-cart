import { addonifyFloatingCart as AFC } from "src/js/global/addonify.floating.cart";
import {
    nonce,
    ajaxUrl,
    countriesToStates,
    ajaxUpdateShippingAddressAction,
    ajaxUpdateShippingMethodAction,
    isShippingAddressUpdatable
} from "src/js/global/localize.data";
import { setSpinnerVisibility } from "src/js/components/spinner";

const { $ } = AFC;

/**
 * Listen common shipping container events.
 * 
 * @return {void} void.
 * @since 1.0.0
 */
export function listenShippingContainerEvents() {

    $(document).on('click', '#adfy__woofc-shipping-trigger', function (e) {

        e.preventDefault();

        $('#adfy__woofc-shipping-container').attr('data_display', 'visible');

        // Dispatch event.
        AFC.api.event.shippingModalOpened();

        if ( isShippingAddressUpdatable === '1' ) {
            if ($('#addonify_floating_cart_shipping_country').length) {
                $('#addonify_floating_cart_shipping_country').selectWoo({
                    dropdownAutoWidth: false,
                    dropdownCssClass: 'afc-selectWoo-dropdown'
                });
            }

            if ($('select#addonify_floating_cart_shipping_state')){
                $('select#addonify_floating_cart_shipping_state').selectWoo({
                    dropdownAutoWidth: false,
                    dropdownCssClass: 'afc-selectWoo-dropdown'
                });
            }
        }
        
    });

    $(document).on('click', '#adfy__woofc-hide-shipping-container', function (e) {

        e.preventDefault();

        $('#adfy__woofc-shipping-container').attr('data_display', 'hidden');

        // Dispatch event.
        AFC.api.event.shippingModalClosed();
    });

    // Listen country changed event.
    populateStatesOnceCountryIsChanged();
}

/**
 * Handle the shipping address change event via AJAX.
 * 
 * @return {void} void.
 * @since 1.0.0
 */
export function handleShippingAddressChange() {

    $(document).on('submit', '#adfy__woofc-shipping-form', function (e) {

        e.preventDefault();

        // Display spinner.
        setSpinnerVisibility("show");

        let shippingCountry = $('#addonify_floating_cart_shipping_country').val();
        let shippingState = $('#addonify_floating_cart_shipping_state').val();
        let shippingCity = $('#addonify_floating_cart_shipping_city').val();
        let shippingPostcode = $('#addonify_floating_cart_shipping_postcode').val();
        let nonce = $('#addonify-floating-cart-shipping-nonce').val();

        const { __ } = wp.i18n;

        let message = __('Error updating shipping address!.', 'addonify-floating-cart');

        $.ajax({
            'url': ajaxUrl,
            'method': 'POST',
            'data': {
                action: ajaxUpdateShippingAddressAction,
                calc_shipping_country: shippingCountry,
                calc_shipping_state: shippingState,
                calc_shipping_city: shippingCity,
                calc_shipping_postcode: shippingPostcode,
                nonce: nonce
            },
            success: function (res) {

                if (!res) {

                    AFC.action.toast.dispatchToast('error', message);
                    return;
                }

                // Replace fragments.
                if (res.fragments) {

                    $.each(res.fragments, function (key, value) {

                        value !== '' ? $(key).replaceWith(value) : $(key).html(value);
                    });

                    // Dispatch event.
                    AFC.api.event.shippingAddressUpdated(res.fragments);
                }

                $('#adfy__woofc-shipping-container').attr('data_display', 'visible');

                if (isShippingAddressUpdatable === '1') {
                    if ($('#addonify_floating_cart_shipping_country').length) {
                        $('#addonify_floating_cart_shipping_country').selectWoo({
                            dropdownAutoWidth: false,
                            dropdownCssClass: 'afc-selectWoo-dropdown'
                        });
                    }

                    if ($('select#addonify_floating_cart_shipping_state')) {
                        $('select#addonify_floating_cart_shipping_state').selectWoo({
                            dropdownAutoWidth: false,
                            dropdownCssClass: 'afc-selectWoo-dropdown'
                        });
                    }
                }
            },
            error: function (err) {

                console.log(err);
                AFC.action.toast.dispatchToast('error', message);
            },
            complete: function () {

                // Hide spinner.
                setSpinnerVisibility("hide");
            }
        });
    });
}

/**
 * Handle the shipping method change event via AJAX.
 * 
 * @return {void} void.
 * @since 1.0.0
 */
export function handleShippingMethodChange() {

    $(document).on('change', '.shipping_method', function (e) {

        const { __ } = wp.i18n;
        let shippingMethod = new Object();
        let message = __('Error processing shipping method update request.', 'addonify-floating-cart');

        // Get shipping method.
        $('select.shipping_method, :input[name^=shipping_method][type=radio]:checked, :input[name^=shipping_method][type=hidden]').each(function () {

            shippingMethod[$(this).data('index')] = $(this).val();
        });

        // Display spinner.
        setSpinnerVisibility("show");

        $.ajax({
            'url': ajaxUrl,
            'method': 'POST',
            'data': {
                action: ajaxUpdateShippingMethodAction,
                nonce: nonce,
                shipping_method: shippingMethod,
            },
            success: function (res) {

                if (!res || res.error) {

                    // Dispatch error toast.
                    AFC.action.toast.dispatch('error', message);

                    return;
                }

                let fragments = res.fragments;

                // Replace fragments
                if (fragments) {

                    $.each(fragments, function (key, value) {

                        value !== '' ? $(key).replaceWith(value) : $(key).html(value);
                    });
                }

                $('#adfy__woofc-shipping-container').attr('data_display', 'visible');
                
                if (isShippingAddressUpdatable === '1') {
                    if ($('#addonify_floating_cart_shipping_country').length) {
                        $('#addonify_floating_cart_shipping_country').selectWoo({
                            dropdownAutoWidth: false,
                            dropdownCssClass: 'afc-selectWoo-dropdown'
                        });
                    }

                    if ($('select#addonify_floating_cart_shipping_state')) {
                        $('select#addonify_floating_cart_shipping_state').selectWoo({
                            dropdownAutoWidth: false,
                            dropdownCssClass: 'afc-selectWoo-dropdown'
                        });
                    }
                }
            },
            error: function (err) {

                console.log(err);

                // Dispatch error toast.
                AFC.action.toast.dispatch('error', message);
            },
            complete: function () {

                // Hide spinner.
                setSpinnerVisibility("hide");
            }
        });
    });
}

/**
 * Populate states once country is changed.
 * 
 * @return {void} void.
 * @since 1.0.0
 */
function populateStatesOnceCountryIsChanged() {

    $(document).on('change', '#addonify_floating_cart_shipping_country', function (e) {

        let country = $(this).val();
        let stateDiv = $('#addonify_floating_cart_shipping_state');
        let states = countriesToStates[country];
        stateDiv.siblings('span.select2').remove();

        if (typeof states === 'object' && Object.keys(states).length > 0) {

            let html = '';

            for (let index in states) {

                html += '<option value="' + index + '">' + states[index] + '</option>'
            }

            if (stateDiv.prop('tagName').toLowerCase() === 'input') {

                let thisParent = stateDiv.parent();
                stateDiv.remove();
                let select = $(document.createElement('select'));
                select.addClass('state_select').prop('id', 'addonify_floating_cart_shipping_state').prop('name', 'addonify_floating_cart_shipping_state');
                select.prop('data-placeholder', 'State / County');
                thisParent.append(select);
                $(document).on('change', '#addonify_floating_cart_shipping_country', function (e) {
                    e.preventDefault();

                    if (isShippingAddressUpdatable === '1') {

                        if ($('select#addonify_floating_cart_shipping_state')) {
                            $('select#addonify_floating_cart_shipping_state').selectWoo({
                                dropdownAutoWidth: false,
                                dropdownCssClass: 'afc-selectWoo-dropdown'
                            });
                        }
                    }
                });
            }

            $('#addonify_floating_cart_shipping_state').html(html);

        } else if (states instanceof Array && states.length === 0) {

            let thisParent = stateDiv.parent();

            stateDiv.remove();

            let input = $(document.createElement('input'));

            input.addClass('input_text').prop('id', 'addonify_floating_cart_shipping_state').prop('name', 'addonify_floating_cart_shipping_state');

            input.prop('type', 'hidden');

            thisParent.append(input);

        } else {

            let thisParent = stateDiv.parent();

            stateDiv.remove();

            let input = $(document.createElement('input'));

            input.addClass('input_text').prop('id', 'addonify_floating_cart_shipping_state').prop('name', 'addonify_floating_cart_shipping_state');

            input.prop('placeholder', 'State / County');

            thisParent.append(input);
        }
    });
}
