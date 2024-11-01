<div id="slider-gallery">
    <!--Add New Slide Button-->
<!--    <div name="add-new-imgslider" id="add-new-imgslider" class="new-slider" style="height: 210px; width: 220px; border-radius: 8px;">-->
<!--        <div class="menu-icon dashicons dashicons-format-image"></div>-->
<!--        <div class="add-text">--><?php //_e('New Slide', clktusg_txt_dm); ?><!--</div>-->
<!--    </div>-->
    <input type="button" id="add-new-imgslider" name="add-new-imgslider" class="btn btn-primary" rel="" value="<?php _e('New Slide', clktusg_txt_dm); ?>">
<!--    <input type="button" id="add-new-vidslider" name="add-new-vidslider" class="btn btn-primary" rel="" value="--><?php //_e('New Video', clktusg_txt_dm); ?><!--">-->
    <input type="button" id="remove-all-slides" name="remove-all-slides" class="btn btn-primary" rel="" value="<?php _e('Delete All Slides', clktusg_txt_dm); ?>">
	<ul id="remove-slides" class="sbox">
		<?php
		$clkt_allslides = unserialize(base64_decode(get_post_meta( $post->ID, 'clktusg_slider_slides_'.$post->ID, true)));
		if(isset($clkt_allslides[0]['clktusg_slider_id'])){
			$counter = count( $clkt_allslides );
			for ( $i = 0; $i < $counter; $i ++ ) {
				$id         =    $clkt_allslides[$i]['clktusg_slider_id'];
				$title      =    $clkt_allslides[$i]['clktusg_slider_title'];
				$description=    $clkt_allslides[$i]['clktusg_slider_desc'];
//				$video_url  =    $clkt_allslides[$i]['clktusg_video_url'];
//				$is_video_value = $clkt_allslides[$i]['clktusg_slide_is_video'];
//				$default_img_value= $clkt_allslides[$i]['clktusg_use_default_imgae'];
				$thumbnail = wp_get_attachment_image_src($id, 'thumbnail', true);
				$attachment = get_post( $id );

//				var_dump($id);
				?>
                <li class="slide row">
                    <div class="col-md-2">
                        <img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="">

                    </div>
                    <div class="col-md-7">
                        <input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
                        <!-- Slide Title-->
                        <input type="text" name="slide-title[]" id="slide-title[]" class="form-control" placeholder="Slide Title"  value="<?php echo esc_attr($title); ?>">
                        <textarea rows="4" cols="50" name="slide-desc[]" id="slide-desc[]"  class="form-control" placeholder="Slide Description"><?php echo esc_textarea($description); ?></textarea>
<!--                        <input type="text" name="slide-video[]" id="slide-video[]" class="form-control initial-hidden" placeholder="Video Url"  value="--><?php //echo esc_attr($video_url); ?><!--">-->
                    </div>
                    <div class="col-md-3">
                        <input type="button" name="remove-slide" id="remove-slide" class="btn btn-primary" value="Delete Slide">

                    </div>
                </li>
				<?php

			}

		} //end of if
		?>
	</ul>
</div>


<div style="clear:left;"></div>
<!--<br>-->
<!--<h1 style="font-size: xx-large;"><em>--><?php //_e('Slider Settings', clktusg_txt_dm); ?><!--</em></h1>-->
<!--<hr>-->