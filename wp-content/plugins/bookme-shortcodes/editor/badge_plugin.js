var badge={
    title:"Badge Shortcode",
    id :'bookme-form-badge',
    pluginName: 'badge'
};
(function() {
    _create_tinyMCE_options(badge);
})();

function return_html_badge(pluginObj){
    var form = jQuery('<div id="'+pluginObj.id+'" class="sc-container" title="'+pluginObj.title+'"><table id="sc-table" class="form-table">\
        <tr>\
            <th><label for="sc-badge-value">Content</label></th>\
            <td><input type="text" name="value" id="sc-badge-value" value=""></td>\
        </tr>\
        <tr>\
            <th><label for="sc-badge-float_right">Float Right</label></th>\
            <td><input type="checkbox" name="float_right" id="sc-badge-float_right" value="true"></td>\
        </tr>\
        <tr>\
            <th><label for="sc-badge-class">Custom Class</label></th>\
            <td><input type="text" name="xclass" id="sc-badge-class" value=""/></td>\
        </tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sc-badge-submit" class="button-primary" value="Insert Badge" name="submit" />\
		</p>\
		</div>');
    return form;

}

function create_badge(pluginObj){

    var form = jQuery(pluginObj.hashId);

    var table = form.find('table');

    // handles the click event of the submit button
    form.find('#sc-badge-submit').click(function(){
        var cusclass='';
        if(table.find('#sc-badge-class').val()!=''){
            cusclass+= ' xclass="'+table.find('#sc-badge-class').val()+'"';
        }
        if(table.find('#sc-badge-float_right').prop('checked')){
            cusclass+= ' right="true"';
        }
        if(table.find('#sc-badge-value').val()!=''){
            content = table.find('#sc-badge-value').val();
        }
        var shortcode = '[badge'+cusclass+']'+content+'[/badge]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes fancybox
        close_dialogue(pluginObj.hashId);
    });
}

