var button={
    title:"Button Shortcode",
    id :'bookme-form-button',
    pluginName: 'button'

};
(function() {
    _create_tinyMCE_options(button, 800);
})();

function return_html_button(pluginObj){

    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
			<tr>\
				<th><label for="sc-button-style">Style :</label></th>\
				<td><select name="type" id="sc-button-style">\
					<option value="">Default</option>\
					<option value="primary">Simple</option>\
					<option value="success">Success</option>\
					<option value="info">Information</option>\
					<option value="warning">Warning</option>\
					<option value="danger">Danger</option>\
					<option value="link">Link</option>\
				</select><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="sc-button-size">Size :</label></th>\
				<td><select name="type" id="sc-button-size">\
                    <option value="">Default</option>\
					<option value="lg">Large</option>\
					<option value="sm">Small</option>\
					<option value="xs">Extra Small</option>\
				</select><br />\
				</td>\
			</tr>\
			<tr>\
				<th>&nbsp;</th>\
				<td><label for="sc-button-block"><input type="checkbox" id="sc-button-block"> Block Button</label><br /></td>\
			</tr>\
            <tr>\
				<th>&nbsp;</th>\
				<td><label for="sc-button-dropdown"><input type="checkbox" id="sc-button-dropdown"> Dropdown Button</label><br /></td>\
			</tr>\
            <tr>\
				<th>&nbsp;</th>\
				<td><label for="sc-button-disabled"><input type="checkbox" id="sc-button-disabled"> Disabled Button</label><br /></td>\
			</tr>\
            <tr>\
				<th>&nbsp;</th>\
				<td><label for="sc-button-active"><input type="checkbox" id="sc-button-active"> Active State Button</label><br /></td>\
			</tr>\
			<tr>\
				<th><label for="sc-button-title">Title :</label></th>\
				<td><input type="text" name="title" id="sc-button-title" value="Button" /><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="sc-button-link">Link :</label></th>\
				<td><input type="url" name="link" id="sc-button-link" value="#" /><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="sc-button-target">Link Target :</label></th>\
				<td><select name="target" id="sc-button-target">\
                    <option value="">Default</option>\
					<option value="_blank"><code>_blank</code>, new window or tab</option>\
					<option value="_self"><code>_self</code>, same frame as it was clicked</option>\
					<option value="_parent"><code>_parent</code>, parent frameset</option>\
                    <option value="_top"><code>_top</code>, full body of the window</option>\
				</select><br />\
				</td>\
			</tr>\
            <tr>\
				<th><label for="sc-button-class">Extra Class :</label></th>\
				<td><input type="text" name="xclass" id="sc-button-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-button-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
    return form;
}
function create_button(pluginObj){
    var form= jQuery(pluginObj.hashId)
    var table = form.find('table');
    jQuery('.glyphicon').css('display','inline');

    table.find('select').select2({ width : '50%' });

    // handles the click event of the submit button
    form.find('#sc-button-submit').click(function(){
        // defines the options and their default values
        var options = {
                'title'       : 'Button',
                'link'        : '',
                'type'        : 'default'
            };
        var cusclass='',icon='';
        if(table.find('#sc-button-style').val()!=''){
            cusclass += ' type="'+table.find('#sc-button-style').val()+'"';
        }
        if(table.find('#sc-button-size').val()!=''){
            cusclass += ' size="'+table.find('#sc-button-size').val()+'"';
        }
        if(table.find('#sc-button-block').prop('checked')){
            cusclass += ' block="true"';
        }
        if(table.find('#sc-button-dropdown').prop('checked')){
            cusclass += ' dropdown="true"';
        }
        if(table.find('#sc-button-disabled').prop('checked')){
            cusclass += ' disabled="true"';
        }
        if(table.find('#sc-button-active').prop('checked')){
            cusclass += ' active="true"';
        }
        if(table.find('#sc-button-target').val()!=''){
            cusclass += ' target="'+table.find('#sc-button-target').val()+'"';
        }
        if(table.find('#sc-button-class').val()!=''){
            cusclass += ' xclass="'+table.find('#sc-button-class').val()+'"';
        }
        if(table.find('#sc-button-title').val()!=''){
            cusclass += ' title="'+table.find('#sc-button-title').val()+'"';
        }

        var selected_content = tinyMCE.activeEditor.selection.getContent();
        if(!selected_content)
            var selected_content = 'Button';

        var shortcode = '[button'+cusclass;
        shortcode += ' link="'+table.find('#sc-button-link').val()+'"]';
        shortcode += selected_content+'[/button]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes fancybox
        close_dialogue(pluginObj.hashId);
    });
}

