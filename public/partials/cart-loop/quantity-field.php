
<div class="adfy__woofc-quantity">
    <form class="adfy__woofc-quantity-form" methord="post">
        <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-inc-quantity" <?php echo $data_attributes;?> >
            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
        </button>
        <input type="number" value="<?php echo $item_quantity?>" 
            step="<?php echo $step; ?>"
            min="<?php echo $min; ?>"
            max="<?php echo $max; ?>"
            class="adfy__woofc-quantity-input-field" <?php echo $data_attributes;?>>
        <button class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-dec-quantity" <?php echo $data_attributes;?>>
            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
        </button>
    </form>
</div>