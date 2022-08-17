<?php
?>
<header class="adfy__woofc-header">
    <h3 class="adfy__woofc-title">
        <?php echo esc_html(addonify_floating_cart_get_option('cart_title')); ?>
        <?php if(addonify_floating_cart_get_option('display_cart_items_number')){ ?>
        <span class="adfy__woofc-badge">
            <?php 
            printf( _nx(' %1$s Item', '%1$s Items', esc_html(WC()->cart->get_cart_contents_count()), 'number of cart items', 'addonify-floating-cart'),
                esc_html(WC()->cart->get_cart_contents_count())); 
            ?>          
        </span>
        <?php } ?>
    </h3>
    <div class="adfy__close-button">
        <button class="adfy__woofc-fake-button adfy__hide-woofc">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
        </button>
    </div>
</header>