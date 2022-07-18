<?php
?>
<main class="adfy__woofc-content">
    <div class="adfy__woofc-content-entry" id="adfy__woofc-scrollbar">
        <?php 
        $cart = WC()->cart->get_cart();
        if(is_array($cart) && !empty($cart)){
            foreach($cart as $cart_item_key=>$cart_item){
                $product = wc_get_product($cart_item['product_id']);
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                ?>
                <div class="adfy__woofc-item">
                    <figure class="thumb" data_style="round">
                        <?php
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key );

                            if ( ! $product_permalink ) {
                                echo $thumbnail;
                            } else {
                                printf( '<a href="%s" class="adfy__woofc-link">%s</a>', esc_url( $product_permalink ), $thumbnail ); 
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
                                    esc_attr( $product_id ),
                                    esc_attr( $product->get_sku() ),
                                    esc_attr( $cart_item_key )
                                ),
                                $cart_item_key
                            );
                        ?>
                        </button>
                    </figure>
                    <div class="adfy__woofc-item-content">
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
                                    // var_dump($cart_item['variation']['attribute_pa_color']);
                                    ?>
                                </a>
                            </h3>
                        </div>
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
                        <div class="adfy__woofc-quantity">
                            <form class="adfy__woofc-quantity-form" methord="post">
                                <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-inc-quantity"  
                                    data-product_id="<?php echo esc_attr( $product_id ); ?>" 
                                    data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                                    data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
                                    <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
                                </button>
                                <input type="number" value="<?=$cart_item['quantity']?>" step="1" class="adfy__woofc-quantity-input-field">
                                <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-dec-quantity"
                                    data-product_id="<?php echo esc_attr( $product_id ); ?>" 
                                    data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                                    data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>">
                                    <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div><!-- // adfy__woofc-item -->
                
                <?php 
                }
            }
            ?>
    </div><!-- // adfy__woofc-content-entry -->
</main>