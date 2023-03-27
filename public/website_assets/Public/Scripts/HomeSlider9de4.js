(function($) {
	var HomeSlider = Class.extend({
		init: function(element){
			this.element = $(element);
			var duration = this.element.attr('data-slide-duration');
			var ref = this;

			if (!duration > 0) {
				return;
			}

	    	$(window).resize(function(){ref.updateItemSizes();});
	    	this.updateItemSizes();

	    	var that = this;
	    	setInterval(function(){that.nextSlide();}, duration);
	    	this.addEventListeners();
		},

		addEventListeners: function() {
			var slider = this;
		    // Slider on Homepage
		    this.element.find('.home-slider-item').click(function(){
			    slider.setSlide($(this));
		    });

			this.element.find('.slide-indicator a[data-target]').click(function(e){
				e.preventDefault();
				slider.setSlide($($(this).attr('data-target')));
			});

			this.element.find('.slide-indicator a[data-target]').on('mouseenter', function(e){
				e.preventDefault();
				slider.showTitle($($(this).attr('data-target')));
			});

			this.element.find('.slide-indicator a[data-target]').on('mouseleave', function(e){
				e.preventDefault();
				slider.showTitle(slider.element.find('.home-slider-item.active'));
			});
		},

		updateItemSizes: function(){
			var homeSlider = this.element;
			this.element.find('.home-slider-item').each(function(){
				var focus = parseFloat($(this).attr('data-focus'));
				var images = $(this).find('img');
				images.width($('.home-slider').width() * 0.7).css('height', 'auto');
				images.css('margin-left', '-' + (homeSlider.width() * focus * 0.7) + 'px');
			});
			this.element.find('.home-slider-item').height(this.element.find('.home-slider-item img').height());
		},

		nextSlide: function() {
	    	try {
		    	if (this.element.is(":hover")) {
		    		return;
		    	}
	    	} catch(e){};

	    	var activeItem = this.element.find('.home-slider-item.active');

	    	var nextItem;
	    	if (activeItem.next('.home-slider-item').length > 0) {
	    		nextItem = activeItem.next('.home-slider-item');
	    	} else {
	    		nextItem = this.element.find('.home-slider-item').first();
	    	}

	    	this.setSlide(nextItem);
		},

		showTitle: function(item) {
			this.element.find('.topic-indicator-title').addClass('hidden');
	    	this.element.find('.topic-indicator-title[data-slide="#' + item.attr('id') + '"]').removeClass('hidden');
		},

		setSlide: function(item) {

            // activate nav-box
			var navboxId = '#homeSliderNavBox_' + item.data('navbox');
            $('.home-slider-navbox').removeClass('active');
            $(navboxId).addClass('active');

			// show slide
	    	this.element.find('.home-slider-item.active').removeClass('active');
	    	item.addClass('active');

			// show matching title
			this.showTitle(item);


	    	// highlight matching indicator
	    	this.element.find('.slide-indicator span').removeClass('icon-blue');
	    	this.element.find('.slide-indicator [data-target="#' + item.attr('id') + '"] span').addClass('icon-blue');



		}
	});

    $(document).ready(function() {

    	$('.home-slider').each(function(){
    		var slider = this;
    		$(slider).imagesLoaded(function() {
				new HomeSlider(slider);
    		});
    	});

	});
})(jQuery);