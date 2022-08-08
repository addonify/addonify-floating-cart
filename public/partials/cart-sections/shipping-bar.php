<div class="adfy__woofc-shipping-bar">
    <?php if(WC()->cart->get_cart_contents_count() > 0){ ?>
        <span class="adfy__woofc-shipping-text">
        <?php 
        if($per < 100){
            ?>
            🔥 <?php echo $pre_threshold_label; ?>
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
    <?php } ?>
</div>