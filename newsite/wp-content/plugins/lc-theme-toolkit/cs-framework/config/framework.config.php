<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => 'Theme options',
  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'theme-options',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => 'Theme options',
);

$options        = array();

$options[]      = array(
  'name'        => 'custom_cursor_disable',
  'title'       => 'Custom cursor disable',
  'icon'        => 'fa fa-mouse-pointer',
  'fields'      => array(
    array(
      'id'        => 'custom_cursor_disable',
      'type'      => 'switcher',
      'title'     => 'Custom cursor disable'
    )
  )
);

$options[]      = array(
  'name'        => 'sidebar',
  'title'       => 'Sidebar',
  'icon'        => 'fa fa-columns',
  'fields'      => array(
    array(
      'id'        => 'sidebar',
      'type'      => 'switcher',
      'title'     => 'Sidebar',
      'desc'      => 'Sidebar is displayed in blog and blog single page.'
    )
  )
);

$options[]      = array(
  'name'        => 'social_links',
  'title'       => 'Social links',
  'icon'        => 'fa fa-link',
  'fields'      => array(
    array(
      'id'              => 'social_links_options',
      'type'            => 'group',
      'title'           => 'Social links options',
      'desc'            => 'Define and reorder the social icons however you want.',
      'button_title'    => 'Add new',
      'accordion_title' => 'Social link',
      'fields'          => array(
        array(
          'id'    => 'social_name',
          'type'  => 'text',
          'title' => 'Social name',
        ),
        array(
          'id'    => 'social_url',
          'type'  => 'text',
          'title' => 'Social url',
        )
      )
    )
  )
);

$options[]      = array(
  'name'        => 'social_share',
  'title'       => 'Social share',
  'icon'        => 'fa fa-share-alt-square',
  'fields'      => array(
    array(
      'id'             => 'social-share-options',
      'type'           => 'sorter',
      'title'          => 'Social share options',
      'desc'           => 'Share options are displayed under the single post and portfolio.',
      'default'        => array(
        'disabled'     => array(
          'facebook'   => '<i class=\'fa fa-facebook\'></i> Facebook',
          'twitter'    => '<i class=\'fa fa-twitter\'></i> Twitter',
          'pinterest'  => '<i class=\'fa fa-pinterest\'></i> Pinterest'
        )
      ),
      'enabled_title'  => 'Enable',
      'disabled_title' => 'Disable'
    )   
  )
);

$options[]      = array(
  'name'        => 'portfolio_navigation',
  'title'       => 'Portfolio navigation',
  'icon'        => 'fa fa-angle-double-right',
  'fields'      => array(
    array(
      'id'        => 'portfolio_navigation',
      'type'      => 'select',
      'title'     => 'Portfolio navigation',
      'options'    => array(
        '0'      => 'None',
        '1'      => 'Style 1',
        '2'      => 'Style 2',
        '3'      => 'Style 3'
      )
    ),
    array(
      'id'    => 'previous_title',
      'type'  => 'text',
      'title' => 'Previous title',
      'dependency'   => array( 'portfolio_navigation', '==', '3' ),
    ),
    array(
      'id'    => 'next_title',
      'type'  => 'text',
      'title' => 'Next title',
      'dependency'   => array( 'portfolio_navigation', '!=', '0' )
    )
  )
);

$options[]      = array(
  'name'        => 'copyright_text',
  'title'       => 'Copyright text',
  'icon'        => 'fa fa-copyright',
  'fields'      => array(
    array(
      	'id'        => 'copyright_text',
      	'type'      => 'wysiwyg',
      	'title'     => 'Copyright text',
      	'settings' => array(
    		'media_buttons' => false
    	)     
    )
  )
);

$options[]      = array(
  'name'        => '404_page',
  'title'       => '404 page',
  'icon'        => 'fa fa-thumbs-down',
  'fields'      => array(
    array(
      'id'        => '404_background_image',
      'type'      => 'image',
      'title'     => '404 background image'
    ),
    array(
      'id'    => '404_title',
      'type'  => 'text',
      'title' => '404 title'
    ),
    array(
      'id'    => '404_description',
      'type'  => 'text',
      'title' => '404 description'
    ),
    array(
      'id'    => '404_button_text',
      'type'  => 'text',
      'title' => '404 button text'
    )
  )
);

CSFramework::instance( $settings, $options );
