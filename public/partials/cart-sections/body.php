<?php
?>
<main class="adfy__woofc-content">
    <div class="adfy__woofc-content-entry" id="adfy__woofc-scrollbar">
        <?php 
        $cart = WC()->cart->get_cart();
        if(is_array($cart) && !empty($cart)){
            foreach($cart as $cart_item_key=>$cart_item){
                $product = wc_get_product($cart_item['product_id']);
                ?>
                <div class="adfy__woofc-item">
                    <?php 
                        addonify_floating_cart_get_template( 'cart-loop/image.php', array(
                            'product' => $product,
                            'cart_item_key' => $cart_item_key,
                            'cart_item' => $cart_item,
                        ) );
                    ?>
                    <div class="adfy__woofc-item-content">
                        <?php 
                            addonify_floating_cart_get_template( 'cart-loop/title.php', array(
                                'product' => $product,
                                'cart_item' => $cart_item,
                            ) );
                        ?>
                        <?php 
                            addonify_floating_cart_get_template( 'cart-loop/quantity-price.php', array(
                                'product' => $product,
                                'cart_item' => $cart_item,
                            ) );
                        ?>
                        <?php 
                            addonify_floating_cart_get_template( 'cart-loop/quantity-field.php', array(
                                'product' => $product,
                                'cart_item_key' => $cart_item_key,
                                'cart_item' => $cart_item,
                            ) );
                        ?>
                    </div>
                </div><!-- // adfy__woofc-item -->
                
                <?php 
                }
            }
            ?>
    </div><!-- // adfy__woofc-content-entry -->
</main>