<?php 
?>
<div id="adfy__woofc-coupon-container" data_display="hidden">
    <div class="coupon-container-header">
        <button class="adfy__woofc-fake-button" id="adfy__woofc-hide-coupon-container">
            <svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
            </svg>
            Go back
        </button>
    </div>
    <form id="adfy__woofc-coupon-form">
        <div class="adfy__woofc-alert success">
            <p class="adfy__woofc-alert-text">
                <svg fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                Coupon has been applied successfully
            </p>
        </div>
        <div class="adfy__woofc-alert error">
            <p class="adfy__woofc-alert-text">
                <svg fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Invalid coupon code
            </p>
        </div>
        <div class="adfy__woofc-coupon-inputs">
            <label for="adfy__woofc-coupon-input-field">
                If you have a coupon code, please apply it below.
            </label>
            <input type="text" value="" name="adfy__woofc-coupon-input-field" placeholder="BLACKFRIDAY">
            <button type="submit" class="adfy__woofc-button" id="adfy__woofc-apply-coupon-button">
                Apply Coupon
            </button>
        </div>
    </form>
    <?php 
        ob_start();
        addonify_floating_cart_get_template('cart-sections/coupons-available.php');
        echo ob_get_clean();
    ?>
</div>