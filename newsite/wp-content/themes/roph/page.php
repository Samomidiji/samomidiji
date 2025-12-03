<?php 
    get_header();
    $hero_section = get_post_meta( get_the_ID(), '_hero_section', true );
?>
        <!-- Content Wrapper -->
        <div id="main">
            <!-- Hero Section -->
            <div id="hero" class="hero" <?php if (class_exists('lcThemeToolkit') && isset($hero_section['hero_image'])): ?> style="background: url(<?php echo esc_url(wp_get_attachment_image_src( $hero_section['hero_image'], 'full' )[0]) ?>)"<?php endif ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12">
                            <?php 
                            $hero_text1 = (class_exists('lcThemeToolkit') && isset($hero_section['hero_text1'])) ? $hero_section['hero_text1'] : '';
                            $hero_text2 = (class_exists('lcThemeToolkit') && isset($hero_section['hero_text2'])) ? $hero_section['hero_text2'] : '';
                            if (!$hero_text1 && !$hero_text2) {
                                $hero_text2 = get_the_title();
                            }
                            ?>
                            <div class="page-title">
                                <?php if ($hero_text1): ?>
                                <span><?php echo esc_html($hero_text1) ?></span>
                                <?php endif ?>
                                <h1 class="textFadeUp <?php echo $hero_text1 ? '' : 'no-mar-left' ?>"><?php echo esc_html($hero_text2) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Section Ends -->
        <?php while(have_posts()): the_post(); ?>
            <?php if( class_exists( 'Elementor\Plugin' ) && Elementor\Plugin::instance()->db->is_built_with_elementor(get_the_ID()) ) : ?>
                <?php the_content(); ?>    
            <?php else : ?>
                <div class="container">
                    <article class="post-single-wrap">
                        <?php if (has_post_thumbnail()): ?>
                        <div class="post-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <?php endif ?>
                        <div class="row mar-top-70 mar-bot-70">
                            <div class="col-md-8 offset-md-2">
                                <div class="post-content-wrap">
                                    <?php the_content(); ?>
                                    <div class="clearfix"></div>
                                    <?php
                                    echo str_replace('<a', '<a class="ajax-link"', wp_link_pages( array(
                                        'before'      => '<div class="text-right"><p>'. esc_html__( 'Read Next: ', 'roph' ),
                                        'after'       => '</p></div>',
                                        'echo'        => 0
                                    ) ));
                                    ?>
                                </div>
                                <?php comments_template(); ?>
                            </div>
                        </div>    
                    </article>
                </div>         
            <?php endif ?>
        <?php endwhile ?>
        </div>
<?php get_footer(); ?>
