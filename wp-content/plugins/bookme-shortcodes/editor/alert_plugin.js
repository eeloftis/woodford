var alert = {
    title:"Notifications Shortcode",
    icon:'fa-bell',
    id :'bookme-form-alert',
    pluginName: 'alert'
};
(function() {
    _create_tinyMCE_options(alert);
})();

function return_html_alert(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
			<tr>\
				<th><label for="sc-type">Notification Style :</label></th>\
				<td><select name="type" id="sc-type">\
						<option value="std">Standard</option>\
						<option value="success">Success</option>\
						<option value="info">Information</option>\
						<option value="warning">Warning</option>\
						<option value="danger">Danger/Error</option>\
				</select><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="sc-close">Dismissable :</label></th>\
				<td><input type="checkbox" id="sc-close"/><br />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-xclass">Extra Class :</label></th>\
				<td><input type="text" name="line" id="sc-xclass" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-submit" class="button-primary" value="Insert" name="submit" />\
		</p>\
		</div>');
    return form;
}
function create_alert(pluginObj){
    var form=jQuery(pluginObj.hashId);
    var table = form.find('table');


    // handles the click event of the submit button
    form.find('#sc-submit').click(function(){
        // defines the options and their default values
        var options = {
            'type'       : 'success'
        };
        var cusclass='';
        if(table.find('#sc-xclass').val()!=''){
            cusclass= ' xclass="'+table.find('#sc-xclass').val()+'"';
        }
        var shortcode = '[alert';

        for( var index in options) {
            var value = table.find('#sc-' + index).val();

            // attaches the attribute to the shortcode only if it's different from the default value
            //if ( value !== options[index] )
            shortcode += ' ' + index + '="' + value + '"';
        }

        var selected_content = tinyMCE.activeEditor.selection.getContent();
        if(!selected_content)
            var selected_content = 'Your notification';
        shortcode += (table.find('#sc-close').prop('checked')? ' dismissable="true"': '');

        shortcode += cusclass+']'+selected_content+'[/alert]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        close_dialogue(pluginObj.hashId);
    });
}

