<?php
/**
 * Responsive Slider Shortcode
 *
 * @access    public
 *
 * @return    Create Frontend Responsive Slider Output
 */
add_shortcode('clktusg-slider', 'clktusg_responsive_slider_shortcode');

function clktusg_responsive_slider_shortcode($post_id) {
	wp_enqueue_script('clktusg-fotorama-js', CLKTUSG_PLUGIN_URL .'js/fotorama.min.js', array('jquery'));
	wp_enqueue_style('clktusg-fotorama-css', CLKTUSG_PLUGIN_URL .'css/wkmp-fotorama.min.css');
	wp_enqueue_style('clktusg-cpt-css', CLKTUSG_PLUGIN_URL .'css/ultra-slider.css');
	ob_start();
    $clktusg_query = array(  'p' => $post_id['id'], 'post_type' => 'clktusg_ultra_slider');
    $clktusg_loop = new WP_Query( $clktusg_query );

	while ( $clktusg_loop->have_posts() ) : $clktusg_loop->the_post();
		$post_id = get_the_ID();
		$clktusg_saved_setting = unserialize((get_post_meta( $post_id, 'clktusg_slider_settings_'.$post_id, true)));
		$clkt_allslides = unserialize(base64_decode(get_post_meta( $post_id, 'clktusg_slider_slides_'.$post_id, true)));
//		var_dump($clktusg_saved_setting);


        if(isset($clkt_allslides) && count($clkt_allslides[0]['clktusg_slider_id']) > 0) {
         ?>
                <div class="fotorama clkt-image-silder"
				<?php if(isset($clktusg_saved_setting['clktusg_slider_width'])) echo 'data-width='.$clktusg_saved_setting['clktusg_slider_width']; else echo 'data-width="100%"'; ?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_height'])) echo 'data-height="'.$clktusg_saved_setting['clktusg_slider_height'].'"'; else echo 'data-height="100%"';?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_nav_style']) && $clktusg_saved_setting['clktusg_slider_nav_style']!= "") echo 'data-nav='.$clktusg_saved_setting['clktusg_slider_nav_style']; ?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_nav_width']) && $clktusg_saved_setting['clktusg_slider_nav_width']!= "") echo 'data-navwidth='.$clktusg_saved_setting['clktusg_slider_nav_width']; ?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_fullscreen']) && $clktusg_saved_setting['clktusg_slider_fullscreen']!= "") echo 'data-allowfullscreen='.$clktusg_saved_setting['clktusg_slider_fullscreen']; else echo 'data-allowfullscreen="true"'; ?>

				<?php if(isset($clktusg_saved_setting['clktusg_slider_transition_duration']) && $clktusg_saved_setting['clktusg_slider_transition_duration']!= "") echo 'data-transitionduration='.$clktusg_saved_setting['clktusg_slider_transition_duration'];?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_slide_text']) && $clktusg_saved_setting['clktusg_slider_slide_text']!= "") echo $slidetext = $clktusg_saved_setting['clktusg_slider_slide_text']; else $slidetext = "false"; ?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_loop']) && $clktusg_saved_setting['clktusg_slider_loop']!= "") echo 'data-loop='.$clktusg_saved_setting['clktusg_slider_loop']; else 'data-loop="true"';?>
				<?php if(isset($clktusg_saved_setting['clktusg_slider_nav_arrow']) && $clktusg_saved_setting['clktusg_slider_nav_arrow']!= "") echo 'data-arrows='.$clktusg_saved_setting['clktusg_slider_nav_arrow']; ?>

				<?php if(isset($clktusg_saved_setting['clktusg_slider_spinner']) && $clktusg_saved_setting['clktusg_slider_spinner']!= "") echo 'data-spinner='.$clktusg_saved_setting['clktusg_slider_spinner']; ?>

	            <?php if(isset($clktusg_saved_setting['clktusg_slider_autoplay']) && $clktusg_saved_setting['clktusg_slider_autoplay']== "true" &&  $clktusg_saved_setting['clktusg_slide_interval']=="")
            {
		            echo 'data-autoplay="true"';
//	                var_dump("iam 1");
	            } elseif(isset($clktusg_saved_setting['clktusg_slider_autoplay']) && $clktusg_saved_setting['clktusg_slider_autoplay']== "true" &&  $clktusg_saved_setting['clktusg_slide_interval']!="")
                {
                    echo 'data-autoplay="'.$clktusg_saved_setting['clktusg_slide_interval'].'"';
//	                var_dump("iam 2");
                } else
                {
                    echo 'data-autoplay="false"';
//	                var_dump("iam 3");
                }?>

                <?php if(isset($clktusg_saved_setting['clktusg_slider_fit_slides']) && $clktusg_saved_setting['clktusg_slider_fit_slides']!= "") echo 'data-fit='.$clktusg_saved_setting['clktusg_slider_fit_slides']; ?>
	            <?php if(isset($clktusg_saved_setting['clktusg_slider_transition_effect']) && $clktusg_saved_setting['clktusg_slider_transition_effect']!= "") echo 'data-transition="'.$clktusg_saved_setting['clktusg_slider_transition_effect'].'"'; ?>

                data-stopautoplayontouch="false"
                >
                <?php
//            var_dump($clktusg_saved_setting['clktusg_slide_interval']);
//            exit;
				$clktusg_counter = count( $clkt_allslides );
				for ( $i = 0; $i < $clktusg_counter; $i ++ ) {

					$attachment_id = $clkt_allslides[ $i ]['clktusg_slider_id'];

					$thumb         = wp_get_attachment_image_src( $attachment_id, 'thumb', true );
					$thumbnail     = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
					$medium        = wp_get_attachment_image_src( $attachment_id, 'medium', true );
					$large         = wp_get_attachment_image_src( $attachment_id, 'large', true );
					$postthumbnail = wp_get_attachment_image_src( $attachment_id, 'post-thumbnail', true );

					$attachment_details = get_post( $attachment_id );
					$href               = get_permalink( $attachment_details->ID );
					$src                = $attachment_details->guid;
					$title              = $attachment_details->post_title;



					    if ( $slidetext == 'true' ) {
						    $description = $clkt_allslides[ $i ]['clktusg_slider_desc'];
					    } else {
						    $description = "";
					    }

					    ?><img src="<?php echo $thumb[0]; ?>" data-caption="<?php echo $description; ?>"><?php
				    }

            
        } else {
				
				_e('Sorry! No slides are currently added to the slider shortcode yet. Please add few slide into slider with shortcode', clktusg_txt_dm);
				echo ": [clktusg-slider id=$post_id]";
        } // end of if esle of slides avaialble check into slider
			?>
		</div>
		<?php
	endwhile;
	wp_reset_query();
    return ob_get_clean();
	?>
	<!-- HTML Script Part Start From Here-->
	<script>
	jQuery(function () {
	  jQuery('.clkt-image-silder').fotorama({
		  spinner: {
			lines: 13,
			color: 'rgba(0, 0, 0, .75)',
			className: 'fotorama',
		  }		  
	  });
	});
	</script>
	<?php
}
?>