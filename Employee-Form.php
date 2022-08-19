<?php
/**
 * Plugin Name: Employee Form
 * Description: Made for Safdar Ali.
 * Version: 1.1.1.0
 * Author: Safdar
 * Author URI: https://muhammadsafdarali.com/
 * Text Domain: Employee-Form
 *
 * @package Employee-Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'EF_PLUGIN_DIR' ) ) {
	define( 'EF_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'EF_PLUGIN_DIR_URL' ) ) {
	define( 'EF_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'EF_ABSPATH' ) ) {
	define( 'EF_ABSPATH', dirname( __FILE__ ) );
}
	require_once EF_ABSPATH . '/includes/Class-EF-Loader.php';

