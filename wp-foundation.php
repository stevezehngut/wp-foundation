<?php
/**
 * @package WP Foundation
 * @version 0.1
 */
/*
Plugin Name: WP Foundation
Plugin URI: http://wordpress.org/plugins/wp-foundation/
Description: This plugin adds Foundaiton to your WordPress theme.
Author: Steve Zehngut
Version: 0.1
Author URI: http://zengy.com
*/

/* Enqueue Foundation CSS and JS */

DEFINE( 'FOUNDATION_VERSION', '5.2.1' );

function foundation_enqueue_scripts() {
	
	$style_array = foundation_get_styles();

	/* Add Foundation CSS */

	wp_enqueue_style( 
		'foundation-normalize-css', 
		plugins_url( '/foundation-' . FOUNDATION_VERSION . '/css/normalize.css', __FILE__ ),
		$style_array
	);

	wp_enqueue_style( 
		'foundation-css', 
		plugins_url( '/foundation-' . FOUNDATION_VERSION . '/css/foundation.css', __FILE__ ),
		$style_array
	);

	/* Add Foundation JS */

	wp_enqueue_script( 
		'foundation-js', 
		plugins_url( '/foundation-' . FOUNDATION_VERSION . '/js/foundation.min.js', __FILE__ ), 
		array( 'jquery' ), 
		'5', 
		true
	);

	/* Add custom CSS */

	wp_enqueue_style( 
		'custom-style', 
		get_stylesheet_directory_uri() . '/custom.css', 
		'', 
		'2'
	);

}

add_action( 'wp_enqueue_scripts', 'foundation_enqueue_scripts', 11 );

/* Add Foundation footer */

function foundation_add_footer(){
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(document).foundation();
		});
	</script>
	<?php
}

add_filter('wp_footer','foundation_add_footer');

/* Get loaded styles */

function foundation_get_styles() {
    global $wp_styles;
    $style_array = array();
    foreach( $wp_styles->queue as $style_name ) {
    	$style_array[] = $style_name;
    }
    return $style_array;
}

?>