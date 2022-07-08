<?php
?>
<main class="adfy__woofc-content">
    <div class="adfy__woofc-content-entry" id="adfy__woofc-scrollbar">
        <?php 
        $cart = WC()->cart->get_cart();
        if(is_array($cart) && !empty($cart)){
            foreach($cart as $item){
                $product = wc_get_product($item['product_id']);
                ?>
                <div class="adfy__woofc-item">
                    <figure class="thumb" data_style="round">
                        <a href="#" class="adfy__woofc-link">
                            <?php echo $product->get_image(); ?>
                        </a>
                        <button class="adfy__woofc-fake-button adfy__woofc-remove-cart-item">
                            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                        </button>
                    </figure>
                    <div class="adfy__woofc-item-content">
                        <div class="adfy__woofc-item-title">
                            <h3 class="woocommerce-loop-product__title">
                                <a href="<?php echo $product->get_permalink(); ?>" class="adfy__woofc-link">
                                    <?php 
                                    echo $product->get_title(); 
                                    // $size = $product->get_attribute( 'pa_size' );
                                    // $color = $product->get_attribute( 'pa_color' );
                                    // echo $size. " <br>" . $color;
                                    ?>
                                </a>
                            </h3>
                        </div>
                        <div class="adfy__woofc-item-price"> 
                            <span class="quantity">
                                <?=$item['quantity']?> × 
                                <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    <?php echo get_woocommerce_currency_symbol().$product->get_price();?>
                                </bdi>
                                </span>
                            </span>
                        </div>
                        <div class="adfy__woofc-quantity">
                            <form class="adfy__woofc-quantity-form" methord="post">
                                <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-inc-quantity">
                                    <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
                                </button>
                                <input type="number" value="<?=$item['quantity']?>" step="1" class="adfy__woofc-quantity-input-field">
                                <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-dec-quantity">
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