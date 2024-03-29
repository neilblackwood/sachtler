<?php
global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons, $wpsc_registration_error_messages;
$wpsc_checkout = new wpsc_checkout();
$alt = 0;
$coupon_num = wpsc_get_customer_meta( 'coupon' );
if( $coupon_num )
   $wpsc_coupons = new wpsc_coupons( $coupon_num );

if(wpsc_cart_item_count() < 1) :
   _e('Oops, there is nothing in your cart.', 'wpsc') . "<a href=" . esc_url( get_option( "product_list_url" ) ) . ">" . __('Please visit our shop', 'wpsc') . "</a>";
   return;
endif;
?>
<div id="checkout_page">
    <h1><?php _e('Please review your order', 'wpsc'); ?></h1>
    <div class="cart_header_row">
        <div class="span6 product_col">
            <?php _e('Product', 'wpsc'); ?>
        </div><!--
        --><div class="span2 quantity_col">
            <?php _e('Quantity', 'wpsc'); ?>
        </div><!--
        --><div class="span2 price_col">
            <?php _e('Price', 'wpsc'); ?>
        </div><!--
        --><div class="span2 total_col">
            <?php _e('Total', 'wpsc'); ?>
        </div>
    </div>
<?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>
	<?php
		$alt++;
		if ($alt %2 == 1)
		 $alt_class = 'alt';
		else
		 $alt_class = '';
    ?>
    <?php  //this displays the confirm your order html ?>
    
    <?php do_action ( "wpsc_before_checkout_cart_row" ); ?>
    <div class="cart_product_row cart_product_row_<?php echo wpsc_the_cart_item_key(); ?> <?php echo $alt_class;?>">
        <div class="span6 product_col product_col_<?php echo wpsc_the_cart_item_key(); ?>">
            <a href="<?php echo esc_url( wpsc_product_url(wpsc_cart_item_product_id()) ); ?>">
		<?php if('' != wpsc_cart_item_image()): ?>
            <?php do_action ( "wpsc_before_checkout_cart_item_image" ); ?>
                <img src="<?php echo wpsc_cart_item_image('150','150'); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" class="product_image size_auto" />
        	<?php do_action ( "wpsc_after_checkout_cart_item_image" ); ?>
        <?php endif; ?>
        <?php do_action ( "wpsc_before_checkout_cart_item_name" ); ?>
				<h2><?php echo wpsc_cart_item_name(); ?></h2>
                <?php if(wpsc_product_sku(wpsc_cart_item_product_id())) printf('<span class="%1$s">%2$s</span><span class="%3$s">%4$s</span>', 'product-sku-label','Code','product-sku',wpsc_product_sku(wpsc_cart_item_product_id())); ?></a>
                <p><?php $cart_post = get_post(wpsc_cart_item_product_id()); echo $cart_post->post_excerpt; ?></p>
		<?php do_action ( "wpsc_after_checkout_cart_item_name" ); ?>	
        </div><!--
        --><div class="span2 quantity_col quantity_col_<?php echo wpsc_the_cart_item_key(); ?>">
            <form action="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" method="post" class="adjustform qty">
                <input type="text" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>" />
                <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
                <input type="hidden" name="wpsc_update_quantity" value="true" />
                <!--<input type="submit" value="<?php _e('Update', 'wpsc'); ?>" />-->
            </form>
        </div><!--
        --><div class="span2 price_col price_col_<?php echo wpsc_the_cart_item_key(); ?>">
        	<span class="pricedisplay"><?php echo wpsc_cart_single_item_price(); ?></span>
        </div><!--
        --><div class="span2 total_col">
        	<span class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span>
            <form action="<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>" method="post" class="adjustform remove">
                <input type="hidden" name="quantity" value="0" />
                <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
                <input type="hidden" name="wpsc_update_quantity" value="true" />
                <input type="submit" value="<?php _e('Remove', 'wpsc'); ?>" />
            </form>
        </div>
    </div>
    <?php do_action ( "wpsc_after_checkout_cart_row" ); ?>
<?php endwhile; ?>


	<?php 
   
   // START OF NOT USED SECTION
   //
   //
   
   ?>
  
   
   <?php if(wpsc_uses_shipping()): ?>
	   <p class="wpsc_cost_before"></p>
   <?php endif; ?>
   <?php  //this HTML dispalys the calculate your order HTML   ?>

   <?php if(wpsc_has_category_and_country_conflict()): ?>
      <p class='validation-error'><?php echo esc_html( wpsc_get_customer_meta( 'category_shipping_conflict' ) ); ?></p>
   <?php endif; ?>

   <?php if(isset($_SESSION['WpscGatewayErrorMessage']) && $_SESSION['WpscGatewayErrorMessage'] != '') :?>
      <p class="validation-error"><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></p>
   <?php
   endif;
   ?>

   <?php do_action('wpsc_before_shipping_of_shopping_cart'); ?>

   <div id="wpsc_shopping_cart_container">
   <?php if(wpsc_uses_shipping()) : ?>
      <h2><?php _e('Calculate Shipping Price', 'wpsc'); ?></h2>
      <table class="productcart">
         <tr class="wpsc_shipping_info">
            <td colspan="5">
               <?php _e('Please specify shipping location below to calculate your shipping costs', 'wpsc'); ?>
            </td>
         </tr>

         <?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
            <?php if (wpsc_have_valid_shipping_zipcode()) : ?>
                  <tr class='wpsc_update_location'>
                     <td colspan='5' class='shipping_error' >
                        <?php _e('Please provide a Zipcode and click Calculate in order to continue.', 'wpsc'); ?>
                     </td>
                  </tr>
            <?php else: ?>
               <tr class='wpsc_update_location_error'>
                  <td colspan='5' class='shipping_error' >
                     <?php _e('Sorry, online ordering is unavailable to this destination and/or weight. Please double check your destination details.', 'wpsc'); ?>
                  </td>
               </tr>
            <?php endif; ?>
         <?php endif; ?>
         <tr class='wpsc_change_country'>
            <td colspan='5'>
               <form name='change_country' id='change_country' action='' method='post'>
                  <?php echo wpsc_shipping_country_list();?>
                  <input type='hidden' name='wpsc_update_location' value='true' />
                  <input type='submit' name='wpsc_submit_zipcode' value='<?php esc_attr_e( 'Calculate', 'wpsc' ); ?>' />
               </form>
            </td>
         </tr>

         <?php if (wpsc_have_morethanone_shipping_quote()) :?>
            <?php while (wpsc_have_shipping_methods()) : wpsc_the_shipping_method(); ?>
                  <?php    if (!wpsc_have_shipping_quotes()) { continue; } // Don't display shipping method if it doesn't have at least one quote ?>
                  <tr class='wpsc_shipping_header'><td class='shipping_header' colspan='5'><?php echo wpsc_shipping_method_name().__(' - Choose a Shipping Rate', 'wpsc'); ?> </td></tr>
                  <?php while (wpsc_have_shipping_quotes()) : wpsc_the_shipping_quote();  ?>
                     <tr class='<?php echo wpsc_shipping_quote_html_id(); ?>'>
                        <td class='wpsc_shipping_quote_name wpsc_shipping_quote_name_<?php echo wpsc_shipping_quote_html_id(); ?>' colspan='3'>
                           <label for='<?php echo wpsc_shipping_quote_html_id(); ?>'><?php echo wpsc_shipping_quote_name(); ?></label>
                        </td>
                        <td class='wpsc_shipping_quote_price wpsc_shipping_quote_price_<?php echo wpsc_shipping_quote_html_id(); ?>' style='text-align:center;'>
                           <label for='<?php echo wpsc_shipping_quote_html_id(); ?>'><?php echo wpsc_shipping_quote_value(); ?></label>
                        </td>
                        <td class='wpsc_shipping_quote_radio wpsc_shipping_quote_radio_<?php echo wpsc_shipping_quote_html_id(); ?>' style='text-align:center;'>
                           <?php if(wpsc_have_morethanone_shipping_methods_and_quotes()): ?>
                              <input type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>' <?php echo wpsc_shipping_quote_selected_state(); ?>  onclick='switchmethod("<?php echo wpsc_shipping_quote_name(); ?>", "<?php echo wpsc_shipping_method_internal_name(); ?>")' value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
                           <?php else: ?>
                              <input <?php echo wpsc_shipping_quote_selected_state(); ?> disabled='disabled' type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>'  value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
                                 <?php wpsc_update_shipping_single_method(); ?>
                           <?php endif; ?>
                        </td>
                     </tr>
                  <?php endwhile; ?>
            <?php endwhile; ?>
         <?php endif; ?>

         <?php wpsc_update_shipping_multiple_methods(); ?>


         <?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
               </table>
               </div>
			</div>
            <?php return; ?>
         <?php endif; ?>
      </table>
   <?php endif; ?>
   
   <?php 
   
   // END OF NOT USED SECTION
   //
   //
   
   ?>
   
<div class="cart_total_row">
	<div class="span8">&nbsp;</div><!--
    --><div class="span4">
   <?php
		$wpec_taxes_controller = new wpec_taxes_controller();
		if($wpec_taxes_controller->wpec_taxes_isenabled()): ?>
		<div id="cart_tax">
			<span class="label"><?php echo wpsc_display_tax_label(true); ?>:</span>
			<span id="checkout_tax" class="pricedisplay checkout-tax right"><?php echo wpsc_cart_tax(); ?></span>
		</div>
   <?php endif; ?>

   
   <?php do_action('wpsc_before_form_of_shopping_cart'); ?>

	<?php if( ! empty( $wpsc_registration_error_messages ) ): ?>
		<p class="validation-error">
		<?php
		foreach( $wpsc_registration_error_messages as $user_error )
		 echo $user_error."<br />\n";
		?>
	<?php endif; ?>

	<?php if ( wpsc_show_user_login_form() && !is_user_logged_in() ): ?>
			<p><?php _e('You must sign in or register with us to continue with your purchase', 'wpsc');?></p>
			<div class="wpsc_registration_form">

				<fieldset class='wpsc_registration_form'>
					<h2><?php _e( 'Sign in', 'wpsc' ); ?></h2>
					<?php
					$args = array(
						'remember' => false,
                    	'redirect' => home_url( $_SERVER['REQUEST_URI'] )
					);
					wp_login_form( $args );
					?>
					<div class="wpsc_signup_text"><?php _e('If you have bought from us before please sign in here to purchase', 'wpsc');?></div>
				</fieldset>
			</div>
	<?php endif; ?>
    
	<?php if(wpsc_uses_shipping()) : ?>
		<div id="cart_shipping">
			<span class="label"><?php _e('Total Shipping:', 'wpsc'); ?></span>
			<span id="checkout_shipping" class="pricedisplay checkout-shipping"><?php echo wpsc_cart_shipping(); ?></span>
		</div>
    <?php endif; ?>

    <?php if(wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
		<div id="cart_discount">
			<span class="label"><?php _e('Discount:', 'wpsc'); ?></span>
			<span id="coupons_amount" class="pricedisplay"><?php echo wpsc_coupon_amount(); ?></span>
		</div>
    <?php endif ?>

		<div id="cart_total">
			<span class="label"><?php _e('Total Price:', 'wpsc'); ?></span>
			<span id='checkout_total' class="pricedisplay checkout-total right"><?php echo wpsc_cart_total(); ?></span>
		</div>   
    </div>
</div>

	<form class='wpsc_checkout_forms' action='<?php echo esc_url( get_option( 'shopping_cart_url' ) ); ?>' method='post' enctype="multipart/form-data">
      <?php
      /**
       * Both the registration forms and the checkout details forms must be in the same form element as they are submitted together, you cannot have two form elements submit together without the use of JavaScript.
      */
      ?>

    <?php if(wpsc_show_user_login_form()):
          global $current_user;
          get_currentuserinfo();   ?>

		<div class="wpsc_registration_form">

	        <fieldset class='wpsc_registration_form wpsc_right_registration'>
	        	<h2><?php _e('Join up now', 'wpsc');?></h2>

				<label><?php _e('Username:', 'wpsc'); ?></label>
				<input type="text" name="log" id="log" value="" size="20"/><br/>

				<label><?php _e('Password:', 'wpsc'); ?></label>
				<input type="password" name="pwd" id="pwd" value="" size="20" /><br />

				<label><?php _e('E-mail', 'wpsc'); ?>:</label>
	            <input type="text" name="user_email" id="user_email" value="" size="20" /><br />
	            <div class="wpsc_signup_text"><?php _e('Signing up is free and easy! please fill out your details your registration will happen automatically as you checkout. Don\'t forget to use your details to login with next time!', 'wpsc');?></div>
	        </fieldset>

        </div>
        <div class="clear"></div>
   <?php endif; // closes user login form
      $misc_error_messages = wpsc_get_customer_meta( 'checkout_misc_error_messages' );
      if( ! empty( $misc_error_messages ) ): ?>
         <div class='login_error'>
            <?php foreach( $misc_error_messages as $user_error ){?>
               <p class='validation-error'><?php echo $user_error; ?></p>
               <?php } ?>
         </div>

      <?php
      endif;
      ?>
<?php ob_start(); ?>
   <table class='wpsc_checkout_table table-1'>
      <?php $i = 0;
      while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); ?>

        <?php if(wpsc_checkout_form_is_header() == true){
               $i++;
               //display headers for form fields ?>
               <?php if($i > 1):?>
                  </table>
                  <table class='wpsc_checkout_table table-<?php echo $i; ?>'>
               <?php endif; ?>

               <tr <?php echo wpsc_the_checkout_item_error_class();?>>
                  <td <?php wpsc_the_checkout_details_class(); ?> colspan='2'>
                     <h4><?php echo wpsc_checkout_form_name();?></h4>
                  </td>
               </tr>
               <?php if(wpsc_is_shipping_details()):?>
               <tr class='same_as_shipping_row'>
                  <td colspan ='2'>
                  <?php $checked = '';
                  $shipping_same_as_billing = wpsc_get_customer_meta( 'shipping_same_as_billing' );
                  if(isset($_POST['shippingSameBilling']) && $_POST['shippingSameBilling'])
                     $shipping_same_as_billing = true;
                  elseif(isset($_POST['submit']) && !isset($_POST['shippingSameBilling']))
                  	$shipping_same_as_billing = false;
                  wpsc_update_customer_meta( 'shipping_same_as_billing', $shipping_same_as_billing );
                  	if( $shipping_same_as_billing )
                  		$checked = 'checked="checked"';
                   ?>
					<label for='shippingSameBilling'><?php _e('Same as billing address:','wpsc'); ?></label>
					<input type='checkbox' value='true' name='shippingSameBilling' id='shippingSameBilling' <?php echo $checked; ?> />
					<br/><span id="shippingsameasbillingmessage"><?php _e('Your order will be shipped to the billing address', 'wpsc'); ?></span>
                  </td>
               </tr>
               <?php endif;

            // Not a header so start display form fields
            }elseif(wpsc_disregard_shipping_state_fields()){
            ?>
               <tr class='wpsc_hidden'>
                  <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                     <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                     <?php echo wpsc_checkout_form_name();?>
                     </label>
                  </td>
                  <td>
                     <?php echo wpsc_checkout_form_field();?>
                      <?php if(wpsc_the_checkout_item_error() != ''): ?>
                             <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php
            }elseif(wpsc_disregard_billing_state_fields()){
            ?>
               <tr class='wpsc_hidden'>
                  <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                     <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                     <?php echo wpsc_checkout_form_name();?>
                     </label>
                  </td>
                  <td>
                     <?php echo wpsc_checkout_form_field();?>
                      <?php if(wpsc_the_checkout_item_error() != ''): ?>
                             <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php
            }elseif( $wpsc_checkout->checkout_item->unique_name == 'billingemail'){ ?>
               <?php $email_markup =
               "<div class='wpsc_email_address'>
                  <p class='" . wpsc_checkout_form_element_id() . "'>
                     <label class='wpsc_email_address' for='" . wpsc_checkout_form_element_id() . "'>
                     " . __('Enter your email address', 'wpsc') . "
                     </label>
                  <p class='wpsc_email_address_p'>
                  <img src='https://secure.gravatar.com/avatar/empty?s=60&amp;d=mm' id='wpsc_checkout_gravatar' />
                  " . wpsc_checkout_form_field();

                   if(wpsc_the_checkout_item_error() != '')
                      $email_markup .= "<p class='validation-error'>" . wpsc_the_checkout_item_error() . "</p>";
               $email_markup .= "</div>";
             }else{ ?>
			<tr>
               <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                  <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                  <?php echo wpsc_checkout_form_name();?>
                  </label>
               </td>
               <td>
                  <?php echo wpsc_checkout_form_field();?>
                   <?php if(wpsc_the_checkout_item_error() != ''): ?>
                          <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                  <?php endif; ?>
               </td>
            </tr>

         <?php }//endif; ?>

      <?php endwhile; ?>

<?php
	$buffer_contents = ob_get_contents();
	ob_end_clean();
	if(isset($email_markup))
		echo $email_markup;
	echo $buffer_contents;
?>

      <?php if (wpsc_show_find_us()) : ?>
      <tr>
         <td><label for='how_find_us'><?php _e('How did you find us' , 'wpsc'); ?></label></td>
         <td>
            <select name='how_find_us'>
               <option value='Word of Mouth'><?php _e('Word of mouth' , 'wpsc'); ?></option>
               <option value='Advertisement'><?php _e('Advertising' , 'wpsc'); ?></option>
               <option value='Internet'><?php _e('Internet' , 'wpsc'); ?></option>
               <option value='Customer'><?php _e('Existing Customer' , 'wpsc'); ?></option>
            </select>
         </td>
      </tr>
      <?php endif; ?>
      <?php do_action('wpsc_inside_shopping_cart'); ?>

      <?php  //this HTML displays activated payment gateways   ?>
      <?php if(wpsc_gateway_count() > 1): // if we have more than one gateway enabled, offer the user a choice ?>
         <tr>
            <td colspan='2' class='wpsc_gateway_container'>
               <h3><?php _e('Payment Type', 'wpsc');?></h3>
               <?php wpsc_gateway_list(); ?>
               </td>
         </tr>
      <?php else: // otherwise, there is no choice, stick in a hidden form ?>
         <tr>
            <td colspan="2" class='wpsc_gateway_container'>
               <?php wpsc_gateway_hidden_field(); ?>
            </td>
         </tr>
      <?php endif; ?>

      <?php if(wpsc_has_tnc()) : ?>
         <tr>
            <td colspan='2'>
                <label for="agree"><input id="agree" type='checkbox' value='yes' name='agree' /> <?php printf(__("I agree to the <a class='thickbox' target='_blank' href='%s' class='termsandconds'>Terms and Conditions</a>", "wpsc"), esc_url( home_url( "?termsandconds=true&amp;width=360&amp;height=400" ) ) ); ?> <span class="asterix">*</span></label>
               </td>
         </tr>
      <?php endif; ?>
      </table>

<div class="cart_total_row">
	<div class="span8">&nbsp;</div><!--
    --><div class="span4">
        <div class='wpsc_make_purchase'>
            <span>
            <?php if(!wpsc_has_tnc()) : ?>
	            <input type='hidden' value='yes' name='agree' />
            <?php endif; ?>
                <input type='hidden' value='submit_checkout' name='wpsc_action' />
                <input type='submit' value='<?php _e('Proceed to checkout', 'wpsc');?>' class='green-button wpsc_buy_button wpsc_buy_button' />
            </span>
        </div>
	</div>
</div>

<div class='clear'></div>
</form>
</div>
</div><!--close checkout_page_container-->
<?php
do_action('wpsc_bottom_of_shopping_cart');