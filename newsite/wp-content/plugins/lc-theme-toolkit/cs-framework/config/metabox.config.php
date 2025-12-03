<?php if ( ! defined( 'ABSPATH' ) ) { die; }

$meta_boxes      = array();

$meta_boxes[]    = array(
  'id'        => '_hero_section',
  'title'     => 'Hero Section',
  'post_type' => 'page',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(
    array(
      'name'      => '',
      'fields' => array(
        array(
          'id'    => 'hero_image',
          'type'  => 'image',
          'title' => 'Hero Image'
        ),
        array(
          'id'    => 'hero_text1',
          'type'  => 'text',
          'title' => 'Hero Text1'
        ),
        array(
          'id'    => 'hero_text2',
          'type'  => 'text',
          'title' => 'Hero Text2'
        )
      )
    )
  )
);
$meta_boxes[]    = array(
  'id'        => '_cover_style_info',
  'title'     => 'Cover style and info',
  'post_type' => 'portfolio',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(
    array(
      'name'      => '',
      'fields' => array(
        array(
          'id'             => 'cover_style',
          'type'           => 'select',
          'title'          => 'Cover style',
          'options'        => array(
            '1'          => 'Thumbnail with overlay title',
            '2'     => 'Thumbnail without overlay title'
          )
        ),
        array(
          'id'    => 'text_above_portfolio_title',
          'type'  => 'text',
          'title' => 'Text above portfolio title'
        ),
        array(
          'id'    => 'client_title',
          'type'  => 'text',
          'title' => 'Client title'
        ),
        array(
          'id'    => 'client_name',
          'type'  => 'text',
          'title' => 'Client name'
        ),
        array(
          'id'    => 'year_title',
          'type'  => 'text',
          'title' => 'Year title'
        ),
        array(
          'id'    => 'year',
          'type'  => 'text',
          'title' => 'Year'
        ),
        array(
          'id'    => 'category_title',
          'type'  => 'text',
          'title' => 'Category title'
        ),
        array(
          'id'    => 'button_text',
          'type'  => 'text',
          'title' => 'Button text'
        ),
        array(
          'id'    => 'button_url',
          'type'  => 'text',
          'title' => 'Button url'
        )
      )
    )
  )
);
CSFramework_Metabox::instance( $meta_boxes );