jQuery(document).ready(function($){
    "use strict";
    $("#_bookme_gallery_meta_0,#_bookme_gallery_meta_image,#_bookme_gallery_meta_video").hide();
    var checked = $("input[name=post_format]:checked").val();
    $("#_bookme_gallery_meta_"+checked).show();

    $("input[name=post_format]").on("change", function() {
         var format = $(this).val();
         $("#_bookme_gallery_meta_0,#_bookme_gallery_meta_image,#_bookme_gallery_meta_video").hide();
         $("#_bookme_gallery_meta_"+format).show();
    });
});
