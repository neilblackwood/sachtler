--><div class="entry-content span3">
<?php
$meta = get_post_meta( get_the_id());
get_the_title() ? printf('<h3 class="dealer_title">%1$s</h3>',get_the_title()) : '';
$dealer_partner = ($meta['_dealer_partner'][0] ? $meta['_dealer_partner'][0] : '');
switch ($dealer_partner) {
	case 'platinum' :
		echo '<span class="dealer_partner platinum">Platinum Partner</span>';
		break;
}
$meta['_dealer_address'][0] ? printf('<p class="dealer_address">%1$s</p>',wpautop($meta['_dealer_address'][0])) : '';
$meta['_dealer_tel'][0] ? printf('<span class="dealer_tel">T %1$s</span>',$meta['_dealer_tel'][0]) : '';
$meta['_dealer_fax'][0] ? printf('<span class="dealer_fax">F %1$s</span>',$meta['_dealer_fax'][0]) : '';
$meta['_dealer_email'][0] ? printf('<a href="mailto:%1$s" rel="nofollow" class="dealer_email">%1$s</a>',$meta['_dealer_email'][0]) : '';
$meta['_dealer_web'][0] ? printf('<a href="http://%1$s" rel="nofollow" class="dealer_web">%1$s</a>',$meta['_dealer_web'][0]) : '';
?>
<?php edit_post_link( __( 'Edit', 'sachtler' ), '<div class="edit-link">', '</div>' ) ?>
</div><!--