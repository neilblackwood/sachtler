<?php if(wpsc_cart_item_count() > 0): ?>
    <span><?php printf('Cart: %1$s for <span class="black">%2$s</span>', sprintf( _n('<span class="black">%d</span> product', '<span class="black">%d</span> products', wpsc_cart_item_count(), 'wpsc'), wpsc_cart_item_count() ), wpsc_cart_total_widget( false, false ,false )); ?></span>
    <span><a target="_parent" href="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" class="visitcart red-button" title="<?php esc_html_e('Checkout', 'wpsc'); ?>" class="gocheckout"><?php esc_html_e('Checkout', 'wpsc'); ?></a></span>
<?php else: ?>
	<span class="empty"><?php _e('Your shopping cart is empty', 'wpsc'); ?></span>
	<span><a target="_parent" href="<?php echo esc_url( get_option( 'product_list_url' ) ); ?>" class="visitshop red-button" title="<?php esc_html_e('Visit Shop', 'wpsc'); ?>"><?php esc_html_e('Shop', 'wpsc'); ?></a></span>
<?php endif; ?>

<?php
wpsc_google_checkout();


?>
