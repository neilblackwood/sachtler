<?php
	//<img src="http://176.32.230.28/sachtler.com/shopatron_callback.php?order_id=#order_id#&cart_id=#cart_id#&order_total=#order_total#&order_shipping=#order_shipping#&cust_first_name=#cust_first_name#&cust_last_name=#cust_last_name#&cust_email_address=#cust_email_address#&opt_in_status=#opt_in_status#" />
	define('WP_USE_THEMES', false);
	require('wp-load.php');
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if ($link) {
    	mysql_select_db(DB_NAME,$link);
		if( isset($_GET['cart_id'])&& isset($_GET['order_shipping'])  && isset($_GET['order_total'])  ) {
			$shopatron_id=$_GET['cart_id']; //$order_id
			$sql = "UPDATE `wp_wpsc_purchase_logs` set  
				   base_shipping=".$_GET['order_shipping'].",
				   totalprice=".$_GET['order_total'].",
				   processed  = '2'
				   WHERE `authcode`=".$shopatron_id;
			$result=mysql_query($sql);
		}
	}
	global $wpsc_cart;
	$wpsc_cart->empty_cart(); 
	session_unset();
	$im     = imagecreatefromgif("wp-includes/images/blank.gif");
	header("Content-type: image/gif");
	imagegif($im);
	imagedestroy($im);
?>