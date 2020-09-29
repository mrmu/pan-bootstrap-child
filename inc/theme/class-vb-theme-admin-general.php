<?php
/**
 * Admin general Initialization
 *
 * @package     pan-bootstrap-child
 * @since       0.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'VB_Theme_Admin_General' ) ) {

	class VB_Theme_Admin_General {

		private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {
            // enqueue styles & scripts
            add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_styles' ));
            add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts' ));
        }

        private function is_enqueue_pages($apply_pages, $hook, $post_type) {
            foreach ($apply_pages as $pg => $pts) {
                if ($pg === $hook) {
                    if (!empty($pts) && is_array($pts)) {
                        if (in_array($post_type, $pts)) {
                            return true;
                        }
                    }
                    return true;
                }else if ($pts === $hook) {
                    return true;
                }
            }
            return false;
        }
        
        public function admin_enqueue_styles($hook) {
            global $post, $post_type;

            if (empty($post_type)){
                if (!empty($post)) {
                    $post_type = $post->post_type;
                }
            }
        
            $load_post_types = array( 'post' );
            $apply_pages = array(
                'post-new.php' => $load_post_types, 
                'edit.php' => $load_post_types,
                'post.php' => $load_post_types,
                // $hook
            );
        
            // echo 'hook:['.$hook.'] ';
            // echo 'post_type:['.$post_type.'] ';

            if ( $this->is_enqueue_pages($apply_pages, $hook, $post_type) ) {
                // wp_enqueue_style( 
                //     'theme_admin_css', 
                //     VB_THEME_URI . '/dist/theme-admin.min.css', 
                //     array(), 
                //     filemtime( VB_THEME_DIR . '/dist/theme-admin.min.css' ),
                //     'all'
                // );
            }
        }
        
        public function admin_enqueue_scripts($hook) {
            global $post, $post_type;
            if (empty($post_type)){
                if (!empty($post)) {
                    $post_type = $post->post_type;
                }
            }
        
            $load_post_types = array( 'post' );
            $apply_pages = array(
                'post-new.php' => $load_post_types, 
                'edit.php' => $load_post_types,
                'post.php' => $load_post_types,
                // $hook
            );

            // echo 'hook:['.$hook.'] ';
            // echo 'post_type:['.$post_type.'] ';
        
            if ( $this->is_enqueue_pages($apply_pages, $hook, $post_type) ) {
                // wp_register_script(
                //     'theme_admin_js', 
                //     VB_THEME_URI . '/dist/theme-admin.min.js', 
                //     array('jquery'), 
                //     filemtime( VB_THEME_DIR . '/dist/theme-admin.min.js' ),
                //     true
                // );
                // wp_enqueue_script('theme_admin_js');
                // wp_localize_script(
                //     'theme_admin_js', 
                //     'theme_admin_obj', 
                //     array( 
                //         'ajax_url' => admin_url( 'admin-ajax.php' )
                //     )
                // );	
            }
        }

    }
}

VB_Theme_Admin_General::get_instance();