jQuery(function(jQuery) {
    
    var file_frame,
    wkmpslider = {
        ul: '',
        init: function() {
            this.ul = jQuery('.sbox');
            this.ul.sortable({
                placeholder: '',
				revert: true,
            });

            /**
			 * Add Slide Callback Funtion
			 */
            jQuery('#add-new-slider').on('click', function(event) {
                event.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media.frames.file_frame = wp.media({
                    multiple: true
                });

               file_frame.on('select', function() {
                    var images = file_frame.state().get('selection').toJSON(),
                            length = images.length;

                    for (var i = 0; i < length; i++) {
                        wkmpslider.get_thumbnail(images[i]['id']);
                    }


                });

                file_frame.open();
            });

			/**
			 * Delete Slide Callback Function
			 */
            this.ul.on('click', '#remove-slide', function() {
                if (confirm('Do you wnat to delete this slide?')) {
                    jQuery(this).parent().parent().fadeOut(700, function() {
                        jQuery(this).remove();
                    });
                }
                return false;
            });

			/**
			 * Delete All Slides Callback Function
			 */
			jQuery('#remove-all-slides').on('click', function() {
                if (confirm('Do you want to delete all slides?')) {
                    wkmpslider.ul.empty();
                }
                return false;
            });

        },
        get_thumbnail: function(id, cb) {
            cb = cb || function() {
            };
            var data = {
                action: 'slide',
                slideId: id
            };
            jQuery.post(ajaxurl, data, function(response) {
                wkmpslider.ul.append(response);
                cb();
            });
        }
    };
    wkmpslider.init();
});