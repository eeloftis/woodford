jQuery(document).ready(function($){
    "use strict";

	/**
	 * Show/Hide Select Department at Featured Doctor Widget
	 */
	function onSelectWidget() {
		$('p#departmentlist').hide();

		$('p#loadselect').each( function() {

			var $pselect = $(this);
			var $dselect = $(this).find('select');

			$dselect.change( function(){

				if ( $(this).val() == 'department' ) {
					$pselect.next('p#departmentlist').show();
				} else {
					$pselect.next('p#departmentlist').hide();
				}
			});

			$dselect.trigger('change');
		});
	}

	/**
	 * Show/Hide Select Department at Featured Doctor Widget
	 */
	function onSelectTax() {

		$('p#taxbox').each( function(){

			var $taxselect = $(this).find('select');
			var $pterm = $(this).next('p#termbox');
			var $terminput = $pterm.find('select');
			var $opt = $terminput.find('option:not(:first)').detach();
			var $spn = $pterm.find('span');

			$taxselect.change( function(){

				$terminput.find('option:gt(0)').remove();

				var $val = $(this).val();
				var $opt = $spn.find('option.'+$val);

				$opt.each(function( index ) {
					$opt.appendTo($terminput);
					console.log( index + ": " + $( this ).text() );
				});
			});

			$taxselect.trigger('change');
		});
	}

	$(document).ajaxStop( function() {
		onSelectWidget();
		onSelectTax();
	});

	onSelectWidget();
	onSelectTax();
});
