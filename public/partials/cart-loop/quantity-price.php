
<div class="adfy__woofc-item-price"> 
    <span class="quantity">
        <?php echo esc_html($cart_item['quantity']); ?> × 
        <span class="woocommerce-Price-amount amount">
        <bdi>
            <?php echo esc_html(get_woocommerce_currency_symbol().$product->get_price());?>
        </bdi>
        </span>
    </span>
</div>