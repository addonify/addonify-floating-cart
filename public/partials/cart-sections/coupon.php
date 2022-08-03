<?php 
if(addonify_floating_cart_get_setting_field_value('display_cart_coupon_section') ){
?>
<div id="adfy__woofc-coupon-container" data_display="hidden">
    <div class="coupon-container-header">
        <button class="adfy__woofc-fake-button" id="adfy__woofc-hide-coupon-container">
            <svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
            </svg>
            <?php esc_html_e('Go back'); ?>
        </button>
    </div>
    <form id="adfy__woofc-coupon-form">
        <div class="adfy__woofc-alert success">
        </div>
        <div class="adfy__woofc-alert error">
        </div>
        <div class="adfy__woofc-coupon-inputs">
            <label for="adfy__woofc-coupon-input-field">
                <?php esc_html_e('If you have a coupon code, please apply it below.'); ?>
            </label>
            <input type="text" value="" name="adfy__woofc-coupon-input-field" placeholder="BLACKFRIDAY">
            <button type="submit" class="adfy__woofc-button" id="adfy__woofc-apply-coupon-button">
                <?php esc_html_e(addonify_floating_cart_get_setting_field_value('cart_apply_coupon_button_label')); ?>
            </button>
        </div>
    </form>
    <?php 
    if(addonify_floating_cart_get_setting_field_value('display_applied_coupons') ){
        do_action('addonify_floating_cart/cart_coupons_available_template', array());
    }
    ?>
</div>
<?php
}