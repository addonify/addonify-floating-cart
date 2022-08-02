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
                do_action('addonify_floating_cart_get_cart_coupon');
            }
        ?>
</aside>
<?php
if(addonify_floating_cart_get_setting_field_value('close_cart_modal_on_overlay_click')){ 
    $hide_sidebar_class = "adfy__hide-woofc";
} else {
    $hide_sidebar_class = "";
}
?>
<!-- for overlay -->
<aside id="adfy__woofc-overlay" class="<?php echo $hide_sidebar_class;?>"></aside>