var list={
    title:"List Group Shortcode",
    id :'bookme-form-list',
    pluginName: 'list'
};
(function() {
    _create_tinyMCE_options(list);
})();

function return_html_list(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container"><table id="sc-table" class="form-table">\
			<tr>\
				<th><label for="sc-type">Lists style</label></th>\
				<td><select name="type" id="sc-type">\
                    <option value="default">Default</option>\
					<option value="check">Check</option>\
                    <option value="number">Numbered</option>\
				</select><br />\
				</td>\
			</tr>\
            <tr>\
                <td colspan="2">\
                <table class="multiple_column">\
                    <tbody id="sc-append-listitem">\
                    <tr class="dropdown_list_item"><th class="enhanced">&nbsp;</th><td><input type="text" name="line" id="sc-list-item[]" value="" placeholder="list content here..."/></td></tr>\
                    </tbody>\
                    <tfoot>\
                        <tr><td colspan="5"><a id="add_new_item" href="javascript:;" style="text-decoration:none;"><span class="dashicons dashicons-plus"></span> Add New List</a></td></tr>\
                    </tfoot>\
                </table>\
                </td>\
            </tr>\
            <tr>\
				<th><label for="sc-list-class">List Class:</label></th>\
				<td><input type="text" name="line" id="sc-list-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-submit" class="button-primary" value="Insert List" name="submit" />\
		</p>\
		</div>');
    return form;
}
function create_list(pluginObj){

    var form=jQuery(pluginObj.hashId);
    var table = form.find('table');

    jQuery('#sc-type').select2({ width : '50%' });

    form.find('#add_new_item').click(function(){
        var item = '<tr class="dropdown_list_item"><th class="enhanced"><a class="remove_item" href="javascript:;" style="text-decoration:none;"><span class="dashicons dashicons-no"></span> Remove List</a></th><td><input type="text" name="line" id="sc-list-item[]" value="" placeholder="list content here..."/></td></tr>';
        form.find('#sc-append-listitem').append(item);
    });

    jQuery('.remove_item').live('click',function(){
        jQuery(this).parent().parent().remove();
    });

    // handles the click event of the submit button
    form.find('#sc-submit').click(function(){
        // defines the options and their default values
        // again, this is not the most elegant way to do this
        // but well, this gets the job done nonetheless
        var options = {
            'type'       : 'default'
        },
            cusclass,
            list_type;

        if(table.find('#sc-type').val()!=''){
            list_type=' type="'+table.find('#sc-type').val()+'"';
        }
        else{
            list_type='';
        }
        var cusclass='';
        if(table.find('#sc-list-class').val()!=''){
            cusclass= ' xclass="'+table.find('#sc-list-class').val()+'"';
        }
        var shortcode = '[list'+list_type+cusclass+']<br/>';
        var list_item = jQuery('#sc-list-item');

        form.find('tr.dropdown_list_item').each(function(index){
            var list = jQuery(this).find('input[name="line"]').val();
            shortcode +='[li]'+list+'[/li]<br/>';
        });
        shortcode +='[/list]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        close_dialogue(pluginObj.hashId);
    });
}

