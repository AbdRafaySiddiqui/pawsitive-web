(function($) {
	var MonthSelector = Class.extend({
		init: function(element){
			this.element = $(element);

			this.dayInput = this.element.find('.month-selector-input-day');
			this.monthInput = this.element.find('.month-selector-input-month');
			this.yearInput = this.element.find('.month-selector-input-year');

			this.addEventListeners();

			this.render();
		},

		addEventListeners: function() {
			var ref = this;

			this.element.find('[data-toggle]').click(function(e){
				e.preventDefault();
			})

			this.element.find('.js-all-months').click(function(e){
				e.preventDefault();
				ref.dayInput.val('');
				ref.monthInput.val('');
				ref.yearInput.val('');
				ref.monthInput.change();
			});

			this.element.find('.month-selector-now').on('click', function(e){
				e.preventDefault();
				var now = new Date();
				ref.dayInput.val(now.getDate());
				ref.monthInput.val(now.getMonth() + 1);
				ref.yearInput.val(now.getFullYear());
				ref.render();
				ref.monthInput.change();
			});

			this.element.find('[data-month]').click(function(e){
				e.preventDefault();
				ref.monthInput.val($(this).attr(('data-month')));
				var year = parseInt(ref.yearInput.val());
				if (!year > 0) {
					var now = new Date();
					ref.yearInput.val(now.getFullYear());
				}
				ref.dayInput.val('');
				ref.render();
				ref.monthInput.change();
			});

			this.element.find('.month-selector-previous-year').click(function(e){
				e.preventDefault();
				var year = parseInt(ref.yearInput.val());
				if (!year > 0) {
					var now = new Date();
					year = now.getFullYear();
				}
				ref.dayInput.val('');
				ref.yearInput.val(year - 1);
				ref.render();
			});

			this.element.find('.month-selector-next-year').click(function(e){
				e.preventDefault();
				var year = parseInt(ref.yearInput.val());
				if (!year > 0) {
					var now = new Date();
					year = now.getFullYear();
				}
				ref.dayInput.val('');
				ref.yearInput.val(year + 1);
				ref.render();
			});
		},

		render: function() {
			this.element.find('table a').removeClass('active');
			this.element.find('[data-month="' + this.monthInput.val() + '"]').addClass('active');

			var now = new Date();
			currentYear = now.getFullYear();
			if (parseInt(this.yearInput.val()) > 0) {
				this.element.find('.month-selector-year').text(this.yearInput.val());

				if (this.yearInput.val() == currentYear) {
					this.element.find('.month-selector-next-year').hide();
				} else {
					this.element.find('.month-selector-next-year').show();
				}
			} else {
				this.element.find('.month-selector-year').text(currentYear);
				this.element.find('.month-selector-next-year').hide();
			}
		}
	});

    $(document).ready(function() {
    	$('.month-selector').each(function(){
    		new MonthSelector(this);
    	});
	});
})(jQuery);