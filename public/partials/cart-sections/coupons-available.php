<div class="adfy__woofc-coupons">        
    <?php
        $applied_coupons = WC()->cart->get_applied_coupons();
        if(!empty($applied_coupons)){
            ?>
            <div id="adfy__woofc-applied-coupons">
                    <span class="title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.137,24a2.8,2.8,0,0,1-1.987-.835L12,17.051,5.85,23.169a2.8,2.8,0,0,1-3.095.609A2.8,2.8,0,0,1,1,21.154V5A5,5,0,0,1,6,0H18a5,5,0,0,1,5,5V21.154a2.8,2.8,0,0,1-1.751,2.624A2.867,2.867,0,0,1,20.137,24ZM6,2A3,3,0,0,0,3,5V21.154a.843.843,0,0,0,1.437.6h0L11.3,14.933a1,1,0,0,1,1.41,0l6.855,6.819a.843.843,0,0,0,1.437-.6V5a3,3,0,0,0-3-3Z"></path></svg>
                        <?php echo esc_html( apply_filters( 'addonify-floating-cart-applied-coupon-label', __('Applied coupon :','addonify-floating-cart'))); ?>
                    </span> 
                    <ul class="list">
                        <?php
                        foreach($applied_coupons as $coupon){
                        ?>
                        <li>
                            <input type="text" value="<?php echo esc_attr($coupon)?>" readonly>
                            <button data-coupon="<?php echo esc_attr($coupon)?>" class="adfy__woofc-button adfy__woofc-remove-applied-coupon-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                            </button>
                        </li>
                        <?php
                        }
                    ?> 
                    </ul>
            </div>
            <?php
        }
        ?>
</div>
