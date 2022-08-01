<figure class="thumb" data_style="round">
    <?php
        if ( ! $product_permalink ) {
            echo $image;
        } else {
            printf( '<a href="%s" class="adfy__woofc-link">%s</a>', esc_url( $product_permalink ), $image ); 
        }
    ?>
    <button class="adfy__woofc-fake-button adfy__woofc-remove-cart-item product-remove" 
        data-product_id="<?php echo esc_html($product->get_id());?>" 
        data-product_sku="<?php echo esc_html($product->get_sku());?>" 
        data-cart_item_key="<?php echo esc_html($cart_item_key);?>">
        <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
    </button>
</figure>