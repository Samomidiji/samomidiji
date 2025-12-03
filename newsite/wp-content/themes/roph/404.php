<?php get_header(); ?>
        <!-- Content Wrapper -->
        <div id="main">
            <div id="hero" class="hero not-found parallax-background">
                <div class="parallax-inner" style="background-image: url(<?php echo class_exists('lcThemeToolkit') ? esc_url(wp_get_attachment_image_src( cs_get_option( '404_background_image' ), 'full' )[0]) : get_template_directory_uri().'/images/404.jpg' ?>);">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12">
                            <div class="page-title text-center">
                                <h1>
                                <?php 
                                if (class_exists('lcThemeToolkit')) {
                                    echo esc_html( cs_get_option( '404_title' ) );
                                } else {
                                    echo esc_html__('404', 'roph');
                                }
                                ?>
                                </h1>
                                <p class="h4">
                                <?php 
                                if (class_exists('lcThemeToolkit')) {
                                    echo esc_html( cs_get_option( '404_description' ) );
                                } else {
                                    echo esc_html__('Something went wrong!', 'roph');
                                }
                                ?>      
                                </p>
                                <?php if (!class_exists('lcThemeToolkit')): ?>
                                <p><?php echo esc_html__('We can\'t find the page you are looking for. Let\'s take you to home.', 'roph'); ?></p>    
                                <?php endif ?>
                                <a href="<?php echo esc_url(home_url( '/' )); ?>" class="button">
                                <?php 
                                if (class_exists('lcThemeToolkit')) {
                                    echo esc_html( cs_get_option( '404_button_text' ) );
                                } else {
                                    echo esc_html__('Home', 'roph');
                                }
                                ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Wrapper Ends -->
<?php get_footer(); ?>
