(function($) {
	var EventSlider = Class.extend({
		init: function(element){
			this.element = $(element);
			this.visibleItems = 3;

			for (var i = 0; i < this.visibleItems; i++) {
				this.element.find('.event-slider-items').prepend('<div class="event-slider-item event-slider-dummy" />');
				this.element.find('.event-slider-items').append('<div class="event-slider-item event-slider-dummy" />');
			}

	    	this.addEventListeners();
	    	this.updateClasses();
		},

		addEventListeners: function() {
			var slider = this;

		    this.element.find('.event-slider-previous').click(function(e){
		    	e.preventDefault();
			    slider.previous();
		    });

		    this.element.find('.event-slider-next').click(function(e){
		    	e.preventDefault();
			    slider.next();
		    });

		    this.element.on('swipeleft', function(e) {
				slider.next();
			});
			this.element.on('swiperight', function(e) {
				slider.previous();
			});
		},

		next: function() {
			var currentItem = this.element.find('.event-slider-item.focus');
			var nextItem = currentItem.next('.event-slider-item');
			if (nextItem.length > 0) {
				currentItem.removeClass('focus');
				nextItem.addClass('focus');
			}

			this.updateClasses();
		},

		previous: function() {
			var currentItem = this.element.find('.event-slider-item.focus');
			var prevItem = currentItem.prev('.event-slider-item');
			if (prevItem.length > 0) {
				currentItem.removeClass('focus');
				prevItem.addClass('focus');
			}

			this.updateClasses();
		},

		updateClasses: function() {
			var currentItem = this.element.find('.event-slider-item.focus');
			this.element.find('.event-slider-item').removeClass('preview').removeClass('preview-1').removeClass('preview-2').removeClass('preview-3');

			var slider = this;
			var counter = this.visibleItems;
			currentItem.nextAll('.event-slider-item').each(function(){
				if (counter == 0) {
					return;
				}
				$(this).addClass('preview').addClass('preview-' + (slider.visibleItems - counter + 1));
				counter--;
			})
			var counter = this.visibleItems;
			currentItem.prevAll('.event-slider-item').each(function(){
				if (counter == 0) {
					return;
				}
				$(this).addClass('preview').addClass('preview-' + (slider.visibleItems - counter + 1));
				counter--;
			});

			// show/hide prev/next based on available items
			if (currentItem.prevAll('.event-slider-item').length > this.visibleItems) {
				this.element.find('.event-slider-previous').show();
			} else {
				this.element.find('.event-slider-previous').hide();
			}

			if (currentItem.nextAll('.event-slider-item').length > this.visibleItems) {
				this.element.find('.event-slider-next').show();
			} else {
				this.element.find('.event-slider-next').hide();
			}
		}
	});

    $(document).ready(function() {
    	$('.event-slider').each(function(){
    		new EventSlider(this);
    	});
	});
})(jQuery);