/*global jQuery*/
/*
 *
 * rh_Options_radio_img function
 * Changes the radio select option, and changes class on images
 *
 */
function rh_radio_img_select(relid, labelclass) {
    jQuery(this).prev('input[type="radio"]').prop('checked');
    jQuery('.rh-radio-img-' + labelclass).removeClass('rh-radio-img-selected');
    jQuery('label[for="' + relid + '"]').addClass('rh-radio-img-selected');
}
