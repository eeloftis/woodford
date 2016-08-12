var gBtnVar={};

/*
Open magnific popup
 */
function open_dialogue(pluginObj,width,height){
//    close_dialogue(pluginObj);
    var $style = 'style="';

    if(typeof(width)==='undefined' || width=='auto') {
       $style += 'width:460px;';
       var width = '460';
    } else {
       $style += 'width:'+width+'px;';
    }
    if(typeof(height)==='undefined' || parseInt(height)<=100) {
       $style += 'height:360px;';
       var height = '360';
    } else {
       $style += 'height:'+height+'px;';
    }

    $style += '"';

    var html_content=eval('return_html_'+pluginObj.pluginName+'(pluginObj)');
    html_content=jQuery(html_content).get(0).outerHTML;
    var $template_markup='<div id="bookme-dialog" '+$style+' class="sc-dialog mfp-ebsp"><h2>'+pluginObj.title+'</h2>'  +html_content+
        '</div>';

    jQuery('body').addClass('ebsp-mf-shown');
    jQuery.magnificPopup.open({
        items: { src:$template_markup },
        type: "inline",
        mainClass:'inner-popup',
        closeOnBgClick: false,
        callbacks: {
            open: function () {
                eval('create_'+pluginObj.pluginName+'(pluginObj);');
            },
            close: function () {
                jQuery('body').removeClass('ebsp-mf-shown');
                jQuery('body').removeClass('ebs_plugin_shown_now');
            }
        }

    });

}

/*
Close magnific popup
 */
function close_dialogue(dialogueid){
    jQuery.magnificPopup.close();
    jQuery('body').removeClass('ebsp-mf-shown');
    jQuery('body').removeClass('ebs_plugin_shown_now');

}

var plugininfo={
    longname : 'shortcode',
    author : 'bookme Themes',
    authorurl : 'http://minimalthemes.net/',
    infourl : 'http://minimalthemes.net/',
    version : "1.0.0"
}

/*
Create tinymce icon
 */

function _create_tinyMCE_options(pluginObj, width) {
    if(typeof(width)==='undefined') width = 'auto';
    var pluginName = 'bookme'+pluginObj.pluginName.substr(0, 1).toUpperCase() + pluginObj.pluginName.substr(1);
    pluginObj.hashId = '#'+pluginObj.id;
    var options = {
        init : function(ed, url) {
            ed.addButton('bookme'+pluginObj.pluginName, {
                title : pluginObj.title,
                icon : pluginObj.icon,
                onclick : function() {
                    eval('open_dialogue(pluginObj,"'+width+'")');
                    if (pluginObj.setRowColors) {
                        jQuery(pluginObj.hashId+' table tr:visible:even').css('background', '#ffffff');
                        jQuery(pluginObj.hashId+' table tr:visible:odd').css('background', '#efefef');
                    }
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            plugininfo.longname = pluginObj.title;
            return plugininfo;
        }
    };
    tinymce.create('tinymce.plugins.'+pluginName, options);
    options = eval('tinymce.plugins.'+pluginName);
    //return options;
    tinymce.PluginManager.add('bookme'+pluginObj.pluginName, tinymce.plugins[pluginName]);
}
/*
Create tinymce dropdown
 */

function _create_tinyMCE_dropdown(pluginObj,width,height) {
    if(typeof(width)==='undefined') width = 'auto';
    if(typeof(height)==='undefined') height = 'auto';
    pluginObj.hashId = '#'+pluginObj.id;
    eval('open_dialogue(pluginObj,"'+width+'","'+height+'")');
    if (pluginObj.setRowColors) {
        jQuery(pluginObj.hashId+' table tr:visible:even').css('background', '#ffffff');
        jQuery(pluginObj.hashId+' table tr:visible:odd').css('background', '#efefef');
    }
}

var faicons=jQuery('<li type="fa" data-value="fa-meanpath"  class="fa fa-meanpath"> </li>');
var ebsicons='';
var ebsfaicons='';

jQuery(faicons).each(function(ind,val){
    ebsfaicons+=val.outerHTML;
});

function font_awesome_include($class){
    var icons='';
        icons+='<h4>Font Awesome</h4><ul name="oscitas-heading-icon_data" class="'+$class+'">'+ebsfaicons+'</ul>';
    return icons;
}
