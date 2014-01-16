$(document).ready(function(){
	
	// GLOBAL VARIABLES
	
	//MENU PROMO AREA
	
	var hovered = false, opening = false, closing = false;
	
	$('#menu-primary > li:not(.no-sub)').hover(function(){
		if($(this).is(':hover') || $('#primary-sub-navigation').is(':hover') || $('#secondary-navigation').is(':hover')){
			opening = true;
			liElement = this;
			$('#primary-sub-navigation').stop(true,false).animate({height: getMenuHeight(this)},300);
			$(liElement).addClass('active');
			$('#primary-sub-navigation').promise().done(function(){
				$('.menu-promo-area').stop().fadeOut();
				console.log('fadin');
				$(liElement).find('.menu-promo-area').stop().fadeIn(300,function(){
					$(this).css({opacity:1})
					if(closing){
						$('#menu-primary > li.active').removeClass('active');
						$('.menu-promo-area').stop().fadeOut(300).promise().done(function(){
							if(!$('#menu-primary > li:hover').length){
								$('#primary-sub-navigation').stop(true,false).animate({height: 0},300);
							}
							closing = false;
						});
					}
				});	
				opening = false;
			});
		}
	}, function() {
		if($(this).not(':hover').length && $('#primary-sub-navigation').not(':hover').length && $('#secondary-navigation').not(':hover').length){
			closing = true;
			if(!opening) {
				$('#menu-primary > li.active').removeClass('active');
				$('.menu-promo-area').stop().fadeOut(300).promise().done(function(){
					if(!$('#menu-primary > li:hover').length){
						$('#primary-sub-navigation').stop(true,false).animate({height: 0},300);
					}
					closing = false;
				});
			}
		}
	});
	
	$('#primary-sub-navigation, #secondary-navigation').hover(function(){
		if($(this).is(':hover')){
			opening = true;
			console.log('fadin');
			$('#primary-sub-navigation').stop(true,false).animate({height: getMenuHeight($('#menu-primary > li.active'))},300);			
			$('#primary-sub-navigation').promise().done(function(){
				opening = false;
			});
		}
	}, function() {
		if($(this).not(':hover')){
			closing = true;
			console.log('fadout '+opening);
			$('.menu-promo-area').stop(true,true).fadeOut(300).promise().done(function(){
				$('#menu-primary > li.active').removeClass('active');
				$('#primary-sub-navigation').stop(true,false).animate({height: 0},300);
				closing = false;
			});
		}
	});
	
	function getMenuHeight(element) {
		if ($(element).find('.menu-promo-area').height() > $(element).find('.sub-menu').height()){
			return $(element).find('.menu-promo-area').height();
		} else {
			return $(element).find('.sub-menu').height();
		}
	}
	
	$('.bucket-widget-area .slider').each(function(){
		if ($(this).find('.content-bucket.span4').length > 3) { //There are more than 3 boxes
			$(this).elastislide({
				minItems: 3	
			});
		} else if ($(this).find('.content-bucket.span3').length > 4) { //There are more than 3 boxes
			$(this).elastislide({
				minItems: 4	
			});
		}
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
		$(this).next().fadeIn();
	}, function() {
		$(this).next().fadeOut();
	});
	
});

