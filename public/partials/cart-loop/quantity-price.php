
<div class="adfy__woofc-item-price"> 
    <span class="quantity">
        <div class="adfy__woofc-item-price-multiplier-quantity">
        <?php
            echo esc_html($cart_item['quantity']); 
        ?>
        </div>
        × 
        <span class="woocommerce-Price-amount amount">
        <bdi>
            <?php
                if(!empty($variation) ){
                    $price = $variation->get_price();
                } else {
                    $price =  $product->get_price();
                }
                echo esc_html(get_woocommerce_currency_symbol().$price);
            ?>
        </bdi>
        </span>
    </span>
</div>