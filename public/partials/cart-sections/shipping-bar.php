<?php
$free_shipping_eligibility_amount = 200;
if(WC()->cart->get_cart_contents_count() > 0){
    $total = WC()->cart->get_cart_contents_total();
    if($total >= $free_shipping_eligibility_amount){
        $per = 100;
    } else {
        $per =  100 - (($free_shipping_eligibility_amount - $total)/$free_shipping_eligibility_amount * 100);
    }
} else {
    $per = 0;
}
?>
    <div class="adfy__woofc-shipping-bar">
        <?php 
        if($per < 100){
            ?>
            <span class="adfy__woofc-shipping-text">
                🔥 Spend <span class="amount"><?php echo get_woocommerce_currency_symbol().($free_shipping_eligibility_amount - $total); ?></span> more to qualify for a free shipping.
            </span>
            <?php 
        } 
        ?>
        <div class="progress-bars">
            <div class="total-bar shipping-bar"></div>
            <div class="progress-bar shipping-bar" data_percentage="<?php echo $per; ?>" style="width: <?php echo $per; ?>%"></div>
        </div>
    </div>        