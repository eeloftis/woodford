jQuery(document).ready(function($) {
	
	var postformat = ['_BookmeMB_gallery_format_metabox', '_BookmeMB_video_format_metabox', '_BookmeMB_quote_format_metabox', '_BookmeMB_link_format_metabox'];
	var inputformat = {
			'post-format-gallery': '_BookmeMB_gallery_format_metabox', 
			'post-format-video': '_BookmeMB_video_format_metabox', 
			'post-format-quote': '_BookmeMB_quote_format_metabox', 
			'post-format-link': '_BookmeMB_link_format_metabox'
	};
	
	jQuery.each( postformat, function( index, item ) {
		$('#' + item).addClass('hidden');
	});
	
	jQuery.each( inputformat, function( input, format ) {
		if( $( 'input#' + input ).is(':checked') ){
			$( '#' + format ).removeClass( 'hidden' );
		}
		// If post format is selected, show the meta box
		$( 'input#' + input ).change( function() {
			if( $(this).is(':checked') ){
				$( '#' + format ).removeClass( "hidden" );
			}
		} );
	});
	
	
	// Booked Plugin
	
	$('.cmb2-id--BookmeMB-slider-booked-shortcode').hide();
	$('.cmb2-id--BookmeMB-slider-booked-title').hide();
	if ( $( 'input#_BookmeMB_slider_booked_calendar' ).is(':checked') ) {
		$('.cmb2-id--BookmeMB-slider-booked-shortcode').show();
		$('.cmb2-id--BookmeMB-slider-booked-title').show();
	}
		
	$( 'input#_BookmeMB_slider_booked_calendar' ).change( function() {
		if( $(this).is(':checked') ){	
			$('.cmb2-id--BookmeMB-slider-booked-shortcode').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-booked-title').show('slide', {direction: 'up'}, 500);
		} else {
			$('.cmb2-id--BookmeMB-slider-booked-shortcode').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-booked-title').hide('slide', {direction: 'up'}, 500);
		}
	});
	
	
	$('.cmb2-id--BookmeMB-parallax-booked-title').hide();
	$('.cmb2-id--BookmeMB-parallax-booked-shortcode').hide();
	if ( $( 'input#_BookmeMB_parallax_booked_calendar' ).is(':checked') ) {
		$('.cmb2-id--BookmeMB-parallax-booked-title').show();
		$('.cmb2-id--BookmeMB-parallax-booked-shortcode').show();	
	}
	$( 'input#_BookmeMB_parallax_booked_calendar' ).change( function() {
		if( $(this).is(':checked') ){	
			$('.cmb2-id--BookmeMB-parallax-booked-title').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-parallax-booked-shortcode').show('slide', {direction: 'up'}, 500);	
		} else {
			$('.cmb2-id--BookmeMB-parallax-booked-title').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-parallax-booked-shortcode').hide('slide', {direction: 'up'}, 500);	
		}
	});
	
	
	// Rev Slider
	
	$('.cmb2-id--BookmeMB-rev-slider-alias').hide();
	$('.cmb2-id--BookmeMB-slide-img').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-caption-position').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-slider-small-title').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-slider-content').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-sld-btn1-text').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-sld-btn1-url').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-sld-btn2-text').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-sld-btn2-url').show('slide', {direction: 'up'}, 500);
	if ( $( 'input#_BookmeMB_rev_slider' ).is(':checked') ) {
		$('.cmb2-id--BookmeMB-rev-slider-alias').show();
		$('.cmb2-id--BookmeMB-slide-img').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-caption-position').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-slider-small-title').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-slider-content').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-sld-btn1-text').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-sld-btn1-url').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-sld-btn2-text').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-sld-btn2-url').hide('slide', {direction: 'up'}, 500);
	}
	$( 'input#_BookmeMB_rev_slider' ).change( function() {
		if( $(this).is(':checked') ){	
			$('.cmb2-id--BookmeMB-rev-slider-alias').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slide-img').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-caption-position').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-small-title').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-content').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn1-text').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn1-url').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn2-text').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn2-url').hide('slide', {direction: 'up'}, 500);
		} else {
			$('.cmb2-id--BookmeMB-rev-slider-alias').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slide-img').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-caption-position').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-small-title').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-slider-content').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn1-text').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn1-url').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn2-text').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-sld-btn2-url').show('slide', {direction: 'up'}, 500);
		}
	});
	
	$('.cmb2-id--BookmeMB-acc3-rev-slider-alias').hide();
	$('.cmb2-id--BookmeMB-acc3-slide-img').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-acc3-quote-small-text').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-acc3-quote-title').show('slide', {direction: 'up'}, 500);
	$('.cmb2-id--BookmeMB-acc3-cf7-form').show('slide', {direction: 'up'}, 500);
	if ( $( 'input#_BookmeMB_acc3_rev_slider' ).is(':checked') ) {
		$('.cmb2-id--BookmeMB-acc3-rev-slider-alias').show();
		$('.cmb2-id--BookmeMB-acc3-slide-img').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-acc3-quote-small-text').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-acc3-quote-title').hide('slide', {direction: 'up'}, 500);
		$('.cmb2-id--BookmeMB-acc3-cf7-form').hide('slide', {direction: 'up'}, 500);
	}
	$( 'input#_BookmeMB_acc3_rev_slider' ).change( function() {
		if( $(this).is(':checked') ){
			$('.cmb2-id--BookmeMB-acc3-rev-slider-alias').show();
			$('.cmb2-id--BookmeMB-acc3-slide-img').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-quote-small-text').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-quote-title').hide('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-cf7-form').hide('slide', {direction: 'up'}, 500);
		} else {
			$('.cmb2-id--BookmeMB-acc3-rev-slider-alias').hide();
			$('.cmb2-id--BookmeMB-acc3-slide-img').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-quote-small-text').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-quote-title').show('slide', {direction: 'up'}, 500);
			$('.cmb2-id--BookmeMB-acc3-cf7-form').show('slide', {direction: 'up'}, 500);
		}
	});
	
	$('#redux-header').prepend('<div class="bookme-logo"></div>');
	
	
})