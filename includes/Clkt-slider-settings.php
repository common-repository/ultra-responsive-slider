<?php
//toggle button CSS
wp_enqueue_style('clktusg-toogle-button-css', CLKTUSG_PLUGIN_URL . 'css/ultra-slider-inner.css');

//css dropdown toggle
wp_enqueue_style( 'clktusg-bootstrap-css', CLKTUSG_PLUGIN_URL .'css/bootstrap.css' );
wp_enqueue_style('clktusg-font-awesome-css', CLKTUSG_PLUGIN_URL . 'css/font-awesome.css');
wp_enqueue_style('clktusg-styles-css', CLKTUSG_PLUGIN_URL . 'css/styles.css');

//js
wp_enqueue_script('jquery');
wp_enqueue_script( 'clktusg-bootstrap-js',  CLKTUSG_PLUGIN_URL .'js/bootstrap.js', array( 'jquery' ), '', true  );

?>
<style>
	.res_slider_settings {
		font-size: 16px !important;
		padding-left: 4px;
		font: initial;
		margin-top: 5px;
		font-weight: 500;
		padding-left:20px;
	}
	.input_width {
		border-width: 1px 1px 1px 6px !important;
		border-color: #3366ff !important;
		width: 40% !important;
        font-size: 14px;
	}
    .setting-td{
        font-size: 14px;
        background-color: #f9f9fb;
        /*font-weight: 700;*/
    }
</style>
<?php
$clktusg_saved_setting = unserialize(get_post_meta( $post->ID, 'clktusg_slider_settings_'.$post->ID, true));


    if(isset($clktusg_saved_setting['clktusg_slider_width'])) $width = $clktusg_saved_setting['clktusg_slider_width']; else $width = "100%";
    if(isset($clktusg_saved_setting['clktusg_slider_height'])) $height = $clktusg_saved_setting['clktusg_slider_height']; else $height = "";
    if(isset($clktusg_saved_setting['clktusg_slider_nav_style'])) $navstyle = $clktusg_saved_setting['clktusg_slider_nav_style']; else $navstyle = "dots";
    if(isset($clktusg_saved_setting['clktusg_slider_nav_width'])) $navWidth= $clktusg_saved_setting['clktusg_slider_nav_width']; else $navWidth= "";
    if(isset($clktusg_saved_setting['clktusg_slider_fullscreen'])) $fullscreen = $clktusg_saved_setting['clktusg_slider_fullscreen']; else $fullscreen = "true";
    if(isset($clktusg_saved_setting['clktusg_slider_fit_slides'])){
	    if($clktusg_saved_setting['clktusg_slider_fit_slides']=='none' || $clktusg_saved_setting['clktusg_slider_fit_slides']=='')
		    $fitslides = "none";
	    elseif ($clktusg_saved_setting['clktusg_slider_fit_slides']=='contain')
		    $fitslides = "contain";
        elseif ($clktusg_saved_setting['clktusg_slider_fit_slides']=='scaledown')
	        $fitslides = "scaledown";
        else
            $fitslides = "cover";
    }
    else{
	    $fitslides = "cover";
    }
if(isset($clktusg_saved_setting['clktusg_slider_transition_effect'])){
	if($clktusg_saved_setting['clktusg_slider_transition_effect']=='crossfade')
		$transioneffect = "crossfade";
    elseif ($clktusg_saved_setting['clktusg_slider_transition_effect']=='dissolve')
	    $transioneffect = "dissolve";
	else
		$transioneffect = "slide";
}else{
	$transioneffect = "dissolve";
}

    if(isset($clktusg_saved_setting['clktusg_slider_transition_duration'])) $transitionduration = $clktusg_saved_setting['clktusg_slider_transition_duration']; else $transitionduration = "1500";
    if(isset($clktusg_saved_setting['clktusg_slider_slide_text'])) $slidetext = $clktusg_saved_setting['clktusg_slider_slide_text']; else $slidetext = "false";

    if(isset($clktusg_saved_setting['clktusg_slider_loop'])) $loop = $clktusg_saved_setting['clktusg_slider_loop']; else $loop = "true";
    if(isset($clktusg_saved_setting['clktusg_slider_nav_arrow'])) $navarrow = $clktusg_saved_setting['clktusg_slider_nav_arrow']; else $navarrow = "true";
//    if(isset($clktusg_saved_setting['clktusg_slider_touch_slide'])) $touchslide = $clktusg_saved_setting['clktusg_slider_touch_slide']; else $touchslide = "true";
    if(isset($clktusg_saved_setting['clktusg_slider_spinner'])) $spinner = $clktusg_saved_setting['clktusg_slider_spinner']; else $spinner = "true";
//    if(isset($clktusg_saved_setting['clktusg_slider_direction'])) $direction = $clktusg_saved_setting['clktusg_slider_direction']; else $direction = "";
    if(isset($clktusg_saved_setting['clktusg_slider_autoplay'])) $autoplay = $clktusg_saved_setting['clktusg_slider_autoplay']; else $autoplay = "true";
    if(isset($clktusg_saved_setting['clktusg_slide_interval'])) $slide_interval = $clktusg_saved_setting['clktusg_slide_interval']; else $slide_interval = "";
?>
<div class="table-responsive">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td class="setting-td"><?php _e('Slider Width', clktusg_txt_dm); ?></td>
                <td><input class="form-control" type="text" name="width" id="width" value="<?php echo esc_attr($width); ?> " data-toggle="tooltip" title="<?php _e('Set slider width in pixels OR percents like 300px / 600px / 800px OR 25% / 50% / 100% ', clktusg_txt_dm); ?>"></td>
            </tr>
            <tr>
                <td class="setting-td"><?php _e('Slider Height', clktusg_txt_dm); ?></p></td>
                <td><input class="form-control" type="text" name="height" id="height" value="<?php echo esc_attr($height); ?>" data-toggle="tooltip" title="<?php _e('Set slider height in pixels OR percents like 300px / 600px / 800px OR 25% / 50% / 100% ', clktusg_txt_dm); ?>"></td>
            </tr>
            <tr>
                <td class="setting-td"><?php _e('Transition Style', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set slide transition style', clktusg_txt_dm); ?>">
                    <input type="radio" name="trans-style" id="trans-style1" value="slide" <?php if(isset($transioneffect)){if($transioneffect == "slide") echo "checked=checked";} ?>>
                    <label for="trans-style1"><?php _e('Slide', clktusg_txt_dm); ?></label>
                    <input type="radio" name="trans-style" id="trans-style2" value="crossfade" <?php if(isset($transioneffect)){ if($transioneffect == "crossfade") echo "checked=checked"; }?>>
                    <label for="trans-style2"><?php _e('Cross Fade', clktusg_txt_dm); ?></label>
                    <input type="radio" name="trans-style" id="trans-style3" value="dissolve" <?php if(isset($transioneffect)){if($transioneffect == "dissolve") echo "checked=checked"; }?>>
                    <label for="trans-style3"><?php _e('Dissolve', clktusg_txt_dm); ?></label></td>
            </tr>
            <tr>
                <td class="setting-td"><?php _e('Transition Effect Duration', clktusg_txt_dm); ?></td>
                <td><input class="form-control" type="text" name="transition-duration" id="transition-duration" value="<?php echo esc_attr($transitionduration); ?>" data-toggle="tooltip" title="<?php _e('Set transition effect duration in millisecond between slides like 500 / 1000 / 3000', clktusg_txt_dm); ?>"></td>
            </tr>
            <tr>
                <td class="setting-td"><?php _e('Navigation Style', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set slides navigation styles', clktusg_txt_dm); ?>">
                    <input type="radio" name="nav-style" id="nav-style3" value="false" <?php if($navstyle == "false") echo "checked=checked"; ?>>
                    <label for="nav-style3"><?php _e('None', clktusg_txt_dm); ?></label>
                    <input type="radio" name="nav-style" id="nav-style1" value="dots" <?php if($navstyle == "dots") echo "checked=checked"; ?>>
                    <label for="nav-style1"><?php _e('Dots', clktusg_txt_dm); ?></label>
                    <input type="radio" name="nav-style" id="nav-style2" value="thumbs" <?php if($navstyle == "thumbs") echo "checked=checked"; ?>>
                    <label for="nav-style2"><?php _e('Thumbnail', clktusg_txt_dm); ?></label></td>
            </tr>

            <tr>
                <td class="setting-td"><?php _e('Navigation Width', clktusg_txt_dm); ?></td>
                <td><input class="form-control" type="text" name="nav-width" id="nav-width" value="<?php echo esc_attr($navWidth); ?>" data-toggle="tooltip" title="<?php _e('Set navigation width in pixels or percent', clktusg_txt_dm); ?>"></td>
            </tr>

            <tr>
                <td class="setting-td"><?php _e('Auto Play', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set auto play option for the slider, when page loads', clktusg_txt_dm); ?>">
                    <input type="radio" name="autoplay" id="autoplay1" value="true" <?php if($autoplay == "true") echo "checked=checked"; ?>>
                    <label for="autoplay1"><?php _e('Yes', clktusg_txt_dm); ?></label>
                    <input type="radio" name="autoplay" id="autoplay2" value="false" <?php if($autoplay == "false") echo "checked=checked"; ?>>
                    <label for="autoplay2"><?php _e('No', clktusg_txt_dm); ?></label>
                </td>
            </tr>


            <tr>
                <td class="setting-td"><?php _e('Slide Interval', clktusg_txt_dm); ?></td>
                <td><input class="form-control" type="text" name="slide-interval" id="slide-interval" value="<?php echo esc_attr($slide_interval); ?>" data-toggle="tooltip" title="<?php _e('Set slide interval option in miliseconds like 500 / 1000 / 3000 to play next slide automatically, when autoplay option is enabled ', clktusg_txt_dm); ?>"></td>
            </tr>



            <tr>
                <td class="setting-td"><?php _e('Allow Full Screen Slider Option', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Enable or disable full screen option to view slides', clktusg_txt_dm); ?>">
                    <input type="radio" name="fullscreen" id="fullscreen1" value="true" <?php if($fullscreen == "true") echo "checked=checked"; ?> >
                    <label for="fullscreen1"><?php _e('True', clktusg_txt_dm); ?></label>
                    <input type="radio" name="fullscreen" id="fullscreen2" value="false" <?php if($fullscreen == "false") echo "checked=checked";?> >
                    <label for="fullscreen2"><?php _e('False', clktusg_txt_dm); ?></label>
                    <input type="radio" name="fullscreen" id="fullscreen3" value="native" <?php if($fullscreen == "native") echo "checked=checked";?> >
                    <label for="fullscreen3"><?php _e('Native', clktusg_txt_dm); ?></label>
                </td>
            </tr>
            <tr>
                <td class="setting-td"><?php _e('Fit Slides', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set how to fit slide images into slider frame', clktusg_txt_dm); ?>">
                    <input type="radio" name="fit-slides" id="fit-slides1" value="contain" <?php if($fitslides == "contain") echo "checked=checked"; ?>>
                    <label for="fit-slides1"><?php _e('Contain', clktusg_txt_dm); ?></label>
                    <input type="radio" name="fit-slides" id="fit-slides2" value="cover" <?php if($fitslides == "cover") echo "checked=checked"; ?>>
                    <label for="fit-slides2"><?php _e('Cover', clktusg_txt_dm); ?></label>
                    <input type="radio" name="fit-slides" id="fit-slides3" value="scaledown" <?php if($fitslides == "scaledown") echo "checked=checked"; ?>>
                    <label for="fit-slides3"><?php _e('Scale Down', clktusg_txt_dm); ?></label>
                    <input type="radio" name="fit-slides" id="fit-slides4" value="none" <?php if($fitslides == "none") echo "checked=checked"; ?>>
                    <label for="fit-slides4"><?php _e('None', clktusg_txt_dm); ?></label>
                </td>
            </tr>

            <tr>
                <td class="setting-td"><?php _e('Display Slide Description', clktusg_txt_dm); ?></td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set description visibility on slider', clktusg_txt_dm); ?>">
                    <input type="radio" name="slide-text" id="slide-text1" value="true" <?php if($slidetext == "true") echo "checked=checked"; ?>>
                    <label for="slide-text1"><?php _e('Yes', clktusg_txt_dm); ?></label>
                    <input type="radio" name="slide-text" id="slide-text2" value="false" <?php if($slidetext == "false") echo "checked=checked"; ?>>
                    <label for="slide-text2"><?php _e('No', clktusg_txt_dm); ?></label>
                </td>
            </tr>


            <tr>
                <td class="setting-td">
                    <?php _e('Allow Loop', clktusg_txt_dm); ?>
                </td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set loop to slides continuously', clktusg_txt_dm); ?>">
                    <input type="radio" name="loop" id="loop1" value="true" <?php if($loop == "true") echo "checked=checked"; ?>>
                    <label for="loop1"><?php _e('Yes', clktusg_txt_dm); ?></label>
                    <input type="radio" name="loop" id="loop2" value="false" <?php if($loop == "false") echo "checked=checked"; ?>>
                    <label for="loop2"><?php _e('No', clktusg_txt_dm); ?></label>
                </td>
            </tr>

            <tr>
                <td class="setting-td">
	                <?php _e('Navigation Arrow', clktusg_txt_dm); ?>
                </td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set navigation arrow display options', clktusg_txt_dm); ?>">
                    <input type="radio" name="nav-arrow" id="nav-arrow2" value="true" <?php if($navarrow == "true") echo "checked=checked"; ?>>
                    <label for="nav-arrow2"><?php _e('Show', clktusg_txt_dm); ?></label>
                    <input type="radio" name="nav-arrow" id="nav-arrow3" value="false" <?php if($navarrow == "false") echo "checked=checked"; ?>>
                    <label for="nav-arrow3"><?php _e('Hide', clktusg_txt_dm); ?></label>
                </td>
            </tr>



            <tr>
                <td class="setting-td">
	                <?php _e('Slide Loading Spinner', clktusg_txt_dm); ?>
                </td>
                <td class="input-text-wrap switch-field em_size_field" data-toggle="tooltip" title="<?php _e('Set this option to display spinner when slider appear on page load', clktusg_txt_dm); ?>">
                    <input type="radio" name="spinner" id="spinner1" value="true" <?php if($spinner == "true") echo "checked=checked"; ?>>
                    <label for="spinner1"><?php _e('Yes', clktusg_txt_dm); ?></label>
                    <input type="radio" name="spinner" id="spinner2" value="false" <?php if($spinner == "false") echo "checked=checked"; ?>>
                    <label for="spinner2"><?php _e('No', clktusg_txt_dm); ?></label>
                </td>
            </tr>


        </tbody>
    </table>
</div>
<input type="hidden" name="clktusg-save-settings" id="clktusg-save-settings" value="save-settings">
<!--<input type="hidden" name="clktusg-nonce"  value="--><?php //echo wp_create_nonce('clktusg-usersetting')?><!--">-->

















<!--<p class="res_slider_settings">--><?php //_e('Upgrade To Pro Version For This All Settings', clktusg_txt_dm); ?>
<!--	<a href="http://awplife.com/product/ultrrs-slider-gallery-premium/" target="_blank">Buy Premium Version</a>-->
<!--</p>-->
<!---->
<!---->
<!---->
<!--<hr>-->
<!--	<p class="">-->
<!--		<a href="http://demo.awplife.com/ultrrs-slider-gallery-premium/" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Check Premium Version Live Demo</a>-->
<!--		<a href="http://demo.awplife.com/ultrrs-slider-gallery-premium-admin/" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Try Premium Version Admin Demo</a>-->
<!--		<a href="http://awplife.com/product/ultrrs-slider-gallery-premium/" target="_blank" class="button button-primary button-hero load-customize hide-if-no-customize">Buy Premium Version</a>-->
<!--	</p>-->
<!--	<hr>-->
	<style>
		.awp_bale_offer {
			background-image: url("<?php echo CLKTUSG_PLUGIN_URL ?>/image/awp-bale.jpg");
			background-repeat:no-repeat;
			padding:30px;
		}
		.awp_bale_offer h1 {
			font-size:35px;
			color:#FFFFFF;
		}
		.awp_bale_offer h3 {
			font-size:25px;
			color:#FFFFFF;
		}
		.awp_bale_offer h2 {
			font-size:25px !important;
			color:#000002;
		}
	</style>


	<!-- Return to Top -->
	<a href="javascript:" id="return-to-top"><i class="glyphicon glyphicon-arrow-up"></i></a>
<script>
    jQuery(document).ready(function(){
        jQuery('[data-toggle="tooltip"]').tooltip();
//        jQuery("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });


	// ===== Scroll to Top ==== 
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
			jQuery('#return-to-top').fadeIn(200);    // Fade in the arrow
		} else {
			jQuery('#return-to-top').fadeOut(200);   // Else fade out the arrow
		}
	});
	jQuery('#return-to-top').click(function() {      // When arrow is clicked
		jQuery('body,html').animate({
			scrollTop : 0                       // Scroll to top of body
		}, 500);
	});
	
// Show Hide Settings
	// Navigation settings start
	var nav_style = jQuery('input[name="nav-style"]:checked').val();
		//on change to enable & disable navigation Setting
		if(nav_style == "dots") {
			jQuery('.dots_hs').show();
		}
		if(nav_style == "false") {
			jQuery('.dots_hs').hide();
		}

		//on change to enable & disable navigation Setting
		jQuery(document).ready(function() {
			jQuery('input[name="nav-style"]').change(function(){
				var nav_style = jQuery('input[name="nav-style"]:checked').val();
				if(nav_style == "dots") {
					jQuery('.dots_hs').show();
				}
				if(nav_style == "false") {
					jQuery('.dots_hs').hide();
				}
			});
		});
	// Navigation Setting End
	
	// Auto Play settings start
	var autoplay = jQuery('input[name="autoplay"]:checked').val();
		//on change to enable & disable navigation Setting
		if(autoplay == "true") {
			jQuery('.auto_sh').show();
		}
		if(autoplay == "false") {
			jQuery('.auto_sh').hide();
		}

		//on change to enable & disable Auto Play Setting
		jQuery(document).ready(function() {
			jQuery('input[name="autoplay"]').change(function(){
				var autoplay = jQuery('input[name="autoplay"]:checked').val();
				if(autoplay == "true") {
					jQuery('.auto_sh').show();
				}
				if(autoplay == "false") {
					jQuery('.auto_sh').hide();
				}
			});
		});
	// Auto Play Setting End
//show hide settings end

	//dropdown toggle on change effect
	jQuery(document).ready(function() {
		//accordion icon
		jQuery(function() {
			function toggleSign(e) {
				jQuery(e.target)
				.prev('.panel-heading')
				.find('i')
				.toggleClass('fa fa-chevron-down fa fa-chevron-up');
			}
			jQuery('#accordion').on('hidden.bs.collapse', toggleSign);
			jQuery('#accordion').on('shown.bs.collapse', toggleSign);

			});
		});

//   video options settings
	jQuery(document).ready(function() {
        jQuery( "input[id='is-video[]']" ).each(function(index) {

        if(jQuery( this ).prop('checked')==true) {

            jQuery(this).parent().parent().siblings().find('textarea').hide("slow");
            jQuery(this).parent().parent().siblings().find("input[name='slide-video[]']").toggleClass("initial-hidden");
            jQuery(this).parent().siblings().find("input[id='set-default[]']").parent().toggleClass("initial-hidden");

        }//ending if
        });
    });

//	// start pulse on page load
//	function pulseEff() {
//	   jQuery('#shortcode').fadeOut(600).fadeIn(600);
//	};
//	var Interval;
//	Interval = setInterval(pulseEff,1500);
//
//	// stop pulse
//	function pulseOff() {
//		clearInterval(Interval);
//	}
//	// start pulse
//	function pulseStart() {
//		Interval = setInterval(pulseEff,1500);
//	}
</script>		