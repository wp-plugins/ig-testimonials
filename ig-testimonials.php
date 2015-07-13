<?php
/**
 * Plugin Name:IG Testimonials
 * Plugin URI: http://www.iograficathemes.com/downloads/ig-testimonials
 * Description: IG Testimonials is a clean and simply WordPress plugin for adding Testimonials to your theme, using a shortcode or a widget.
 * Version: 1.0
 * Author: iografica
 * Author URI: http://www.iograficathemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/* Variables */
$ig_testimonials_name = "IG Testimonials";

/* Includes */
        include ('includes/ig-testimonials-post-type.php');
        include ('includes/ig-testimonials-settings.php');
        include ('includes/ig-testimonials-function.php');
        include ('extra/ig-testimonials-carousel-widget.php');
        include ('extra/ig-testimonials-shortcodes.php');

/****
Load plugin textdomain
****/
function ig_testimonials_load_textdomain() {
  load_plugin_textdomain( 'ig-testimonials', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'ig_testimonials_load_textdomain' );

/* Add testimonials scripts file */
function ig_testimonials_scripts() {
        wp_enqueue_style('ig-stestimonials-style', plugins_url( 'css/ig-testimonials.css', __FILE__ ) );
    $options = get_option('ig_testimonials_settings');
    if ( 0 == isset($options['ig_testimonials_checkbox_disable_script_style'])) {
        wp_enqueue_style('owl-carousel-style', plugins_url( 'css/owl-carousel.css', __FILE__ ) );
        wp_register_script('owl-carousel', plugins_url( 'js/owl-carousel.js', __FILE__ ), array('jquery'),'2.0.0',true );
        wp_enqueue_script( 'owl-carousel' );
    }
        wp_register_script('ig-testimonials-carousel', plugins_url( 'js/ig-testimonials-main.js', __FILE__ ), array('jquery'),'',true );
        wp_enqueue_script( 'ig-testimonials-carousel' );
}
add_action( 'wp_enqueue_scripts', 'ig_testimonials_scripts' );

// Hooks your functions into the correct filters
function ig_testimonials_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'ig_testimonials_tinymce_plugin' );
        add_filter( 'mce_buttons', 'ig_testimonials_register_mce_button' );
    }
}
add_action('admin_head', 'ig_testimonials_mce_button');

// Declare script for new button
function ig_testimonials_tinymce_plugin( $plugin_array ) {
    $plugin_array['ig_testimonials_mce_button'] = plugins_url('/includes/mce-button.js', __FILE__);
    return $plugin_array;
}

// Register new button in the editor
function ig_testimonials_register_mce_button( $buttons ) {
    array_push( $buttons, 'ig_testimonials_mce_button' );
    return $buttons;
}
