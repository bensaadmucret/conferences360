jQuery(function () {
    jQuery('#ef_header_type').change(function () {
        jQuery('[id*=ef_subtitle_color]').closest('.el-option').nextAll('.el-option').hide();
        switch (jQuery(this).val()) {
            case 'slider':
                vertoh_options_find_option('ef_header_gallery').show();
                break;
            case 'video':
                vertoh_options_find_option('ef_header_video').show();
                vertoh_options_find_option('ef_header_video_background_image').show();
                break;
            case 'small':
                break;
                vertoh_options_find_option('ef_header_gallery').show();
            case 'solid':
                vertoh_options_find_option('ef_header_background_color').show();
                vertoh_options_find_option('ef_header_logo').show();
                break;
        }
    });
    
    jQuery('#ef_header_type').change();
});

function vertoh_options_find_option(id){
    return jQuery('[id*=' + id + ']').closest('.el-option');
}