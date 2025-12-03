<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function lc_elementor_preview_scripts(){
    wp_enqueue_script( 'lc-elementor-preview-scripts',  plugin_dir_url( __FILE__ ) . 'js/lc-elementor-preview-scripts.js', array('jquery'), '', true);
}
add_action('elementor/preview/enqueue_scripts', 'lc_elementor_preview_scripts');

function lc_elementor_init(){
    Elementor\Plugin::instance()->elements_manager->add_category(
        'lc-elementor',
        [
            'title'  => 'Roph Elements',
            'icon' => 'apps'
        ]
    );
}
add_action('elementor/init','lc_elementor_init');

function add_new_widgets(){
  require_once plugin_dir_path( __FILE__ ).'lc-text-content1.php';
  require_once plugin_dir_path( __FILE__ ).'lc-text-content2.php';
  require_once plugin_dir_path( __FILE__ ).'lc-team.php';
  require_once plugin_dir_path( __FILE__ ).'lc-client.php';
  require_once plugin_dir_path( __FILE__ ).'lc-parallax-background.php';
  require_once plugin_dir_path( __FILE__ ).'lc-slider.php';
  require_once plugin_dir_path( __FILE__ ).'lc-video.php';
  require_once plugin_dir_path( __FILE__ ).'lc-portfolio.php';
  require_once plugin_dir_path( __FILE__ ).'lc-contact.php';
  require_once plugin_dir_path( __FILE__ ).'lc-map.php';
  require_once plugin_dir_path( __FILE__ ).'lc-gap.php';
}
add_action('elementor/widgets/widgets_registered','add_new_widgets');