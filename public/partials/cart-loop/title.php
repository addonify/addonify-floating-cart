
<div class="adfy__woofc-item-title">
    <h3 class="woocommerce-loop-product__title">
        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="adfy__woofc-link">
            <?php 
            echo esc_html__($product->get_title()).'<br />'; 
            if($product->has_attributes()){
                if(isset($cart_item['variation']) && is_array($cart_item['variation'])){
                    foreach($cart_item['variation'] as $index=> $value){
                        $index = ucfirst( str_replace('attribute_pa_','',$index));
                        echo esc_html($index.':'.$value) . '&nbsp;';
                    }
                }
            }
            ?>
        </a>
    </h3>
</div>