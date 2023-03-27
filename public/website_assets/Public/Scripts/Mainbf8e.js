(function($) {
    //Hyphenator.config({
    //    displaytogglebox : false,
    //    minwordlength : 8
    //});
    // Hyphenator.run();
    $(document).ready(function() {
    	$('p.result-content').each(function(){
    		$(this).html($(this).html().replace(new RegExp(' @ ', 'g'),'@').replace(new RegExp(' . ','g'),'.') + ' ... ');
    	});
		$('[data-unfiltered]').each(function(){
			var element = $(this);
			var image = $(this).attr('src');

			element.parent('position', 'relative');

			var unfiltered = element.clone();
			unfiltered.css('position', 'absolute').css('top', '0px').addClass('unfiltered');
			element.after(unfiltered);
			element.attr('src', element.attr('data-unfiltered'));

			// $(this).on('mouseenter', function(){
			// 	unfiltered.fadeOut();
			// 	// element.attr('src', element.attr('data-unfiltered'));
			// });
			// $(this).on('mouseleave', function(){
			// 	// unfiltered.fadeIn();
			// 	// element.attr('src', image);
			// });

			var	container = element.parent('.image-with-description, .item');
			container.on('mouseenter', function(){
				// unfiltered.slideUp();
				unfiltered.css('opacity', 0);
				container.find('.carousel-caption').hide();
			});
			container.on('mouseleave', function(){
				// unfiltered.slideDown();
				unfiltered.css('opacity', 1);
				container.find('.carousel-caption').show();
			});
		});

		$(".sticky-in-parent:visible").stick_in_parent();

		var stickyHeader = $('.sticky-header');
		$(window).on('scroll', function(){
			if ($(window).scrollTop() > 0) {
				stickyHeader.addClass('is_stuck');
			} else {
				stickyHeader.removeClass('is_stuck');
			}
		});

		$('.nav-primary .dropdown').on('mouseenter', function () {
			$('.nav-primary-background').show();
		})
		$('.nav-primary .dropdown').on('mouseleave', function () {
			$('.nav-primary-background').hide();
		})

		$('.selectpicker').selectpicker();
		$('select.form-control').selectpicker();

        $('.contact-flyout-icon').click(function(){
			$('.contact-flyout').addClass('open');
			$( ".contact-flyout-body" ).animate({
				left: "0"
			}, 100, "linear", function() {
			});
        });

        $('.contact-flyout .icon-arrow-right').on('click', function(){
			$( ".contact-flyout-body" ).animate({
				left: "100%"
			}, 100, "linear", function() {
				$('.contact-flyout').removeClass('open');
			});
        });

        if ($('.anchor-navigation').length > 0) {
        	$('body').scrollspy({target: '.anchor-navigation' });
        }

        $.Finger = {
		    flickDuration: 1000,
		    motionThreshold: 5
		};

		$('.drilldown').drilldown();

		// automatically open accordion based on hash in url
		if (location.hash) {
			var id = location.hash;
			if ($(id).length > 0 && $(id).hasClass('panel')) {
				$(id).parents('.panel-group').find('.collapse').removeClass('in');
				$(id).find('.collapse').collapse('show');

				setTimeout(function() {
					window.smoothScroll($(id)[0]);
					// remove the height of the wrapping div of the accordion!
					$('.content-wrapper').removeAttr('style');

				}, 200);
		  	}
		}

		// set hash in url when an accordion panel is opened
		$('.panel-collapse').on('show.bs.collapse', function () {
			$(this).parents('.panel-group').find('.collapse').collapse('hide');
			$(this).parents('.panel-group').find('.accordion-toggle .icon-circle').removeClass('icon-chevron-down');

			// remove the height of the wrapping div of the accordion!
			$('.content-wrapper').removeAttr('style');

			var id = $(this).attr('id');

			$('#' + id + '-panel .accordion-toggle .icon-circle').addClass('icon-chevron-down');
			history.pushState('', document.title, window.location.pathname + window.location.search + '#' + id + '-panel');
		})

		$('.panel-collapse').on('hidden.bs.collapse', function () {
			var id = $(this).attr('id');

			$('#' + id + '-panel .accordion-toggle .icon-circle').removeClass('icon-chevron-down');
			if ('#' + id  == location.hash) {
				history.pushState('', document.title, window.location.pathname + window.location.search);
			}
		})

		$('.anchor-navigation a').on('click', function() {
			var id = $(this).attr('href');

			// remove id to prevent scrolling
			var target = $(id);
			target.removeAttr('id');
			location.hash = id;
			// readd id after setting location.hash
			target.attr('id', id.replace('#', ''));

			window.smoothScroll(target[0]);
			return false;
		});

		// autohide collapsibles when clicking outside of the collapsible itself
		$('body').click(function(e){
			if ($('.collapse.in').length == 0) {
				return;
			}
			if ($(e.target).hasClass('accordion-toggle')) {
				return;
			}
			$('.collapse.in').not(e.target).not($(e.target).parents('.collapse.in')).not('.panel-collapse').not('.search-primary').collapse('hide');
		});


		$('.search-primary').on('shown.bs.collapse', function () {
			$('.search-primary').find('input').focus();
		});

		$('.image-gallery').magnificPopup({
			delegate: 'a.lightbox',
			type: 'image',
			tClose: 'schließen (Esc)',
			gallery:{
				enabled: true,
				tPrev: 'vorheriges Bild (linke Pfeiltaste)',
				tNext: 'nächstes Bild (recht Pfeiltaste)',
				tCounter: '%curr% von %total%'
			}
		});

		$('.demand-filter, .month-selector-input-month').change(function() {
			var form = $(this).parents('form');
			form.submit();
			/*
			 var queryString = form.serialize();
			 $.get("/?eID=cHashHelper&cHashQuery=" + encodeURIComponent(queryString), function( cHash ) {
			 var uri = form.attr('action').split('?')[0] + '?' + queryString + '&cHash=' + cHash;
			 alert(uri);
			 //window.location = uri;
			 });
			*/
		});

		$('.home-slider-event').on('slide.bs.carousel', function (e) {
			var index = $(e.relatedTarget).attr('data-index');
			$(this).find('[data-slide-to], [data-slide]').removeClass('active');
			$(this).find('[data-slide-to="' + index + '"], [data-slide="' + index + '"]').addClass('active');
		})

		$('.menu-popup-toggle').click(function(){
			$('.menu-popup').toggleClass('hidden');
		})

		$('#menuBtnCircleSlideTop').click(function(){
            $('html,body').animate({ scrollTop: 0 }, 500);
            return false;
        })
	});
})(jQuery);
var urlLinkPrepare = function(url,removeProtocol){
	url = url.toLowerCase();
	var reg1 = new RegExp("https://","i");
	var reg2 = new RegExp("http://","i");
	if( typeof removeProtocol === 'undefined'){
        removeProtocol = false;
	}
	if(removeProtocol){
		if(url.match(reg1)){
			return url.replace(reg1,'');
		}else if(url.match(reg2)){
			return url.replace(reg2,'');
		}else{
			return url;
		}
	}else{
		if(url.match(reg1) || url.match(reg2)){
			return url
		}else{
			return 'http://'+url;
		}
	}
}