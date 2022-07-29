
<div class="adfy__woofc-quantity">
    <form class="adfy__woofc-quantity-form" methord="post">
        <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-inc-quantity"  
            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
            data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
            data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
        </button>
            <input type="number" value="<?php echo $cart_item['quantity']?>" 
                step="<?php echo apply_filters( 'woocommerce_quantity_input_step', 1, $product ); ?>"
                min="<?php echo apply_filters( 'woocommerce_quantity_input_min', 0, $product ); ?>"
                max="<?php echo apply_filters( 'woocommerce_quantity_input_max', -1, $product ); ?>"
                class="adfy__woofc-quantity-input-field"
                data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
        <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-dec-quantity"
            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
            data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
            data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
        </button>
    </form>
</div>