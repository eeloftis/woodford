(function() {
    var objNew=jQuery.parseJSON(dropdown_obj);
    var basic=[],interactive=[],content=[],miscellaneous=[],columns=[];
    jQuery.each(objNew,function(ind,val){
        if(typeof val=='object'){
            if(typeof(val['icon'])==='undefined' || val['icon']=='') val['icon'] = 'fa-code';
            if(typeof(val['width'])==='undefined' || val['width']=='') val['width'] = 'auto';
            if(typeof(val['height'])==='undefined' || val['height']=='') val['height'] = '100';
            var n={text:val['name'],icon:'none '+val['icon'], onclick : function() {
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if(!selected_content)
                    var selected_content = 'Your Content';
                //Design Elements
                if(ind =="button-toolbar"){
                    tinyMCE.activeEditor.selection.setContent('[button-toolbar]<br />'+selected_content+'<br />[/button-toolbar]');
                }
                else if(ind =="row"){
                    tinyMCE.activeEditor.selection.setContent('[row]<br />'+selected_content+'<br />[/row]');
                }
                else if(ind == "toggles"){
                    tinyMCE.activeEditor.selection.setContent('[toggles]<br/>[toggle title="Toggle number 1" active=true]Toggle 1 content goes here.[/toggle]<br/>[toggle title="Toggle number 2"]Toggle 2 content goes here.[/toggle]<br/>[toggle title="Toggle number 3"]Toggle 3 content goes here.[/toggle]<br/>[/toggles]');
                }
                else if(ind == "tabs"){
                    tinyMCE.activeEditor.selection.setContent('[tabs]<br/>[tab title="Tab number 1" active=true]Tab 1 content goes here.[/tab]<br/>[tab title="Tab number 2"]Tab 2 content goes here.[/tab]<br/>[tab title="Tab number 3"]Tab 3 content goes here.[/tab]<br/>[/tabs]');
                }
                else{
                    eval('_create_tinyMCE_dropdown('+ind+',"'+val['width']+'","'+val['height']+'")');
                }
            }
            }
            var grp=val['group'];
            eval(grp).push(n);
        }
    });

    var objGrp = jQuery.parseJSON(dropdown_grp),
        grps_obj=[];

    jQuery.each( objGrp, function(ind, val) {
        if(typeof val=='object'){
            var n=  {text:val['name'], icon:'none '+val['icon'],menu:eval(ind)}
        }
        grps_obj.push(n);
    });
    tinymce.create('tinymce.plugins.bookme_sc_button', {

        init : function(ed, url) {

            ed.addButton( 'bookme_sc_button', {
                type: 'splitbutton',
                title: "bookme Shortcode",
                icon:'wp_code dropdown_icon',
                image: img_url+'shortcode.png',
                class: "osc_ebsp_dropdown",
                onclick: function(e) {
                },
                menu:grps_obj

            });
        },

        getInfo : function() {
            return {
                    longname : 'shortcode',
                    author : 'bookme Themes',
                    authorurl : 'http://minimalthemes.net/',
                    infourl : 'http://minimalthemes.net/',
                    version : "1.0.0"
            };
        }
    });

    tinymce.PluginManager.add( 'bookme_sc_button', tinymce.plugins.bookme_sc_button );
})();

jQuery(window).load(function(){
    jQuery('.mce-ico.mce-i-wp_code.dropdown_icon').parents('div').addClass('dropdown_class');

});
