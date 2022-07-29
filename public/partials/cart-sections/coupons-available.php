
    <div id="adfy__woofc-coupons-available">
        <?php
        $applied_coupons = WC()->cart->get_applied_coupons();
        if(!empty($applied_coupons)){
            ?>
            <h2>&nbsp; Coupons: </h2> 
            <ul>
                <?php
                foreach($applied_coupons as $coupon){
                ?>
                <li>
                    <input type="text" value="<?php echo esc_url($coupon)?>" readonly>
                    <button data-coupon="<?php echo esc_url($coupon)?>" class="removeCoupon">Del</button>
                </li>
                <?php
            }
            ?> 
            </ul>
            <?php
        }
        ?>
    </div>