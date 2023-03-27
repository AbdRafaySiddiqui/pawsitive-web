(function($) {
	var NavSwipe = Class.extend({
		init: function(element){
			this.element = $(element);
			this.addEventListeners();
			this.offsets = [];

			var counter = 0;
			this.element.find('li').each(function(){
				var paddingLeft = parseInt($(this).find('a').css('padding-left').replace(/px/, ''));
				$(this).data('left', $(this).position().left - (paddingLeft * counter));
				counter++;
			});
			this.element.find('li').first().addClass('active');
			this.centerActiveElement();
		},

		addEventListeners: function() {
			var ref = this;

			this.element.on('click', 'a', function(e){
				ref.element.find('li').removeClass('active');
				$(this).parent('li').addClass('active');
				ref.centerActiveElement();
			});

			this.element.parent('.anchor-navigation').on('activate.bs.scrollspy', function(e) {
				ref.centerActiveElement();
			})

			this.element.parent('.anchor-navigation').on('swipeleft', function(e) {
				var nextItem = ref.element.find('li.active').next('li');
				if (nextItem.length > 0) {
					nextItem.find('a').click();
				}
			});
			this.element.parent('.anchor-navigation').on('swiperight', function(e) {
				var nextItem = ref.element.find('li.active').prev('li');
				if (nextItem.length > 0) {
					nextItem.find('a').click();
				}
			});
		},

		centerActiveElement: function() {
			var activeElement = this.element.find('.active');
			var left = activeElement.data('left');

			var offset = ( left - (this.element.width() / 2)  + (activeElement.outerWidth() / 2) ) * -1;
			this.element.find('li').animate({left: offset + 'px'}, 300);
		}
	});

    $(document).ready(function() {
    	$('.nav-swipe').each(function(){
    		new NavSwipe(this);
    	});
	});
})(jQuery);