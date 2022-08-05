<?php
?>
<footer class="adfy__woofc-colophon">
    <?php if ( (wc_coupons_enabled()) && (WC()->cart->get_cart_contents_count() > 0) ) { ?>
    <div class="adfy__woofc-coupon">
        <p class="coupon-text">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.137,24a2.8,2.8,0,0,1-1.987-.835L12,17.051,5.85,23.169a2.8,2.8,0,0,1-3.095.609A2.8,2.8,0,0,1,1,21.154V5A5,5,0,0,1,6,0H18a5,5,0,0,1,5,5V21.154a2.8,2.8,0,0,1-1.751,2.624A2.867,2.867,0,0,1,20.137,24ZM6,2A3,3,0,0,0,3,5V21.154a.843.843,0,0,0,1.437.6h0L11.3,14.933a1,1,0,0,1,1.41,0l6.855,6.819a.843.843,0,0,0,1.437-.6V5a3,3,0,0,0-3-3Z"/></svg>
            </span>
            <?php esc_html_e('Have a coupon?'); ?> 
            <a href="#" id="adfy__woofc-coupon-trigger" class="adfy__woofc-link has-underline">
                <?php esc_html_e('Click here to apply','addonify-floating-cart'); ?> 
            </a>
        </p>
    </div>
    <?php } ?>
    <div class="adfy__woofc-cart-summary <?php echo (WC()->cart->get_cart_subtotal() != WC()->cart->get_cart_total()) ? 'discount' : ''; ?>">
        <ul> 
            <?php
            if(WC()->cart->get_cart_subtotal() != WC()->cart->get_cart_total()){
                ?>
                <li class="sub-total">
                    <span class="label"><?php esc_html_e('Sub total:','addonify-floating-cart'); ?></span>
                    <span class="value">
                        <span class="woocommerce-Price-amount subtotal-amount">
                            <bdi>
                                <?php echo WC()->cart->get_cart_subtotal(); ?>
                            </bdi>
                        </span>
                    </span>
                </li>
                <li class="discount">
                    <span class="label"><?php esc_html_e('Discount:','addonify-floating-cart'); ?></span>
                    <span class="value">
                        <span class="woocommerce-Price-amount discount-amount">
                            <bdi>
                            <?php echo WC()->cart->get_cart_discount_total(); ?>
                            </bdi>
                        </span>
                    </span>
                </li>
                <?php
            }
            ?>
            <li class="total">
                <span class="label"><?php esc_html_e('Total:','addonify-floating-cart'); ?></span>
                <span class="value">
                    <span class="woocommerce-Price-amount total-amount">
                        <bdi>
                        <?php echo WC()->cart->get_cart_total(); ?>
                        </bdi>
                    </span>
                </span>
            </li>
        </ul>
    </div>
    <div class="adfy__woofc-actions">
        <?php do_action('addonify_floatting_cart/get_cart_footer_button', array()); ?>
    </div>
</footer>