jQuery(document).ready(function($) {

	"use strict";

	/* ========================================================================= */
	/*  Main Slider
	/* ========================================================================= */

	$("#acc-slides").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		singleItem:true
	});

	/* ========================================================================= */
	/*  Accounting Testimonial Slider
	/* ========================================================================= */

	$("#testimonial-slides .owl-carousel").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		navigationText : ["<span class=\"lnr lnr-arrow-left\"/></span>", "<span class=\"lnr lnr-arrow-right\"/></span>"],
		singleItem:true
	  });

	/* ========================================================================= */
	/*  Accounting Gallery Slider
	/* ========================================================================= */

	$("#gallery-slides .owl-carousel").owlCarousel({

		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		navigationText : ["<span class=\"lnr lnr-arrow-left\"/></span>", "<span class=\"lnr lnr-arrow-right\"/></span>"],
		singleItem:true

	});

	/* ========================================================================= */
	/*  Accounting Team Slider
	/* ========================================================================= */

	$("#team-slides .owl-carousel").owlCarousel({

		navigation : false, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		items: 4

	});

	/* ========================================================================= */
	/*  Therapy Testimonial Slider
	/* ========================================================================= */

	$("#testimonial-therapy").owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false,
		autoPlay : true,
		items:2,
		itemsDesktop: [1199,2],
		itemsDesktopSmall: [979,2],
		itemsTablet: [768,1],
		itemsMobile: [479,1]
	});

	/* ========================================================================= */
	/*  Attorney Testimonial Slider
	/* ========================================================================= */

	$("#testimonial-attorney .owl-carousel").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		navigationText : ["<span class=\"lnr lnr-arrow-left\"/></span>", "<span class=\"lnr lnr-arrow-right\"/></span>"],
		items:2,
		itemsDesktop : [1199,2],
		itemsDesktopSmall : [979,1]
	});

	/* ========================================================================= */
	/*  Trainer Testimonial Slider
	/* ========================================================================= */

	var trainersync1 = $("#testimonial-trainer-img");
	var trainersync2 = $("#testimonial-trainer-content");

	trainersync1.owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false,
		autoPlay : true,
		mouseDrag : false,
		touchDrag : false,
		afterInit : function(el){
			el.find(".owl-item").eq(0).addClass("synced");
		},
		singleItem:true
	});

	trainersync2.owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : true,
		autoPlay : true,
		afterAction : syncPosition,
		mouseDrag : false,
		touchDrag : false,
		singleItem:true
	});

	function syncPosition(el){
		var current = this.currentItem;
		$("#testimonial-trainer-img")
		.find(".owl-item")
		.removeClass("synced")
		.eq(current)
		.addClass("synced")
		if($("#testimonial-trainer-img").data("owlCarousel") !== undefined){
			center(current)
		}
	}

	function center(number){
		var sync2visible = trainersync1.data("owlCarousel").owl.visibleItems;

		var num = number;
		var found = false;
		for(var i in sync2visible){
			if(num === sync2visible[i]){
				var found = true;
			}
		}

		if(found===false){
			if(num>sync2visible[sync2visible.length-1]){
				trainersync1.trigger("owl.goTo", num - sync2visible.length+2)
			}else{
				if(num - 1 === -1){
					 num = 0;
				}
				trainersync1.trigger("owl.goTo", num);
			}
		} else if(num === sync2visible[sync2visible.length-1]){
			trainersync1.trigger("owl.goTo", sync2visible[1])
		} else if(num === sync2visible[0]){
			trainersync1.trigger("owl.goTo", num-1)
		}
	}

	/* ========================================================================= */
	/*  Movers Projects Slider
	/* ========================================================================= */

	var moversync1 = $("#project-mover-img");
	var moversync2 = $("#project-mover-content");

	moversync1.owlCarousel({
		slideSpeed : 300,
		autoHeight : true,
		paginationSpeed : 400,
		pagination : false,
		autoPlay : true,
		mouseDrag : false,
		touchDrag : false,
		afterInit : function(el){
			el.find(".owl-item").eq(0).addClass("synced");
		},
		singleItem:true
	});

	moversync2.owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false,
		navigation : true, // Show next and prev buttons
		navigationText : ["<span class=\"lnr lnr-chevron-left\"/></span>", "<span class=\"lnr lnr-chevron-right\"/></span>"],
		autoPlay : true,
		afterAction : syncMoverPosition,
		mouseDrag : false,
		touchDrag : false,
		singleItem:true
	});

	function syncMoverPosition(el){
		var current2 = this.currentItem;
		$("#project-mover-img")
		.find(".owl-item")
		.removeClass("synced")
		.eq(current2)
		.addClass("synced")
		if($("#project-mover-img").data("owlCarousel") !== undefined){
			center2(current2)
		}
	}

	function center2(number2){
		var sync2visible = moversync1.data("owlCarousel").owl.visibleItems;

		var num2 = number2;
		var found2 = false;
		for(var i in sync2visible){
			if(num2 === sync2visible[i]){
				var found2 = true;
			}
		}

		if(found2===false){
			if(num2>sync2visible[sync2visible.length-1]){
				moversync1.trigger("owl.goTo", num2 - sync2visible.length+2)
			}else{
				if(num2 - 1 === -1){
					num2 = 0;
				}
				moversync1.trigger("owl.goTo", num2);
			}
		} else if(num2 === sync2visible[sync2visible.length-1]){
			  moversync1.trigger("owl.goTo", sync2visible[1])
		} else if(num2 === sync2visible[0]){
			  moversync1.trigger("owl.goTo", num2-1)
		}
	}

	/* ========================================================================= */
	/*  Movers Testimonial Slider
	/* ========================================================================= */

	$("#testimonial-movers .owl-carousel").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		navigationText : ["<span class=\"lnr lnr-arrow-left\"/></span>", "<span class=\"lnr lnr-arrow-right\"/></span>"],
		items:2,
		itemsDesktop : [1199,2],
		itemsDesktopSmall : [979,1]
	});

	/* ========================================================================= */
	/*  Architect Testimonial Slider
	/* ========================================================================= */

	 $("#testimonial-architect").owlCarousel({

		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : true,
		autoPlay : true,
		singleItem:true
	});

	/* ========================================================================= */
	/*  Barber Gallery Slider
	/* ========================================================================= */

	 $("#gallery-barber-slides").owlCarousel({

		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		pagination : false, // Hidden pagination
		autoPlay : true,
		navigationText : ["<span class=\"lnr lnr-arrow-left\"/></span>", "<span class=\"lnr lnr-arrow-right\"/></span>"],
		center: true,
		items:7,
	});

	/* ========================================================================= */
	/*  Corporate Trainer About Slider
	/* ========================================================================= */

	 $("#about-corp-trainer").owlCarousel({
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  pagination : true,
		  autoPlay : true,
		  singleItem:true
	  });

	/* ========================================================================= */
	/*  Corporate Trainer About Slider
	/* ========================================================================= */

	 $("#testimonial-corp-trainer").owlCarousel({
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  pagination : false,
		  autoPlay : true,
		  items:2,
		  itemsDesktop : [1199,2],
		  itemsDesktopSmall : [979,1]
	  });

	/* ========================================================================= */
	/*  Scrolling jQuery
	/* ========================================================================= */

	$('a.page-scroll').bind('click', function(event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500, 'easeInOutExpo');
		event.preventDefault();
	});

	/* ========================================================================= */
	/*  Select jQuery class quote-form
	/* ========================================================================= */

	$(".quote-form select").selectBox();
	$(".contact-form select").selectBox();
	$(".widget_archive select").selectBox();


	/* ========================================================================= */
	/*  Count jQuery
	/* ========================================================================= */

	$(".about-details-count").appear(function () {
        $(".about-details-count [data-to]").each(function () {
            var e = $(this).attr("data-to");
            $(this).delay(6e3).countTo({
                from: 50,
                to: e,
                speed: 3e3,
                refreshInterval: 50
            })
        })
    });

	/* ========================================================================= */
	/*  Points jQuery
	/* ========================================================================= */

	//open interest point description
	$('.cd-single-point').children('a').on('click', function(){
		var selectedPoint = $(this).parent('.cd-single-point');
		if( selectedPoint.hasClass('is-open') ) {
			selectedPoint.removeClass('is-open').addClass('visited');
		} else {
			selectedPoint.addClass('is-open').siblings('.cd-single-point.is-open').removeClass('is-open').addClass('visited');
		}
	});
	//close interest point description
	$('.cd-close-info').on('click', function(event){
		event.preventDefault();
		$(this).parents('.cd-single-point').eq(0).removeClass('is-open').addClass('visited');
	});

	/* ========================================================================= */
	/*  Meanmenu jQuery
	/* ========================================================================= */

	jQuery('header nav').meanmenu({
		meanScreenWidth: '768',
	});

});



function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

scrollToAnchor('about');
