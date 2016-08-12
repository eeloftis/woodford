var thumbnail={
    title:"Thumbnail Image Shortcode",
    id :'bookme-form-thumbnail',
    pluginName: 'thumbnail'
};
(function() {
    _create_tinyMCE_options(thumbnail);
})();

function return_html_thumbnail(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
				<th><label for="sc-label-content">Upload Image:</label></th>\
				<td id="osc_thumbnail_upload">\
                    <input id="sc-thumbnail-src" type="hidden" name="sc-thumbnail-src"  value="" />\
                    <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-thumbnail-link">Alternate Text :</label></th>\
				<td><input type="text" name="oscitas-alt-txt" id="sc-alt-txt" value=""/><br />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-thumbnail-link">Link:</label></th>\
				<td><input type="text" name="sc-thumbnail-link" id="sc-thumbnail-link" value=""/><br />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-thumbnail-link">Target:</label></th>\
				<td><select name="sc-thumbnail-link-target" id="sc-thumbnail-link-target"><option value="_self">Self</option><option value="_blank">New Window</option></select><br />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-thumbnail-class">Custom Class:</label></th>\
				<td><input type="text" name="line" id="sc-thumbnail-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-thumbnail-submit" class="button-primary" value="Insert Thumbnail" name="submit" />\
		</p>\
		</div>');

    return form;
}

function create_thumbnail(pluginObj){
    var form=jQuery(pluginObj.hashId);
    var table = form.find('table');

    form.find('.upload_image_button').click(function() {
        jQuery('body').addClass('bookme_plugin_shown_now');
        jQuery('.ui-widget-overlay, .ui-dialog').css('z-index',100);
        jQuery('html').addClass('Image');
        formfield = jQuery(this).prev().attr('id');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.original_send_to_editor = window.send_to_editor;

    window.send_to_editor = function(html) {
        if (formfield) {
            if (jQuery(html).find('img').length) {
                fileurl = jQuery('img', html).attr('src');
            } else if (jQuery(html).attr('src')) {
                fileurl = jQuery(html).attr('src');
            }
            jQuery('#' + formfield).val(fileurl);
            tb_remove();
            form.find('.upload_image_button').hide();
            form.find('#osc_thumbnail_upload img').remove();
            form.find('#osc_thumbnail_upload').append('<a href="" title="Remove Image"><span class="dashicons dashicons-no"></span></a><img src="'+fileurl+'">');
            jQuery('body').removeClass('bookme_plugin_shown_now');
            jQuery('html').removeClass('Image');

        } else {
            window.original_send_to_editor(html);
            jQuery('body').removeClass('bookme_plugin_shown_now');
        }
    };

    jQuery('#osc_thumbnail_upload:has(img)').find('a').live('click',function(e){
		e.preventDefault();
        var ieu=jQuery(this).parent();
        ieu.find('input[type=hidden]').attr('value','');
        ieu.find('.upload_image_button').show();
        ieu.find('img').remove();
        jQuery(this).remove();
    });

    // handles the click event of the submit button
    form.find('#sc-thumbnail-submit').click(function(){
        var shortcode='';
        var cusclass='',link='', border='',tget='', alt='';
        if(table.find('#sc-thumbnail-class').val()!=''){
            cusclass= ' xclass="'+table.find('#sc-thumbnail-class').val()+'"';
        }
        if(table.find('#sc-thumbnail-link').val()!=''){
            link= ' link="'+form.find('#sc-thumbnail-link').val()+'"';
        }

        if(table.find('#sc-alt-txt').val()!=''){
            alt= ' alt="'+form.find('#sc-alt-txt').val()+'"';
        }

        if(table.find('#sc-thumbnail-link-target').val()!=''){
            tget= ' target="'+form.find('#sc-thumbnail-link-target').val()+'"';
        }

        if(form.find('#sc-thumbnail-src').val()!=''){
            shortcode = '[thumbnail'+link+cusclass+tget+alt+' src="'+form.find('#sc-thumbnail-src').val()+'"/]';
        }
        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes Dialoguebox
        close_dialogue(pluginObj.hashId);
    });
}

