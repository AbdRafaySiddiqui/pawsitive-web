(function($) {
	var TableFixedCollumns = Class.extend({
		init: function(element) {
			this.element = $(element);
			this.width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

			this.setupTable();
			this.syncSizes();

			var ref = this;
			$(window).resize(function(){
				if (ref.width == Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) {
					return;
				}
				ref.syncSizes();
				ref.renderShadows();
			});

			window.setupTable = this.setupTable;
		},

		setupTable: function(){
			var that = this;
			this.table = this.element.find('.table');

			this.container = this.table.parent('.table-responsive');

			this.fixedColumnOverlay = this.table.clone().insertBefore(this.table).addClass('fixed-columns');
			this.fixedColumnOverlay.find('th:not(.fixed-xs),td:not(.fixed-xs)').remove();

			this.leftShadow = $('<div class="overflow-shadow-left"></div>');
			this.leftShadow.insertBefore(this.table);

			this.rightShadow = $('<div class="overflow-shadow-right"></div>');
			this.rightShadow.insertBefore(this.table);

			this.rightShadow.click(function(){
				//console.log(that);
				console.log(that.container.scrollLeft());

				//that.container.scrollLeft+= 50;
				that.container.animate({
					scrollLeft: that.container.scrollLeft() + 100
				}, 100);


			})

			this.leftShadow.click(function(){
				//that.container.scrollLeft-= 50;

				that.container.animate({
					scrollLeft: that.container.scrollLeft() - 100
				}, 100);

			})

			this.renderShadows();

			that.container.on('scroll', function(){that.renderShadows()}).scroll();
		},

		renderShadows: function(){
			if (this.container.scrollLeft() > 0) {
				this.container.addClass('overflow-left')
			} else {
				this.container.removeClass('overflow-left')
			}

			var maxScrollLeft = this.container[0].scrollWidth - this.container[0].clientWidth;
			if (this.container.scrollLeft() < maxScrollLeft) {
				this.container.addClass('overflow-right');
			} else {
				this.container.removeClass('overflow-right');
			}
		},

		syncSizes: function() {
			var tableColumns = this.table.find('thead th.fixed-xs, thead td.fixed-xs');
			this.fixedColumnOverlay.find('thead th.fixed-xs, thead td.fixed-xs').each(function(i){
				$(this).width($(tableColumns[i]).width());
			});

			var tableRows = this.table.find('tr');
			tableRows.css('height', 'auto');
			this.fixedColumnOverlay.find('tr').each(function (i, elem) {
				var height = $(tableRows[i]).height();
				$(this).height(height);
				$(tableRows[i]).height(height);
			});

			this.leftShadow.height(this.table.height());
			var left = this.fixedColumnOverlay.outerWidth() + this.leftShadow.width() - 1;
			this.leftShadow.css('left', left + "px");

			this.rightShadow.height(this.table.height());
			var left = this.container.outerWidth() - 1;
			this.rightShadow.css('left', left + "px");
		}
	});

	$(document).ready(function() {
        var tableIterator = 0;
        $('.contenttable-0').each(
            function(){
                tableIterator++;
                var output = '<div class="table-responsive" id="table-container-' + tableIterator + '"></div>';
                $(this).addClass('table text-nowrap').removeClass('contenttable contenttable-0').parent().append(output);
                var cutted = $(this);
                $(this).remove();
                $('#table-container-'+tableIterator).html(cutted);
            }
        );
		$('.table-responsive').each(function(){
            new TableFixedCollumns(this);
        });
	});
})(jQuery);