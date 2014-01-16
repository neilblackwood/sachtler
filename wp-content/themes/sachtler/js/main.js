// GLOBAL VARIABLES
var totalItemsPerCompare = 2;
var fadeTimeDuration = 300;

$(document).ready(function(){
	// ==== Breadcrumb
	$('#breadcrumb a').click(function () { if($(this).attr('href') == $(location).attr('href')) return false; });
	$('a.rfb_link').click(function () { return false; });
	
	// MENU PROMO AREA
	
	var animDuration = 300, topMenuContentHeight = 212;
	// ==== main menu 
	$('#menu-primary li').on({
		mouseenter: function(){
			$('.menuwrapper').data('entered',true);
		
			var obj = $(this);
			$('#menu-primary li').each(function() { //update active class on the tab
				if(obj != $(this)) $(this).removeClass('active');
			});	
			obj.addClass('active');
			$('#primary-sub-menu .menu-promo-area').each(function() {// hide tab content
				if(obj != $(this)) $(this).hide().removeClass('active');
			});	
			$('#primary-sub-menu .'+$(this).attr('id')).show();// display tab content
			
			$('#menu-configurator .configurator').removeClass('active');// update configurator button
		}
	});
	$('#menu-primary').on({
		mouseenter: function(){
			
			setTimeout(function(){
				if($('.menuwrapper').data('entered') == true){
					$('#primary-sub-navigation').css({'overflow':'hidden'}).stop( true, true ).animate({height: topMenuContentHeight}, animDuration);
				}
			}, 300);
			
		}
	});
	$('.menuwrapper').on({
		mouseleave: function() {
			$(this).data('entered',false);
			if(!$('#menu-configurator .configurator').is('.active')){$('#primary-sub-navigation').stop( true, true ).animate({height: 0},animDuration);}
			$('#menu-primary li.active').removeClass('active');
		}
	});

	// ==== configurator button
	$('#menu-configurator li.configurator').on({
		click: function(){
			$(this).toggleClass('active');
			if($(this).is('.active')){
				$('#primary-sub-navigation').css({'overflow':'hidden'}).stop( true, true ).animate({height: topMenuContentHeight}, animDuration);
				$('#menu-primary li.active').removeClass('active');
				$('#primary-sub-menu > *').hide().parent().find('.configurator').show();// display tab content
				
			}else{
				$('#primary-sub-navigation').css({'overflow':'hidden'}).stop( true, true ).animate({height: 0}, animDuration);
			}
			return false;
		}
	});
	
	

	
	
	if($('#page-content.product-configurator').length){
		$('#menu-configurator li.configurator').click();
	}
	
	$('.bucket-widget-area .slider').each(function(){
		var mItems = 0
		if ($(this).find('.content-bucket.span4').length > 3) { //There are more than 3 boxes
			mItems = 3;
		} else if ($(this).find('.content-bucket.span3').length > 4) { //There are more than 3 boxes
			mItems = 4;
		}else if ($(this).find('.content-bucket.span3').length > 4) { //There are more than 3 boxes
			mItems = 1;
		}
		
		
		$(this).elastislide({ minItems: mItems});
		
		$(this).find('li').each(function(index){
		   if(index%(mItems) == 0) $(this).addClass('new-line');
		});
		
	});
	$('#product_gallery_col .gallery').each(function(){
		var mItems = 1;
		$(this).elastislide({ minItems: mItems});
		
		$(this).find('li').each(function(index){
		   if(index%(mItems) == 0) $(this).addClass('new-line');
		});
		
	});
	$('#feature-selector li').click(function(){
		$(this).toggleClass('active');
		var classes = $(this).attr('class').split(' ');
		if($(this).hasClass('active')){
			$('div.feature.'+classes[0]).show().addClass('visible');
			$('div.feature').removeClass('new-line');
			$('div.feature.visible').filter(function(i){return((i)%4 == 0)}).addClass('new-line');
		} else {
			$('div.feature.'+classes[0]).hide().removeClass('visible');
			$('div.feature').removeClass('new-line');
			$('div.feature.visible').filter(function(i){return((i)%4 == 0)}).addClass('new-line');
		}
	});
	
	
	$('#indicator').click(function(){
		if($(this).hasClass('metric')) {
			convert('imperial');
		} else if ($(this).hasClass('imperial')) {
			convert('metric');
		}
	});
	
	$('#product-units-switcher #metric-switch').click(function(){
		convert('metric');
	});
	
	$('#product-units-switcher #imperial-switch').click(function(){
		convert('imperial');
	});
	
	function convert(units) {
		if(units == 'metric'){
			$('p[class*="tech"] span.metric').show();
			$('p[class*="tech"] span.imperial').hide();
			$('#product-units-switcher #indicator').removeClass('imperial').addClass('metric');
		} else if (units == 'imperial') {
			$('p[class*="tech"] span.metric').hide();
			$('p[class*="tech"] span.imperial').show();
			$('#product-units-switcher #indicator').removeClass('metric').addClass('imperial');
		}
	}
	
	function _convert(units) {
		if(units == 'metric'){
			console.log('Converting to metric...');
			$('.convert.imperial.lbs').each(function(){
				$(this).html($(this).attr('metricValue')).removeClass('imperial lbs').addClass('metric kg');
			});
			$('.convert.imperial.in').each(function(){
				$(this).html($(this).attr('metricValue')).removeClass('imperial in').addClass('metric cm');
			});
			$('.convert.unit').each(function(){
				$(this).html($(this).html().replace('in','cm').replace('lbs','kg'));
			});
			$('#product-units-switcher #indicator').removeClass('imperial').addClass('metric');
		} else if (units == 'imperial') {
			console.log('Converting to imperial...');
			$('.convert.metric.kg').each(function(){
				$(this).attr('metricValue',$(this).html());
				$(this).html((parseFloat( $(this).text() ) * 2.20462).toFixed(0)).removeClass('metric kg').addClass('imperial lbs');
			});
			$('.convert.metric.cm').each(function(){
				$(this).attr('metricValue',$(this).html());
				$(this).html((parseFloat( $(this).text() ) * 0.393700787).toFixed(0)).removeClass('metric cm').addClass('imperial in');
			});
			$('.convert.unit').each(function(){
				$(this).html($(this).html().replace('cm','in').replace('kg','lbs'));
			});
			$('#product-units-switcher #indicator').removeClass('metric').addClass('imperial');
		}
	}
	
	$('.tabify').tabify();
	
	$('span.material').hover(function(){
		$('div.material-desc').fadeIn();
	}, function() {
		$('div.material-desc').fadeOut();
	});
	
	// Submit the product form using AJAX
	jQuery( 'form.product_form, .wpsc-add-to-cart-button-form' ).on( 'submit', function() {
		// we cannot submit a file through AJAX, so this needs to return true to submit the form normally if a file formfield is present
		file_upload_elements = jQuery.makeArray( jQuery( 'input[type="file"]', jQuery( this ) ) );
		if(file_upload_elements.length > 0) {
			return true;
		} else {
			$('.wpsc_buy_button_container .red-button').addClass('green-button').removeClass('red-button').attr('Value','...added');
			return false;
		}
	});
	
	// Configurator form
	
	$('#configuratorform select#b').on('change', function(){
		if($(this).val() > 0){
			$('#configuratorform select#ml').removeAttr('disabled');
			uncomment($('#configuratorform select#ml'));
			comment($('#configuratorform select#ml option').not('.'+$(this).val()+', .default'));
		} else {
			$('#configuratorform select#ml').val(0);
			$('#configuratorform select#ml').attr('disabled','true');
		}
	});
	
	if($('#configuratorform select#ml').val() > 0 || $('#configuratorform select#b').val() > 0) {
		$('#configuratorform select#ml').removeAttr('disabled');
	}
	
	function comment(element){
		element.wrap(function() {
			return '<!--' + this.outerHTML + '-->';
		});
	}
	
	function uncomment(element){
		element.html(element.html().replace(/<!--/g,'').replace(/-->/g,''));
	}
	
	
	$('.compareInput').each(function() {//update product checkbox status
		updateCompareProductCheckboxes($(this));
	});
	
	$('#page-content.product-comparison a.grey-button.delete').click(function(event){
		event.preventDefault();
		$obj = $(this);
		//delete the item
		$obj.closest('.span2.col-display').fadeOut(200, function(){
			//delete the item from cookie
			deleteProductfromCompareCookie($obj.attr('data-id'), $obj.attr('data-category')+'-compare');			
		}).remove();
	});
	
	// SINGLE PRODUCT PAGE COMPARE BUTTONS
	if($('body').is('.single-wpsc-product')){
		var category = $('#wpsc-crumb-').html();
		var $this = $('a.add-to-compare');
		
		category = category.toLowerCase().replace( ' ','-');
	
		$this.attr({'data-category': category, 'data-action':'remove'});
		var name = category + '-compare';
		var val = getCookie(name);
		updateTotItemsInList(val);

		//update add-to-compare button status
		if(val != null){
			if(val.indexOf($this.attr('data-id')) >= 0 ){ 
				$('#product-compare-row .add-to-compare').attr('data-action','remove').html('Remove Comparison');
			}else{
				$('#product-compare-row .add-to-compare').attr('data-action', 'add');
			}
		}else{
			$('#product-compare-row .add-to-compare').attr('data-action', 'add');
		}
		// add click action to add-to-compare button 
		$('#product-compare-row .add-to-compare').click(function(event) {
			if($(this).attr('data-action') == 'add'){
				var count = 0;
				var val = getCookie(name);
				if(val != undefined && val != null & val !=''){
					count = val.match(/,/g); 
				}
				if(count.length >= totalItemsPerCompare){
					//ckeck for tot items allowed on the list
					checkCompareListLimit();
				}else{
					$('#compare-list-overview').hide();
					addProductToCompareCookie($(this).attr('data-id'), category + '-compare');
					$('#product-compare-row .add-to-compare').attr('data-action','remove').html('Remove Comparison');
				}
			}else if($(this).attr('data-action') == 'remove'){
				deleteProductfromCompareCookie($this.attr('data-id'), $this.attr('data-category')+'-compare');
				$('#product-compare-row .add-to-compare').attr('data-action','add').html('Add Comparison');
				if($('#product-overview-list').find('#div_'+$this.attr('data-id')).length > 0){
					$('#product-overview-list').find('#div_'+$this.attr('data-id')).remove();
				}
			}
		});
		
		//update SHOW COMPARISON button link to the right category
		$('.show-comparison-list-bt').attr({'href':'/sachtler/product-comparison/?ct=' + category});
		
	}// END - if($('body').is('.single-wpsc-product'))
});


// COOKIE FUNCTIONS
/* standard cookie functions */ 
function setCookie(name,value,days) {if (days) { var date = new Date(); date.setTime(date.getTime()+(days*24*60*60*1000)); var expires = "; expires="+date.toGMTString(); } else var expires = ""; document.cookie = name+"="+value+expires+"; path=/";}
function getCookie(name) { var nameEQ = name + "="; var ca = document.cookie.split(';'); for(var i=0;i < ca.length;i++) { var c = ca[i]; while (c.charAt(0)==' ') c = c.substring(1,c.length); if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length); } return null; }
function delCookie(name) {	createCookie(name,"",-1);}

/* convert the boolean value of the checkbox to a string of 1 or 0 to write to the cookie value */
function setCompareProductCookie (name,cbvalue) { 
	var val = getCookie(name); 
	if(val!=undefined){ 
		if(cbvalue.checked) { 
			if (val.toLowerCase().indexOf(','+$(cbvalue).attr('value')) < 1){ 
				//check for tot items allowed within comparison list
				var count = 0;
				if(val != undefined && val != null & val !=''){ count = val.match(/,/g); }
				if(count.length >= totalItemsPerCompare){
					//ckeck for tot items allowed on the list
					$(cbvalue).attr('checked', false).closest('.center').append('<div class="popup">You have reached the total comparison limit.</div>');
					$(cbvalue).attr('checked', false).closest('.center').find('.popup').fadeIn(fadeTimeDuration,function() {
						var $obj = $(this);

							$obj.parent().mouseleave(function(){
								$(this).find('.popup').fadeOut().remove();
							});

					});
					
				}else{
					//add the item to the list
					val += ','+$(cbvalue).attr('value'); 
					setCookie(name, val); 
				}
			}else{ 
				setCookie(name, ''); 
			} 
		} else { 
			val = val.replace(','+$(cbvalue).attr('value'), '');
			setCookie(name, val); 
		}
	}else{
		val += ','+$(cbvalue).attr('value');
		setCookie(name, val); 
	}
}
// this functioon will update the product compare checkbox status
function updateCompareProductCheckboxes (obj) {
	var cat= obj.attr('category');
	var val= getCookie(cat+'-compare');
	
	if(val != null){
		if (val.toLowerCase().indexOf(','+$(obj).attr('value')) >= 0){
			obj.attr('checked','checked');
		}
	}
}
// delete the item from cookie
function deleteProductfromCompareCookie (id,name) {
	var val = getCookie(name);
	if(val!=undefined){
		val = val.replace(',' + id , '');
		setCookie(name, val); 
		if($('.wpsc-product_category_list .col-display').length < totalItemsPerCompare){
			$('.wpsc-product_category_list').fadeOut(fadeTimeDuration,function() { $(this).remove(); });
		}		
	}
	updateTotItemsInList(val);
}
// delete the item from cookie on single-product page
function addProductToCompareCookie (id,name) {
	var val = getCookie(name);
	if(val!=undefined){
		val = val + ',' + id ;
		setCookie(name, val); 	
	}else{
		val =  ',' + id ;
		setCookie(name, val); 
	}
	updateTotItemsInList(val);
}
function updateTotItemsInList(val){	
	if(val != undefined && val != null & val !=''){
		var count = val.match(/,/g); 
		$('.total-comp-items').html(count.length);
	}else {
		$('.total-comp-items').html(0);
	}
}
function checkCompareListLimit(){
	$('#compare-list-overview').show(fadeTimeDuration).find('p').fadeIn(fadeTimeDuration);
	$('#compare-list-overview .wrapperbox .x-icon').click(function(){
		var $this = $(this);
		deleteProductfromCompareCookie($this.attr('data-id'), $this.attr('data-category')+'-compare');
		$(this).closest('.wrapperbox').hide(fadeTimeDuration).remove().closest();
		$('#compare-list-overview p').fadeOut(fadeTimeDuration);
		
	});
}
