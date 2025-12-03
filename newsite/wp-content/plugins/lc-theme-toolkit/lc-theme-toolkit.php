<?php
/**
Plugin Name: LC Theme Toolkit
Plugin URI: http://lion-coders.com/
Description: Plugin for portfolio post type, theme options, demo importer, elementor addon and Social Share..
Version: 1.0
Author: LionCoders
Author URI: http://lion-coders.com/
*/

if( ! defined( 'ABSPATH' ) ) exit;

if(!class_exists('lcThemeToolkit')) {
	class lcThemeToolkit {
		public function __construct() {
			add_action('plugins_loaded', array($this, 'lc_theme_tollkit_load'));
		}
		public function lc_theme_tollkit_load() {
			if ( !function_exists( 'lc_theme_tollkit_data' ) ) {
				function lc_theme_tollkit_data() {
					register_post_type( 'portfolio', array(
						'labels'			=>	array(
							'name'			=>	'Portfolio'
						),
						'public'			=>	true,
						'supports'			=>	array( 'title', 'thumbnail', 'editor' ),
						'menu_icon'			=>	'dashicons-portfolio',
						'show_in_rest'		=>	true
					) );
					register_taxonomy( 'portfolio-category', 'portfolio', array(
						'show_admin_column' =>  true,
						'hierarchical'		=>	true,
						'show_in_rest'		=>	true
					) );
					//enable by default Elementor for custom post type
				    //if exists, assign to $cpt_support var
					$cpt_support = get_option( 'elementor_cpt_support' );
					//check if option DOESN'T exist in db
					if( ! $cpt_support ) {
					    $cpt_support = [ 'page', 'post', 'portfolio' ]; 
					    update_option( 'elementor_cpt_support', $cpt_support );
					}
					//if it DOES exist, but portfolio is NOT defined
					else if( ! in_array( 'portfolio', $cpt_support ) ) {
					    $cpt_support[] = 'portfolio';
					    update_option( 'elementor_cpt_support', $cpt_support );
					}
				}
				add_action('init', 'lc_theme_tollkit_data');
			}

			//demo import customize
			function lc_demo_import_page_setup( $default_settings ) {
				$default_settings['menu_slug']   = 'lc-one-click-demo-import';
				return $default_settings;
			}
			add_filter( 'pt-ocdi/plugin_page_setup', 'lc_demo_import_page_setup' );

			function lc_import_files() {
				return array(
					array(
						'import_file_name'             => 'Demo Import',
						'local_import_file'            => plugin_dir_path( __FILE__ ) . 'one-click-demo-import/demo-data/content.xml',
						'local_import_cs'              => array(
					        array(
					          'file_path'   => plugin_dir_path( __FILE__ ) . 'one-click-demo-import/demo-data/cs-data.txt',
					          'option_name' => '_cs_options',
					        )
			     		),
						'import_preview_image_url'     => plugins_url( '/one-click-demo-import/demo-data/preview.jpg', __FILE__ ),
						'preview_url'                  => 'http://demo.lion-coders.com/wp/roph',
					)
				);
			}
			add_filter( 'pt-ocdi/import_files', 'lc_import_files' );

			add_filter( 'pt-ocdi/enable_grid_layout_import_popup_confirmation', '__return_false' );

			add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

			function lc_after_import_setup() {
				// Assign menus to their locations.
				$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
					)
				);

				// Assign front page and posts page (blog page).
				$front_page_id = get_page_by_title( 'Home1' );
				$blog_page_id  = get_page_by_title( 'Blog' );

				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page_id->ID );
				update_option( 'page_for_posts', $blog_page_id->ID );

			}
			add_action( 'pt-ocdi/after_import', 'lc_after_import_setup' );
			//demo import customize
		}
	}
}
$lc_theme_tollkit = new lcThemeToolkit();
//cs-framework
include_once( 'cs-framework/cs-framework.php' );
//elementor
include_once( 'lc-elementor/lc-elementor.php' );
//demo importer
include_once( 'one-click-demo-import/one-click-demo-import.php' );
include_once( 'one-click-demo-import/cs-data-importer.php' );
