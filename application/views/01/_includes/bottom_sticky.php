<div class="bottom-sticky">
        <a href="/cart" class="cart-nav"><img src="<?php echo base_url('assets/img/cart.png'); ?>" alt=""><span>( <?php echo $this->cart->total_items();?> ) Rp. <?php echo number_format($this->cart->total(),0,",","."); ?></span></a>
        <?php if ($this->cart->total_items() > 0) { ?>
                <a href="/checkout" class="checkout-btn">CHECK OUT</a>
        <?php } ?>
         
</div> 