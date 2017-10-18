(function($) {

	alert('hello from application.js');

	//disabled behavior fix

	var disabledHandler = function (event) {
		event.preventDefault();
		return false;
	};

	var disabledButtons = $('[disabled]');
	disabledButtons.click(disabledHandler);
	disabledButtons.dblclick(disabledHandler);

	//tooltips and popovers

	var tooltips = $('[data-toggle=tooltip],[data-tooltip]');
	var popovers = $('[data-toggle=popover]');

	if (tooltips.length > 0) {
		$.each(tooltips, function(i, el) {
			var element = $(el);
			if (element.is('[data-tooltip]')) {
				var tooltipTxt = element.attr('data-tooltip');
				element.attr({
					'data-tooltip': null,
					'data-toggle': 'tooltip',
					'data-original-title': element.attr('data-tooltip')
				});
				element.tooltip({ title: tooltipTxt	});
			} else {
				element.tooltip();
			}
		});
	}

	if (popovers.length > 0) {
		popovers.popover();
	}

	//common dom manipulations

	$(document).ready(function() {



	});

} (jQuery));