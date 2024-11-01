<?php
/*Template Name: Ultra Slider
Template Post Type: clktusg_ultra_slider
*/

get_header();?>
	<div id="clkt-cpt-primary">
		<div id="clkt-inner-cpt">

			<?php
			global $post;
			$current_page=$post->ID;

//			$postLink = get_permalink($post_object->ID);
//			$postId = bwp_url_to_postid($link);
//			var_dump($postid);
			$mypost = array( 'post_type' => 'clktusg_ultra_slider', 'p'=>$current_page);
// The Query
$the_query = new WP_Query( $mypost );

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo "<h1>".get_the_title()."</h1>" ;
		echo do_shortcode("[clktusg-slider id=".$current_page."]");
	}

	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
}?>
		</div>

	</div>
<?php

get_footer();