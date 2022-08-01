<?php
?>
<!-- main floating cart section-->
<aside id="adfy__floating-cart" data_type="drawer" data_position="right">
    <?php
    ?>
        <div class="adfy_woofc-inner">
        <?php
            do_action( 'addonify_floating_cart_add_cart_sidebar_components');
        ?>
        </div>
        <?php
            if ( wc_coupons_enabled() ) {
                addonify_floating_cart_get_template( 'cart-sections/coupon.php' );
            }
        ?>
</aside>

<!-- for overlay -->
<aside id="adfy__woofc-overlay" class="adfy__hide-woofc"></aside>