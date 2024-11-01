<?php
/**
 * @package  Ultra Responsive Slider
 */
/*
Plugin Name: Ultra Responsive Slider
Plugin URI: #
Description: A Responsive, Elegant, Powerful CSS & JS Based Slider Gallery Plugin Loaded with Extreme Ultra Features
Version: 0.0.3
Author: ClickItPlugins
Author URI: https://clickitplugins.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: clktusg_txt_dm
*/

if ( ! class_exists( 'Clkt_Ultra_Responsive_Slider' ) ) {

	class Clkt_Ultra_Responsive_Slider {
		
		protected $protected_plugin_api;
		protected $ajax_plugin_nonce;

		//constructor call
        // __ used for indicating private methods
		public function __construct() {
			$this->_constants();
			$this->_hooks();
		}
		
		protected function _constants() {
			/**
			 * Plugin Version
			 */
			define( 'CLKTUSG_PLUGIN_VER', '0.1.2' );
			
			/**
			 * Plugin Text Domain
			 */
			define("clktusg_txt_dm","clktusg-ultra-slider" );

			/**
			 * Plugin Name
			 */
			define( 'CLKTUSG_PLUGIN_NAME', __( 'Ultra Responsive Slider', 'clktusg_txt_dm' ) );

			/**
			 * Plugin Slug
			 */
			define( 'CLKTUSG_PLUGIN_SLUG', 'clktusg_ultra_slider' );

			/**
			 * Plugin Directory Path
			 */
			define( 'CLKTUSG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

			/**
			 * Plugin Directory URL
			 */
			define( 'CLKTUSG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//			/**
//			 * Create a key for the .htaccess secure download link.
//			 *
//			 * @uses    NONCE_KEY     Defined in the WP root config.php
//			 */
//			define( 'EWPT_SECURE_KEY', md5( NONCE_KEY ) );

		} // end of constructor function


		/**
		 * Setup the default filters and actions
		 * @uses      add_action()  To add various actions
		 * @access    private
		 * @return    void
		 */
		protected function _hooks() {
			/**
			 * Load text domain
			 */
			add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) );

			/**
			 * add gallery menu item, change menu filter for multisite
			 */
			add_action( 'admin_menu', array( $this, '_clktusg_slider_menu' ), 101 );

			/**
			 * Create  Ultra Responsive Slider Custom Post
			 */
			add_action( 'init', array( $this, '_Ultra_Responsive_Slider' ));

			/**
		     * Add meta box to custom post
		     */
			 add_action( 'add_meta_boxes', array( $this, '_admin_add_meta_box' ) );

			/**
		     * loaded during admin init
		     */
//			add_action( 'admin_init', array( $this, '_admin_add_meta_box' ) );

			add_action('wp_ajax_slide', array(&$this, '_ajax_slide'));

			add_action('save_post', array(&$this, '_save_settings'));

			/**
		     * Shortcode Compatibility in Text Widgets
		     */
			add_filter('widget_text', 'do_shortcode');

			/**
			 * Creating template for Ultra responsice CPT
			 */
			add_filter( 'template_include', array(&$this, '_include_template_function'), 1 );

			/**
			 * creating custom column for Ultra responsive CPT
			 */
			add_filter('manage_edit-clktusg_ultra_slider_columns',  array(&$this, 'clktusg_my_columns' ));
			add_action('manage_posts_custom_column',  array(&$this, 'clktusg_my_show_columns' ));

			add_action( 'edit_form_after_title', array(&$this, 'display_main_cpt'));

			add_action( 'add_meta_boxes', array(&$this, 'clktusg_premium_meta'));
			add_action( 'add_meta_boxes', array(&$this, 'clktusg_support_meta'));

		} // end of hook function


	function clktusg_support_meta( ) {
		add_meta_box(
			'my-support-meta-box',
			__( 'Support' ),
			array(&$this, 'clktusg_render_support_meta_box'),
			'clktusg_ultra_slider',
			'side',
			'default'
		);
	}

		function clktusg_render_support_meta_box() {
			?>
            <a href="http://clickitplugins.com/support/" target="_blank" class="btn btn-primary red-premium">Get Support</a>
			<?php
		}

		function clktusg_premium_meta() {
			add_meta_box(
				'my-premium-meta-box',
				__( 'Premium Features' ),
				array(&$this, 'clktusg_render_premium_meta_box'),
				'clktusg_ultra_slider',
				'side',
				'default'
			);
		}

		function clktusg_render_premium_meta_box(){
//		    echo "test";
			?>
            <!--        <style type="text/css">-->
            <!--            .clickitfbf-action-btn{-->
            <!--                width: 93%; text-align: center; background: #e14d43;-->
            <!--                display: block; padding: 18px 8px; font-size: 16px;-->
            <!--                border-radius: 5px; color: white; text-decoration:-->
            <!--                    none; border: 2px solid #e14d43;-->
            <!--                transition: all 0.2s; }-->
            <!--            .clickitfbf-action-btn:hover{-->
            <!--                width: 93%; text-align: center; display: block;-->
            <!--                padding: 18px 8px; font-size: 16px; border-radius: 5px;-->
            <!--                color: white !important; text-decoration: none;-->
            <!--                background: #bb4138 !important; border: 2px solid #bb4138;-->
            <!--            }-->
            <!--        </style>-->

            <strong>
                <ul>
                    <li> - Unlock Video Slider Feature</li>
                    <li> - Change any Image Slide to Video slide in 2 steps</li>
                    <li> - Unlock Video Splash Image Option</li>
                    <li> - Unlock Widget Support </li>
                    <li> - Unlock Slide Touch Option</li>
                    <li> - Get 24/7 Premium Support</li>
                    <li> - Unlimited Updates</li>
                </ul>
            </strong>
            <a href="http://clickitplugins.com/wp-ultra-responsive-slider/" target="_blank" class="btn btn-primary red-premium">Go Premium Now</a>
			<?php
//			exit;

		}

		function clktusg_my_columns($columns) {
			if ( get_post_type() == 'clktusg_ultra_slider' ) {
				$new = array();
//				$tags = $defaults['tags'];  // save the tags column
//				unset($defaults['tags']);   // remove it from the columns list

				foreach($columns as $key=>$value) {
					if($key=='date') {  // when we find the date column
						$new['shortcode'] = 'Shortcode';  // put the shortcode column before it
					}
					$new[$key]=$value;
				}

				return $new;
			}
		}

		function clktusg_my_show_columns($name) {
			if ( get_post_type() == 'clktusg_ultra_slider' ) {
				global $post;
				switch ( $name ) {
					case 'shortcode':
						$shortcode = "[clktusg-slider id=" . $post->ID . "]";
//                        get_post_meta($post->ID, 'views', true);
						echo $shortcode;
				}
			}
		}


		/**
		 * Search for suitable CPT template first in extisting theme then in plugin
		 * @return    file path
		 * @access    private
		 */

		function _include_template_function( $template_path ) {
			if ( get_post_type() == 'clktusg_ultra_slider' ) {
				if ( is_single() ) {
					// checks if the file exists in the theme first,
					// otherwise serve the file from the plugin
					if ( $theme_file = locate_template( array ( 'single-clkt-ultra-slider.php' ) ) ) {
						$template_path = $theme_file;
					} else {
						$template_path = CLKTUSG_PLUGIN_DIR . '/template/single-clkt-ultra-slider.php';
					}
				}
			}
			return $template_path;
		}
		/**
		 * Loads the text domain.
		 * @return    void
		 * @access    private
		 */
		public function _load_textdomain() {
			load_plugin_textdomain( 'clktusg_txt_dm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Adds the Gallery menu item
		 * @access    private
		 * @return    void
		 */
		public function _clktusg_slider_menu() {
			$help_menu = add_submenu_page( 'edit.php?post_type='.CLKTUSG_PLUGIN_SLUG, __( 'Docs', 'clktusg_txt_dm' ), __( 'Docs', 'clktusg_txt_dm' ), 'administrator', 'wkmpallery-doc-page', array( $this, '_clktusg_gallery_doc_page') );
			//$featured_plugin_res_menu = add_submenu_page( 'edit.php?post_type='.CLKTUSG_PLUGIN_SLUG, __( 'Featured-Plugin', 'clktusg_txt_dm' ), __( 'Featured Plugin', 'clktusg_txt_dm' ), 'administrator', 'wkmpallery-featured-plugin-page', array( $this, '_clktusg_gallery_featured_plugin_page') );
			//$premium_plugin_menu = add_submenu_page( 'edit.php?post_type='.CLKTUSG_PLUGIN_SLUG, __( 'Upgrade-Plugin', 'clktusg_txt_dm' ), __( 'Upgrade Plugin', 'clktusg_txt_dm' ), 'administrator', 'rs-upgrade-plugin-page', array( $this, '_rs_upgrade_plugin_page') );
		}

		/**
		 *  Ultra Responsive Slider Custom Post
		 * Create slider post type in admin dashboard.
		 * @access    private
		 * @return    void      Return custom post type.
		 */
		public function _Ultra_Responsive_Slider() {
			$labels = array(
				'name'                => _x( ' Ultra Responsive Sliders', 'Post Type General Name', 'clktusg_txt_dm' ),
				'singular_name'       => _x( ' Ultra Responsive Slider', 'Post Type Singular Name', 'clktusg_txt_dm' ),
				'menu_name'           => __( ' Ultra Responsive Slider', 'clktusg_txt_dm' ),
				'name_admin_bar'      => __( ' Ultra Responsive Slider', 'clktusg_txt_dm' ),
				'parent_item_colon'   => __( 'Parent Item:', 'clktusg_txt_dm' ),
				'all_items'           => __( 'All Sliders', 'clktusg_txt_dm' ),
				'add_new_item'        => __( 'Add Slider', 'clktusg_txt_dm' ),
				'add_new'             => __( 'Add Slider', 'clktusg_txt_dm' ),
				'new_item'            => __( 'New Slider', 'clktusg_txt_dm' ),
				'edit_item'           => __( 'Edit Slider', 'clktusg_txt_dm' ),
				'update_item'         => __( 'Update Slider', 'clktusg_txt_dm' ),
				'search_items'        => __( 'Search Slider', 'clktusg_txt_dm' ),
				'not_found'           => __( 'No Slider is currently available.', 'clktusg_txt_dm' ),
				'not_found_in_trash'  => __( 'Slider Not found in Trash', 'clktusg_txt_dm' ),
			);
			$args = array(
				'label'               => __( ' Ultra Responsive Slider', 'clktusg_txt_dm' ),
				'description'         => __( 'Custom Post Type For  Ultra Responsive Slider', 'clktusg_txt_dm' ),
				'labels'              => $labels,
				'supports'            => array( 'title'),
				'taxonomies'          => array(),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 65,
				'menu_icon'           => 'dashicons-images-alt2',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);
			register_post_type( 'clktusg_ultra_slider', $args );

		} // end of post type function

		/**
		 * Adds Meta Boxes
		 * @access    private
		 * @return    void
		 */
		public function _admin_add_meta_box() {
			// Syntax: add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
//			add_meta_box( '', __('Add Image Slides', clktusg_txt_dm), array(&$this, 'display_main_cpt'), 'clktusg_ultra_slider', 'normal', 'default' );
//			add_meta_box ( __('Copy Image Slider Shortcode', clktusg_txt_dm), __('Copy Image Slider Shortcode', clktusg_txt_dm), array(&$this, 'ris_shotcode_meta_box_function'), 'clktusg_ultra_slider', 'side', 'low');
		}



		public function display_main_cpt($post) {
			$scr = get_current_screen();

			if( $scr-> post_type !== 'clktusg_ultra_slider' )
				return;
//		    var_dump(CLKTUSG_PLUGIN_URL);
//			wp_nonce_field( basename( __FILE__ ), 'custom_image_nonce' );
			wp_enqueue_script('media-upload');
			wp_enqueue_script('clktusg-uploader-js', CLKTUSG_PLUGIN_URL . 'js/slide-uploader.js', array('jquery'));
			wp_enqueue_style('clktusg-uploader-css', CLKTUSG_PLUGIN_URL . 'css/slide-uploader.css');
			wp_enqueue_media();
			?>
            <div id="ultra-main-cpt">
            <ul class="nav nav-tabs">
                <li class="active bg-title"><a data-toggle="tab" href="#home">Add Slides</a></li>
                <li class="bg-title"><a data-toggle="tab" href="#menu1">Slider Settings</a></li>
                <li class="bg-title"><a data-toggle="tab" href="#menu2">Copy Shortcode</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
	                <?php require_once( 'includes/Clkt-ultra-slider.php' ); ?>
                </div>
                <div id="menu1" class="tab-pane fade">
	                <?php require_once( 'includes/Clkt-slider-settings.php' );?>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div>
                        <p class="input-text-wrap">
			                <?php _e('Copy & Embed shortcode into any Page/Post/Text Widget to preview your slider on site.', clktusg_txt_dm); ?><br>
                        </p>
                        <input type="text" name="shortcode" id="shortcode" value="<?php echo "[clktusg-slider id=".$post->ID."]"; ?>" readonly style="height: 60px; width:300px;  background-color: InactiveBorder;  font-style: italic; text-align: center; font-size: 24px; border: 2px dashed;">
                    </div>
                </div>
            </div>
            </div>


			<?php
			//require_once('Clkt-slider-settings.php');
		} // end of upload multiple image

		public function _ajax_callback_function($id) {

			//wp_get_attachment_image_src ( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false )
			//thumb, thumbnail, medium, large, post-thumbnail
			$thumb = wp_get_attachment_image_src($id, 'thumb', true);
			$thumbnail = wp_get_attachment_image_src($id, 'thumbnail', true);
			$medium = wp_get_attachment_image_src($id, 'medium', true);
			$large = wp_get_attachment_image_src($id, 'large', true);
			$postthumbnail = wp_get_attachment_image_src($id, 'post-thumbnail', true);
			$attachment = get_post( $id ); // $id = attachment id
			?>

            <li class="slide row">
                <div class="col-md-2">
                    <img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="">

                </div>
                <div class="col-md-7">
                    <input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
                    <!-- Slide Title-->
                    <input type="text" name="slide-title[]" id="slide-title[]" class="form-control" placeholder="Slide Title"  value="<?php echo esc_attr(get_the_title($id)); ?>">
                    <textarea rows="4" cols="50" name="slide-desc[]" id="slide-desc[]"  class="form-control" placeholder="Slide Description"><?php echo esc_textarea($attachment->post_content); ?></textarea>
<!--                    <input type="text" name="slide-video[]" id="slide-video[]" class="form-control initial-hidden" placeholder="Video Url"  value="--><?php ////echo esc_attr(get_the_title($id)); ?><!--">-->
                </div>
                <div class="col-md-3">
                    <input type="button" name="remove-slide" id="remove-slide" class="btn btn-primary" value="Delete Slide">
                    <!-- option for video -->
<!--                    <input type="hidden" name="is-video[]" value="no" />-->
<!--                    <label class="checkbox-inline ultra-label"><input type="checkbox" class="form-check-input" value="yes" id="is-video[]" name="is-video[]">Video</label>-->
                    <!-- option for default video image -->
<!--                    <input type="hidden" name="set-default[]" value="no-default" />-->
<!--                    <label class="checkbox-inline  initial-hidden ultra-label"><input type="checkbox" class="form-check-input" value="default" name="set-default[]" id="set-default[]">Video Default Image</label>-->
                </div>
            </li>
			<?php
		}


		public function _ajax_slide() {
			echo $this->_ajax_callback_function($_POST['slideId']);
			die;
		}



		public function _save_settings($post_id) {



            if ( isset( $_POST['clktusg-save-settings'] ) == "save-settings" && isset($_POST['slide-ids'])) {

				$clktusg_slider_width	            =	 sanitize_text_field($_POST['width']);
				$clktusg_slider_height	            =	 sanitize_text_field($_POST['height']);
				$clktusg_slider_transition_duration =   sanitize_text_field($_POST['transition-duration']);
				$clktusg_slider_nav_width           =   sanitize_text_field($_POST['nav-width']);
				$clktusg_slider_nav_style           =   filter_var($_POST['nav-style'],FILTER_SANITIZE_STRING);
				$clktusg_slider_fullscreen          =   filter_var($_POST['fullscreen'],FILTER_SANITIZE_STRING);
				$clktusg_slider_fit_slides          =   filter_var($_POST['fit-slides'],FILTER_SANITIZE_STRING);
				$clktusg_slider_slide_text          =   filter_var($_POST['slide-text'],FILTER_SANITIZE_STRING);
				$clktusg_slider_autoplay            =   filter_var($_POST['autoplay'],FILTER_SANITIZE_STRING);
				$clktusg_slider_loop                =   filter_var($_POST['loop'],FILTER_SANITIZE_STRING);
				$clktusg_slider_nav_arrow           =   filter_var($_POST['nav-arrow'],FILTER_SANITIZE_STRING);
//				$clktusg_slider_touch_slide         =   filter_var($_POST['touch-slide'],FILTER_SANITIZE_STRING);
				$clktusg_slider_spinner             =   filter_var($_POST['spinner'],FILTER_SANITIZE_STRING);
//				$clktusg_slider_direction           =   filter_var($_POST['direction'],FILTER_SANITIZE_STRING);
	            $clktusg_slide_interval             =   sanitize_text_field($_POST['slide-interval']);
	            $clktusg_slider_transition_effect   =   filter_var($_POST['trans-style'],FILTER_SANITIZE_STRING);


	            $clktusg_slider_setting =  serialize(array(
					'clktusg_slider_width'  			    => 	$clktusg_slider_width,
					'clktusg_slider_height'  			    => 	$clktusg_slider_height,
					'clktusg_slider_transition_duration'  	=> 	$clktusg_slider_transition_duration,
					'clktusg_slider_nav_width'  			=> 	$clktusg_slider_nav_width,
					'clktusg_slider_nav_style'  			=> 	$clktusg_slider_nav_style,
					'clktusg_slider_fullscreen'  			=> 	$clktusg_slider_fullscreen,
					'clktusg_slider_fit_slides'  			=> 	$clktusg_slider_fit_slides,
					'clktusg_slider_slide_text'  			=> 	$clktusg_slider_slide_text,
					'clktusg_slider_autoplay'  			    => 	$clktusg_slider_autoplay,
					'clktusg_slider_loop'  			        => 	$clktusg_slider_loop,
					'clktusg_slider_nav_arrow'  			=> 	$clktusg_slider_nav_arrow,
//					'clktusg_slider_touch_slide'  			=> 	$clktusg_slider_touch_slide,
					'clktusg_slider_spinner'  			    => 	$clktusg_slider_spinner,
//					'clktusg_slider_direction'  			=> 	$clktusg_slider_direction,
                    'clktusg_slide_interval'                =>  $clktusg_slide_interval,
                    'clktusg_slider_transition_effect'      =>  $clktusg_slider_transition_effect
                    ));


	                $imagesArray = array();
	                $total_slides = count( $_POST['slide-ids'] );
	                if($total_slides>0) {
		                for($i=0; $i < $total_slides; $i++) {
			                $images_id          = $_POST['slide-ids'][$i];
			                $image_title        =stripslashes(sanitize_text_field($_POST['slide-title'][$i]));
			                $image_desc         = stripslashes(sanitize_text_field($_POST['slide-desc'][$i]));
//			                $video_url          = stripslashes(sanitize_text_field($_POST['slide-video'][$i]));
//			                $slide_is_video     = $isVideoArray[$i];
//			                $use_default_imgae  = $defaultVideoImage[$i];

			                $imagesArray[] = array(
				                'clktusg_slider_id' => $images_id,
				                'clktusg_slider_title' => $image_title,
				                'clktusg_slider_desc' => $image_desc,
//                                'clktusg_video_url' => $video_url,
//                                'clktusg_slide_is_video' => $slide_is_video,
//                                'clktusg_use_default_imgae' => $use_default_imgae


			                );
		                }
	                }
//	                var_dump($imagesArray);
//	                exit;

                $clktusg_slider_slides = "clktusg_slider_slides_".$post_id;
                update_post_meta($post_id, $clktusg_slider_slides, base64_encode(serialize($imagesArray)));

				$clktusg_slider_shortcode_setting = "clktusg_slider_settings_".$post_id;
				update_post_meta($post_id, $clktusg_slider_shortcode_setting, $clktusg_slider_setting);

			}

//			else{
//			    echo "Your post cannot be saved due to security check.";
//            }
		}// end save setting

		/**
		 *  Ultra Responsive Slider Docs Page
		 * Create doc page to help user to setup plugin
		 * @access    private
		 * @return    void.
		 */
		public function _clktusg_gallery_doc_page() {
			require_once( 'includes/Clkt-docs.php' );
		}
		public function _clktusg_gallery_featured_plugin_page() {
			require_once('');
		}
		
		public function _rs_upgrade_plugin_page() {
			require_once('');
		}




	} // end of class

	/**
	 * Instantiates the Class
	 * @global    object	$rs_gallery_object
	 */
	$clktusg_gallery_object = new Clkt_Ultra_Responsive_Slider();
	require_once( 'includes/Clkt-shortcode.php' );
} // end of if class exists
?>