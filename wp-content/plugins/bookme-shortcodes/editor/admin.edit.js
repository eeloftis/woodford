jQuery(document).ready(function ($) {
    "use strict";

	$('select#select2,select#boxappoint,.select2').select2({
        width : '50%'
    });

	function formatIcon(icon) {
		if (icon.hasOwnProperty('id'))
			return '<span class="elusive"><i class="fa ' + icon.id + '"></i>&nbsp;&nbsp;' + icon.text + '</span>';
		else
			return icon.text;
	}

	function loadSelectIcon( selector ) {

		var $metabox = $( '.cmb2-wrap > .cmb2-metabox' ),
			$selecfa = $metabox.find( selector );

		$selecfa.each(function () {
			$(this).select2({
				width : '200px',
				formatResult: formatIcon,
				formatSelection: formatIcon,
				escapeMarkup: function (m) {
				  return m;
				}
			});
		});
	}

	function limitNumDoctorList() {
		$('#_bookme_doctorlist_num').on('load keyup', function(){
			var $value = $(this).val(),
				$multi = $value % 4,
				$descs = $(this).parent('.cmb-td').find('p');

			if( $.isNumeric($value) && $multi == 0 ){
				$(this).css( 'border', 'inherit' );
				$('input#publish').prop('disabled', false);
				$descs.remove();
			} else {
				$(this).select().css( 'border', '2px solid #d12' );
				$('input#publish').prop('disabled', true);
				if( $descs.length == 0 )
					$(this).parent('.cmb-td').append('<p class="cmb2-metabox-description">Value must be greather than or 4.</p>');
			}
		});
	}

	function limitNumGalleryShow() {
		$('#_bookme_gallery_show').on('load keyup', function(){
			var $value = $(this).val(),
				$multi = $value % 3,
				$descs = $(this).parent('.cmb-td').find('p');

			if( $.isNumeric($value) && $multi == 0 ){
				$(this).css( 'border', 'inherit' );
				$('input#publish').prop('disabled', false);
				$descs.remove();
			} else {
				$(this).select().css( 'border', '2px solid #d12' );
				$('input#publish').prop('disabled', true);
				if( $descs.length == 0 )
					$(this).parent('.cmb-td').append('<p class="cmb2-metabox-description">Value must be greather than or 3.</p>');
			}
		});
	}

    $('<img src="' + themeURI + '/admin/framework/assets/img/1col.png" />').prependTo('label[for=_bookme_postpage_sidebar_pos1]');
    $('<img src="' + themeURI + '/admin/framework/assets/img/2cl.png" />').prependTo('label[for=_bookme_postpage_sidebar_pos2]');
    $('<img src="' + themeURI + '/admin/framework/assets/img/2cr.png" />').prependTo('label[for=_bookme_postpage_sidebar_pos3]');

    $('#meta-sidebar-pos input[type=radio]:checked').each(function () {
		$(this).next('label').find('img').css('border-color', '#363b3f');
    });

    $('#meta-sidebar-pos .cmb2-radio-list label').click(function () {
        $('#meta-sidebar-pos .cmb2-radio-list label img').css('border-color', '#d9d9d9');
        $(this).find('img').css('border-color', '#363b3f');
    });

	loadSelectIcon( $('#callusicon') );
	limitNumDoctorList();
	limitNumGalleryShow();
});
