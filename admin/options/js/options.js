/*global $, jQuery, document, tabid:true, rh_opts, confirm, relid:true*/

jQuery(document).ready(function () {

    if (jQuery('#last_tab').val() === '') {
        jQuery('.rh-opts-group-tab:first').slideDown('fast');
        jQuery('#rh-opts-group-menu li:first').addClass('active');
    } else {
        tabid = jQuery('#last_tab').val();
        jQuery('#' + tabid + '_section_group').slideDown('fast');
        jQuery('#' + tabid + '_section_group_li').addClass('active');
    }

    jQuery('input[name="' + rh_opts.opt_name + '[defaults]"]').click(function () {
        if (!confirm(rh_opts.reset_confirm)) {
            return false;
        }
    });

    jQuery('.rh-opts-group-tab-link-a').click(function () {
        relid = jQuery(this).attr('data-rel');

        jQuery('#last_tab').val(relid);

        jQuery('.rh-opts-group-tab').each(function () {
            if (jQuery(this).attr('id') === relid + '_section_group') {
                jQuery(this).delay(400).fadeIn(1200);
            } else {
                jQuery(this).fadeOut('fast');
            }
        });

        jQuery('.rh-opts-group-tab-link-li').each(function () {
            if (jQuery(this).attr('id') !== relid + '_section_group_li' && jQuery(this).hasClass('active')) {
                jQuery(this).removeClass('active');
            }
            if (jQuery(this).attr('id') === relid + '_section_group_li') {
                jQuery(this).addClass('active');
            }
        });
    });

    if (jQuery('#rh-opts-save').is(':visible')) {
        jQuery('#rh-opts-save').delay(4000).slideUp('slow');
    }

    if (jQuery('#rh-opts-imported').is(':visible')) {
        jQuery('#rh-opts-imported').delay(4000).slideUp('slow');
    }

    jQuery('#rh-opts-form-wrapper').on('change', ':input', function () {
        if(this.id === 'google_webfonts' && this.value === '') return;
        jQuery('#rh-opts-save-warn').slideDown('slow');
    });

    jQuery('#rh-opts-import-code-button').click(function () {
        if (jQuery('#rh-opts-import-link-wrapper').is(':visible')) {
            jQuery('#rh-opts-import-link-wrapper').fadeOut('fast');
            jQuery('#import-link-value').val('');
        }
        jQuery('#rh-opts-import-code-wrapper').fadeIn('slow');
    });

    jQuery('#rh-opts-import-link-button').click(function () {
        if (jQuery('#rh-opts-import-code-wrapper').is(':visible')) {
            jQuery('#rh-opts-import-code-wrapper').fadeOut('fast');
            jQuery('#import-code-value').val('');
        }
        jQuery('#rh-opts-import-link-wrapper').fadeIn('slow');
    });

    jQuery('#rh-opts-export-code-copy').click(function () {
        if (jQuery('#rh-opts-export-link-value').is(':visible')) {jQuery('#rh-opts-export-link-value').fadeOut('slow'); }
        jQuery('#rh-opts-export-code').toggle('fade');
    });

    jQuery('#rh-opts-export-link').click(function () {
        if (jQuery('#rh-opts-export-code').is(':visible')) {jQuery('#rh-opts-export-code').fadeOut('slow'); }
        jQuery('#rh-opts-export-link-value').toggle('fade');
    });

});
