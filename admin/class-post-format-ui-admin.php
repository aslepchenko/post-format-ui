<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/alexander-slepchenko
 * @since      1.0.0
 *
 * @package    Post_Format_Ui
 * @subpackage Post_Format_Ui/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Format_Ui
 * @subpackage Post_Format_Ui/admin
 * @author     Slepchenko Alexander <alexsandr.s1992@gmail.com>
 */
class Post_Format_Ui_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-format-ui-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-format-ui-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
      		$this->plugin_name,
      		'pfui',
      		array(
      		  'media_title'  => __('Gallery Images', 'pfui'),
      		  'media_button' => __('Add Image(s)', 'pfui')
      		)
    	);

	}

	/**
   	 * Registers the meta boxes.
   	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_register_meta_boxes() {
      		
      	add_meta_box(
        	'pfui-gallery',
        	__( 'Gallery Settings', 'pfui' ),
        	array( $this, 'pfui_display_gallery' ),
        	'post'
      	);
    	add_meta_box(
        	'pfui-video',
        	__( 'Video Settings', 'pfui' ),
        	array( $this, 'pfui_display_video' ),
        	'post'
      	);
    	add_meta_box(
        	'pfui-audio',
        	__( 'Audio Settings', 'pfui' ),
        	array( $this, 'pfui_display_audio' ),
        	'post'
      	);
  	}

  	/**
  	 * Include gallery template to display in admin
  	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_display_gallery( $post ) {
  		include('partials/format-gallery.php');
  	}

  	/**
  	 * Include video template to display in admin
  	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_display_video( $post ) {
  		include('partials/format-video.php');
  	}

    /**
  	 * Include audio template to display in admin
  	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_display_audio( $post ) {
  		include('partials/format-audio.php');
  	}

  	/**
  	 * Save gallery data
  	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_save_gallery( $post_id ){

   		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      		return;
    	}
    
    	if ( ! isset( $_REQUEST['pfui_gallery_field'] ) ) {
      		return;
    	}
      	if( $_REQUEST['pfui_gallery_field'] !== '' ) {
        	$images = explode(',', $_REQUEST['pfui_gallery_field']);
      	} else {
        	$images = array();
      	}
    
    	update_post_meta( $post_id, '_pfui_gallery', $images );
    
	}


	/**
  	 * Save video data
  	 *
     * @since    1.0.0
     */
  	public function pfui_save_video( $post_id ){

   		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      		return;
    	}
    
    	if ( ! isset( $_REQUEST['pfui_video_field'] ) ) {
      		return;
    	}
    
    	update_post_meta( $post_id, '_pfui_video', sanitize_text_field( $_REQUEST['pfui_video_field']) );
    
	}

	/**
  	 * Save audio data
  	 *
  	 * @since    1.0.0
  	 */
  	public function pfui_save_audio( $post_id ){

   		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      		return;
    	}
    
    	if ( ! isset( $_REQUEST['pfui_audio_field'] ) ) {
      		return;
    	}
    
    	update_post_meta( $post_id, '_pfui_audio', sanitize_text_field( $_REQUEST['pfui_audio_field']) );
    
	}

}
