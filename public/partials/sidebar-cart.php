<?php
?>
<!-- main floating cart section-->
<aside id="adfy__floating-cart" data_type="drawer" data_position="right">
    <?php
        ?>
        <div class="adfy_woofc-inner">
        <?php
        addonify_floating_cart_get_template( 'cart-sections/header.php' ); 
        addonify_floating_cart_get_template( 'cart-sections/shipping-bar.php' );
        addonify_floating_cart_get_template( 'cart-sections/body.php' );
        addonify_floating_cart_get_template( 'cart-sections/footer.php' );
        ?>
        </div>
        <?php
        addonify_floating_cart_get_template( 'cart-sections/coupon.php' );
    ?>
</aside>

<!-- for overlay -->
<aside id="adfy__woofc-overlay" class="adfy__hide-woofc"></aside>