var slides={
    title:"Slider Shortcode",
    id :'bookme-form-slider',
    pluginName: 'slides',
    setRowColors:false
};

(function() {
    _create_tinyMCE_options(slides,900);
})();

function __slider_show_image_upload_icon(parent,ele){
    parent.find(ele).on('click',function(){
        jQuery('body').addClass('bookme_plugin_shown_now');
        jQuery('.ui-widget-overlay, .ui-dialog').css('z-index',100);
        jQuery('html').addClass('Image');
        formfield = jQuery(this).prev();
        imgparent = jQuery(this).parent('td');
        previewimg = imgparent.find('.image_preview');
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
            jQuery(formfield).val(fileurl);
            tb_remove();
            previewimg.prev().hide();
            previewimg.html('<a href="" title="Remove Image"><span class="dashicons dashicons-no"></span></a><img src="'+fileurl+'" alt="Remove Image?">');
            jQuery('html').removeClass('Image');
            jQuery('body').removeClass('bookme_plugin_shown_now');

        } else {
            jQuery('body').removeClass('bookme_plugin_shown_now');
            window.original_send_to_editor(html);
        }
    };
}
function return_html_slides(pluginObj){

    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
    <tr>\
				<th><label for="sc-slider-interval">Slider Interval</label></th>\
				<td><input type="text" name="line" id="sc-slider-interval" value="" /> ms<br />\
				</td>\
			</tr>\
        <tr>\
				<th>Slider Options</th>\
				<td>\
				    <label for="sc-slider-bullets"><input type="checkbox" id="sc-slider-bullets" value="true"/> Show Navigation Bullets</label><br />\
				    <label for="sc-slider-pause"><input type="checkbox" id="sc-slider-pause" value="true"/> Pause On Hover</label><br />\
				    <label for="sc-slider-wrap"><input type="checkbox" id="sc-slider-wrap" value="true"/> Slide Continuously</label><br />\
				</td>\
			</tr>\
			 <tr>\
				<th><label for="sc-slider-captioncolor">Caption Color</label></th>\
				<td><input type="text" name="line" id="sc-slider-captioncolor" class="color" value=""/>\
				</td>\
			</tr>\
				<tr>\
				<th><label for="sc-slider-navcolor">Navigation Color</label></th>\
				<td><input type="text" name="line" id="sc-slider-navcolor" class="color" value=""/>\
				</td>\
			</tr>\
				<tr>\
				<td colspan="2">\
				<table class="multiple_column">\
                    <thead>\
                        <tr><th class="enhanced">Image</th><th class="enhanced">Title</th><th class="enhanced">Image Caption</th><th style="width:10%">Active</th><th style="width:50px">&nbsp;</th></tr>\
                    </thead>\
                    <tbody id="sc-append-slideritem">\
                    <tr class="dropdown_list_item">\
                        <td class="enhanced"><input class="sc-itemslider-image" type="hidden" name="sc-itemslider-image[]"  value="" />\
                            <input id="_btn" class="upload_image_button" type="button" value="Upload Image" /><div class="image_preview"></div></td>\
                        <td class="enhanced"><input type="text" name="sc-itemslider-title[]" class="sc-itemslider-title" value="Title"/></td>\
                        <td class="enhanced"><textarea name="sc-itemslider-caption[]" class="sc-itemslider-caption"></textarea></td>\
                       <td><input type="radio" name="sc-itemslider-active" class="sc-itemslider-active" value="active" checked="checked"/></td>\
                      <td></td>\
                    </tr>\
                    </tbody>\
                    <tfoot>\
                        <tr><td colspan="5"><a id="add_new_dditem" href="javascript:;" style="text-decoration:none;"><span class="dashicons dashicons-plus"></span> Add New Slide</a></td></tr>\
                    </tfoot>\
                </table>\
                </td>\
			</tr>\
            <tr>\
                <th><label for="sc-slider-xclass">Extra Class Slider</label></th>\
                <td><input type="text" id="sc-slider-xclass" value="" placeholder="separate class by comma"/><br />\
                </td>\
            </tr>\
		</table>\
		<p class="submit" style="padding-right: 10px;text-align: right;">\
			<input type="button" id="sc-slider-submit" class="button-primary" value="Insert Slider" name="submit" />\
		</p>\
		</div>');
    return form;
}
function create_slides(pluginObj){
   var form=jQuery(pluginObj.hashId);

    var table = form.find('#sc-table');

    form.find('#add_new_dditem').click(function(){
        var item='<tr class="dropdown_list_item"><td class="enhanced"><input class="sc-itemslider-image" type="hidden" name="sc-itemslider-image[]"  value="" /><input id="_btn" class="upload_image_button" type="button" value="Upload Image" /><div class="image_preview"></div></td><td class="enhanced"><input type="text" name="sc-itemslider-title[]" class="sc-itemslider-title" value="Title"/></td><td class="enhanced"><textarea name="sc-itemslider-caption[]" class="sc-itemslider-caption"></textarea></td><td><input type="radio" name="sc-itemslider-active" class="sc-itemslider-active" value=""/></td><td><a class="remove_dditem" href="javascript:;" style="text-decoration:none;"><span class="dashicons dashicons-no"></span></a></td></tr>';
        form.find('#sc-append-slideritem').append(item);
        __slider_show_image_upload_icon(form,jQuery('#sc-append-slideritem').find('tr:last').find('.upload_image_button'));

    });
    jQuery('.remove_dditem').live('click',function(){
        jQuery(this).parent().parent().remove();
    });

	jQuery('.image_preview:has(img)').find('a').live('click',function(e){
		e.preventDefault();
		jQuery(this).parent().empty().prev('.upload_image_button').show().prev('input[type=hidden]').val();
    });

    form.find('.color').wpColorPicker();

    jQuery('.upload_image_button').each(function(){
        __slider_show_image_upload_icon(form,jQuery(this));
    })

    form.find('#sc-slider-submit').click(function(){

        var shortattr='';
        var valueattr=['xclass','interval','captioncolor','navcolor']
        var checkattr=['bullets','pause','wrap']

        jQuery(valueattr).each(function(ind,val){
            if(table.find('#sc-slider-'+val).val()!=''){
                shortattr+= ' '+val+'="'+table.find('#sc-slider-'+val).val()+'"';
            }
        });
        jQuery(checkattr).each(function(ind,val){
            if(table.find('#sc-slider-'+val).prop('checked')){
                shortattr+= ' '+val+'=true';
            }
        })

        var shortcode = '[slides'+shortattr;
        shortcode += ']';
        var row_attr={
            title:'',
            image:'',
            caption:''
        }

        form.find('tr.dropdown_list_item').each(function(index){
            var $this=jQuery(this);
            var attr='';

            jQuery.each(row_attr,function(ind,val){
                if($this.find('.sc-itemslider-'+ind).val()!=''){
                    attr+=' '+ind+'="'+$this.find('.sc-itemslider-'+ind).val()+'"';
                }
            });
            if(jQuery(this).find('.sc-itemslider-active').is(":checked")==true){
                attr+=' active="true"';
            }

            shortcode+='<br/>[slide'+attr+'/]';


        });

        shortcode += '<br/>[/slides]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes dialog box
        close_dialogue(pluginObj.hashId);

    });
}
