var title={
    title:"Title Shortcode",
    id :'bookme-form-title',
    pluginName: 'title'
};
(function() {
    _create_tinyMCE_options(title);
})();

function return_html_title(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
			<tr>\
				<th><label for="sc-title-size">Title Size:</label></th>\
				<td><select name="type" id="sc-title-size">\
					<option value="1">Heading 1</option>\
					<option value="2">Heading 2</option>\
					<option value="3">Heading 3</option>\
					<option value="4">Heading 4</option>\
					<option value="5">Heading 5</option>\
					<option value="6">Heading 6</option>\
				</select><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="sc-title-content">Title Content:</label></th>\
				<td><input type="text" name="content" id="sc-title-content" value="" placeholder="your heading content here..."/><br />\
				</td>\
			</tr>\
                        <tr>\
				<th><label for="sc-title-class">Extra Class:</label></th>\
				<td><input type="text" name="line" id="sc-title-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-title-submit" class="button-primary" value="Insert Title" name="submit" />\
		</p>\
		</div>');
    return form;

}
function create_title(pluginObj){
    var form=jQuery(pluginObj.hashId);

    var table = form.find('table');

    jQuery('#sc-title-size').select2({ width : '50%' });

    // handles the click event of the submit button
    form.find('#sc-title-submit').click(function(){
        var cusclass='';
        if(table.find('#sc-title-class').val()!=''){
            cusclass= ' class="'+table.find('#sc-title-class').val()+'"';
        }
        var shortcode = '[title size="'+jQuery('#sc-title-size').val()+'"'+cusclass+']';
        shortcode += jQuery('#sc-title-content').val();
        shortcode += '[/title]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes fancybox
        close_dialogue(pluginObj.hashId);
    });
}

