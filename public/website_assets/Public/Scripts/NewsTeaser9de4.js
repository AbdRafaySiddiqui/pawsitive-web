(function($) {
	var NewsTeaser = Class.extend({
		init: function(element){
			this.element = $(element);
			if (this.element.find('img').length == 0) {
				return;
			}
			this.addEventListeners();

			var ref = this;
	    	$(window).resize(function(){ref.initialize();});
	    	this.initialize();
		},

		initialize: function(){
			this.element.find('.news-teaser-body').hide();
			this.element.find('.news-teaser-overlay').css('position', 'static').css('top', 'auto');
			this.element.css('height', 'auto');

			this.element.height(this.element.height());
			this.element.find('.news-teaser-body').show();
			this.element.find('.news-teaser-overlay').css('position', 'absolute');
			this.topOffset = this.element.find('.news-teaser-overlay').position().top;

			this.element.find('.news-teaser-overlay').css('top', this.topOffset + 'px');
		},

		addEventListeners: function() {
			var ref = this;

			this.element.on('mouseenter', function(){
				ref.element.addClass('hover');
				ref.element.find('.news-teaser-overlay').css('top', '0px');
				// ref.element.find('.news-teaser-image').finish().slideUp();
				// ref.element.find('.news-teaser-body').slideDown();
			});
			this.element.on('mouseleave', function(){
				ref.element.removeClass('hover');
				ref.element.find('.news-teaser-overlay').css('top', ref.topOffset + 'px');
				// ref.element.find('.news-teaser-image').finish().slideDown();
				// ref.element.find('.news-teaser-body').finish().slideUp();
			});
		}
	});

    $(document).ready(function() {
    	$('.news-teaser-reveal').each(function(){
    		new NewsTeaser(this);
    	});

	});
})(jQuery);