<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pan-bootstrap-child
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Define Constants */

define( 'VB_THEME_VERSION', '0.1.0' );
define( 'VB_THEME_DIR', trailingslashit( get_theme_file_path() ) );
define( 'VB_THEME_URI', trailingslashit( esc_url( get_stylesheet_directory_uri() ) ) );

/* Theme / Admin */
require_once VB_THEME_DIR . 'inc/theme/class-vb-theme-admin-general.php';

/* Theme / Public */
require_once VB_THEME_DIR . 'inc/theme/class-vb-theme-public-general.php';
