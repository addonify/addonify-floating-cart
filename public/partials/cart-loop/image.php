<figure class="thumb" data_style="round">
    <?php
        $product_permalink = $product->is_visible() ? $product->get_permalink(  ) : '';
        if(!empty($variation) ){
            $image = $variation->get_image();
        } else {
            $image =  $product->get_image();
        }

        if ( ! $product_permalink ) {
            echo $image;
        } else {
            printf( '<a href="%s" class="adfy__woofc-link">%s</a>', esc_url( $product_permalink ), $image ); 
        }
    ?>
    <button class="adfy__woofc-fake-button adfy__woofc-remove-cart-item product-remove">
    <?php
        echo apply_filters(
            'woocommerce_cart_item_remove_link',
            sprintf(
                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s">
                    <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                </a>',
                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                esc_html__( 'Remove this item', 'woocommerce' ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( $cart_item_key )
            ),
            $cart_item_key
        );
    ?>
    </button>
</figure>