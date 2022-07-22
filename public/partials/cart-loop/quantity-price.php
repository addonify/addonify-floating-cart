
<div class="adfy__woofc-item-price"> 
    <span class="quantity">
        <?php
            echo esc_html($cart_item['quantity']); 
            if(!empty($variation) ){
                $price = $variation->get_price();
            } else {
                $price =  $product->get_price();
            }
        ?> × 
        <span class="woocommerce-Price-amount amount">
        <bdi>
            <?php echo esc_html(get_woocommerce_currency_symbol().$price);?>
        </bdi>
        </span>
    </span>
</div>