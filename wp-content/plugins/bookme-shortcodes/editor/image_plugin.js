var image={
    title:"Responsive Image Shortcode",
    id :'bookme-form-image',
    pluginName: 'image'
};
(function() {
    _create_tinyMCE_options(image);
})();

function return_html_image(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container"><table id="sc-table" class="form-table">\
				<tr><th><label for="_btn">Upload Image :</label></th>\
				<td id="osc_thumbnail_upload">\
                    <input id="sc-image-src" type="hidden" name="sc-thumbnail-src"  value="" />\
                    <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />\
				</td>\
			</tr>\
            <tr style="display:none">\
				<th><label for="sc-image-shape">Image Shape:</label></th>\
				<td><select name="sc-image-shape" id="sc-image-shape">\
                                <option value="img-rounded">Rounded</option>\
                                <option value="img-circle">Circle</option>\
                                <option value="img-thumbnail">Thumbnail</option>\
                                </select>\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-image-class">Extra Class:</label></th>\
				<td><input type="text" name="line" id="sc-image-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-image-submit" class="button-primary" value="Insert Image" name="submit" />\
		</p>\
		</div>');
    return form;
}
function create_image(pluginObj){

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
            form.find('#osc_thumbnail_upload img').remove();
            form.find('#osc_thumbnail_upload').append('<a href="" title="Remove Image"><span class="dashicons dashicons-no"></span></a><img src="'+fileurl+'">')
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
    form.find('#sc-image-submit').click(function(){
        var shortcode='';
        var shape=form.find('#sc-image-shape').val();
        var cusclass='';
        if(table.find('#sc-image-class').val()!=''){
            cusclass= ' xclass="'+table.find('#sc-image-class').val()+'"';
        }
        if(form.find('#sc-image-src').val()!=''){
            shortcode = '[image'+cusclass+' src="'+form.find('#sc-image-src').val()+'"/]';
        }
        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes Dialoguebox
        close_dialogue(pluginObj.hashId);
    });
}

