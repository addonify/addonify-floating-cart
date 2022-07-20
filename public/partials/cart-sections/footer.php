<?php
?>
<footer class="adfy__woofc-colophon">
    <div class="adfy__woofc-coupon">
        <p class="coupon-text">
            <span class="icon">
                <svg viewBox="0 0 17 17"><g></g>
                    <path d="M2 0v16.902l2.028-2.481 1.503 1.88 1.501-1.875 1.499 1.875 1.5-1.875 1.5 1.875 1.499-1.875 1.97 2.46v-16.886h-13zM14 14.036l-0.97-1.211-1.499 1.875-1.5-1.875-1.5 1.875-1.499-1.875-1.501 1.875-1.495-1.87-1.036 1.268v-13.098h11v13.036zM10.997 4h-6v-1h6v1zM8.997 8h-4v-1h4v1zM11.978 6h-7v-1h7v1zM5 10h7v1h-7v-1z" />
                </svg>
            </span>
            Have a coupon? <a href="#" id="adfy__woofc-coupon-trigger" class="adfy__woofc-link has-underline">Click here to apply</a>
        </p>
    </div>
    <div class="adfy__woofc-cart-summary">
        <ul>
            <li class="sub-total">
                <span class="label">Sub total:</span>
                <span class="value">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <?php echo WC()->cart->get_cart_subtotal(); ?>
                        </bdi>
                    </span>
                </span>
            </li>
            <li class="discount">
                <span class="label">Discount:</span>
                <span class="value">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                        <?php echo WC()->cart->get_cart_discount_total(); ?>
                        </bdi>
                    </span>
                </span>
            </li>
            <li class="total">
                <span class="label">Total:</span>
                <span class="value">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                        <?php echo WC()->cart->get_cart_total(); ?>
                        </bdi>
                    </span>
                </span>
            </li>
        </ul>
    </div>
    <div class="adfy__woofc-actions">
        <button class="adfy__woofc-button adfy__hide-woofc continue-shopping">
            Continue shopping
        </button>
        <a href="<?php echo wc_get_checkout_url(); ?>" class="adfy__woofc-button proceed-to-checkout">
            Checkout
        </a>
    </div>
</footer>