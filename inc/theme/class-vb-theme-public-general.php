<?php
/**
 * Public general Initialization
 *
 * @package     pan-bootstrap-child
 * @since       0.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'VB_Theme_Public_General' ) ) {

	class VB_Theme_Public_General {

        private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {
            // enqueue styles & scripts
            add_action( 'wp_enqueue_scripts', array($this, 'public_enqueue_styles' ), 10);
            add_action( 'wp_enqueue_scripts', array($this, 'public_enqueue_scripts' ), 20);

            // embeded code
            add_action( 'wp_head', array($this, 'add_js_code_to_head'), 99);
            add_action( 'wp_body_open', array($this, 'add_js_code_to_body'), 99);

            add_action( 'init', array($this, 'init_theme'), 1 );
        }

        public function init_theme() {
            // ACF Pro
            if( function_exists('acf_add_options_page') ) {
                acf_add_options_page(array(
                    'page_title' 	=> '佈景設定',
                    'menu_title'	=> '佈景設定',
                    'menu_slug' 	=> 'theme-general-settings',
                    'capability'	=> 'manage_options',
                    'redirect'		=> false
                ));
            }
        }

        public function public_enqueue_scripts() 
        {
            $src_dir = VB_THEME_DIR . 'src/';
            $dist_dir = VB_THEME_DIR . 'dist/';
        
            $site_lang = substr(strtolower(get_locale()), 0, 2); //site lang

            // Conditional script(s)
            if (is_home() || is_front_page()) {
                // remove Parent assets
                wp_deregister_script( 'home_js' );
                wp_dequeue_script( 'home_js' );

                // reg Child assets
                wp_register_script(
                    'home_js', 
                    VB_THEME_URI . 'dist/home.min.js', 
                    array('jquery'), 
                    filemtime( $dist_dir . 'home.min.js' ),
                    true
                );
                wp_enqueue_script('home_js');
                wp_localize_script(
                    'home_js', 
                    'home_obj', 
                    array( 
                        'ajax_url' => admin_url( 'admin-ajax.php' )
                    )
                );	
            }elseif (is_singular()) {
                global $post;
                // remove Parent assets
                wp_deregister_script( 'single_js' );
                wp_dequeue_script( 'single_js' );

                // reg Child assets
                wp_register_script(
                    'single_js', 
                    VB_THEME_URI . 'dist/single.min.js', 
                    array('jquery'), 
                    filemtime( $dist_dir . 'single.min.js' ),
                    true
                );
                wp_enqueue_script('single_js');
                wp_localize_script(
                    'single_js', 
                    'single_obj', 
                    array( 
                        'ajax_url' => admin_url( 'admin-ajax.php' ),
                        'i18n' => array(
                            'name_is_required' => __('Name is required', 'pan-bootstrap'),
                            'email_is_required' => __('Email is required', 'pan-bootstrap'),
                            'comment_is_required' => __('Comment is required', 'pan-bootstrap')
                        )
                    )
                );		
            }elseif (is_search() || is_archive()) {
                // remove Parent assets
                wp_deregister_script( 'archive_js' );
                wp_dequeue_script( 'archive_js' );

                // reg Child assets
                wp_register_script(
                    'archive_js', 
                    VB_THEME_URI . 'dist/archive.min.js', 
                    array('jquery'), 
                    filemtime( $dist_dir . 'archive.min.js' ),
                    true
                ); 
                wp_enqueue_script('archive_js');
                wp_localize_script(
                    'archive_js', 
                    'arch_obj', 
                    array( 
                        's' => get_search_query(),
                        'ajax_url' => admin_url( 'admin-ajax.php' )
                    )
                );	
            }else{
                // remove Parent assets
                wp_deregister_script( 'archive_js' );
                wp_dequeue_script( 'archive_js' );

                // reg Child assets
                wp_register_script(
                    'archive_js', 
                    VB_THEME_URI . 'dist/archive.min.js', 
                    array('jquery'), 
                    filemtime( $dist_dir . 'archive.min.js' ),
                    true
                ); 
                wp_enqueue_script('archive_js');
                wp_localize_script(
                    'archive_js', 
                    'arch_obj', 
                    array( 
                        's' => get_search_query(),
                        'ajax_url' => admin_url( 'admin-ajax.php' )
                    )
                );	
            }
        }
        
        public function public_enqueue_styles() {
        
            $dist_dir = VB_THEME_DIR . 'dist/';
        
            if (!is_admin()) {
                wp_dequeue_style( 'wp-block-library' );
            }
        
            if (is_home() || is_front_page()) {
                wp_enqueue_style( 
                    'home_styles', 
                    VB_THEME_URI . 'dist/home.min.css', 
                    array(), 
                    filemtime( $dist_dir . 'home.min.css' ),
                    'all'
                );
            }elseif (is_singular()) {
                wp_enqueue_style( 
                    'single_styles', 
                    VB_THEME_URI . 'dist/single.min.css', 
                    array(), 
                    filemtime( $dist_dir . 'single.min.css' ),
                    'all'
                );
            }elseif (is_search() || is_archive()) {
                wp_enqueue_style( 
                    'archive_styles', 
                    VB_THEME_URI . 'dist/archive.min.css', 
                    array(), 
                    filemtime( $dist_dir . 'archive.min.css' ),
                    'all'
                );
            }else{
                wp_enqueue_style( 
                    'archive_styles', 
                    VB_THEME_URI . 'dist/archive.min.css', 
                    array(), 
                    filemtime( $dist_dir . 'archive.min.css' ),
                    'all'
                );
            }
        
        }

        // JS in head
        public function add_js_code_to_head() {

            $embed_code_head = '<!-- js in head -->';
            if ( function_exists('get_field') ) {
                $embed_code_head .= get_field('embed_code_head', 'option');
            }
            if (!empty($embed_code_head)) {
                echo $embed_code_head;
            }
        }

        // JS in body open
        public function add_js_code_to_body() {
            $embed_code_body = '<!-- js in body -->';
            if ( function_exists('get_field') ) {
                $embed_code_body .= get_field('embed_code_body', 'option');
            }
            if (!empty($embed_code_body)) {
                echo $embed_code_body;
            }
        }
    }
}

VB_Theme_Public_General::get_instance();