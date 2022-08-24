<div class="adfy__woofc-shipping-bar <?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'adfy__woofc-hidden'; ?>">
        <span class="adfy__woofc-shipping-text">
        <?php
        if($per < 100){
            ?>
            🔥 <?php echo str_replace('{threshold}', $left ,$pre_threshold_label); ?>
            <?php
        } else {
            ?>
            🔥 <?php echo $post_threshold_label; ?>
        <?php
        }
        ?>
        </span>
    <div class="progress-bars">
        <div class="total-bar shipping-bar"></div>
        <div class="progress-bar shipping-bar" data_percentage="<?php echo $per; ?>" style="width: <?php echo $per; ?>%"></div>
    </div>
</div>
<div id="adfy__woofc-cart-errors"></div>
