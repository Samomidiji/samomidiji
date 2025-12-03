<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>
    <div id="loading" class="in">
        <div class="spinner">
            <!-- Mask of the quarter of circle -->
            <div class="mask">
                <!-- Inner masked circle -->
                <div class="maskedCircle"></div>
            </div>
        </div>
    </div>
    <!-- Header -->
    <header id="header" class="scroll-hide transparent">
        <div class="header-wrapper">
            <div class="container">
				
                <div id="logo">
                    <a class="ajax-link" href="<?php echo esc_url(home_url( '/' )); ?>">
                        <?php if ( has_custom_logo() ) : ?>
                        <img src="<?php $custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ); echo esc_url( $custom_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"/>
                        <?php else : ?>
                        <?php echo esc_html( get_bloginfo('name') ); ?>
                        <?php endif; ?> 
                    </a>
                </div>
                <?php if ( has_nav_menu( 'main-menu' ) ) : ?>
                <nav>
                    <div class="menu-button menu-open">
                        <span></span>
                        <span></span>
                    </div>
                    <?php
                    echo str_replace('<a', '<a class="ajax-link"', wp_nav_menu(array(
                        'theme_location'  =>  'main-menu',
                        'menu_class'       =>  'flexnav standard',
                        'items_wrap' => '<ul data-breakpoint="1024" id="%1$s" class="%2$s">%3$s</ul>',
                        'container'       =>  false,
                        'echo'  => 0
                    ))); ?>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <!-- Header Ends -->