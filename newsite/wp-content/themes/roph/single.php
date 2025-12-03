<?php get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
        <!-- Content Wrapper -->
        <div id="main">
            <!-- Hero Section -->
            <div id="hero" class="hero">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12">
                            <div class="page-title">
                                <div class="post-cat">
                                <?php
                                $terms = get_the_terms( get_the_ID(), 'category' ); 
                                if ( $terms && ! is_wp_error( $terms ) ) {
                                    $cat_name = array();
                                    foreach ( $terms as $term ) {
                                        $cat_name[] = '<a class="ajax-link" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
                                    }
                                  echo join( ", ", $cat_name);     
                                }
                                ?>
                                </div>
                                <h1 class="textFadeUp"><?php the_title(); ?></h1>
                                <?php if (get_the_tags()) : ?>
                                <div class="post-tag">
                                <?php
                                $terms = get_the_terms( get_the_ID(), 'post_tag' ); 
                                if ( $terms && ! is_wp_error( $terms ) ) {
                                    $tag_name = array();
                                    foreach ( $terms as $term ) {
                                        $tag_name[] = '<a class="ajax-link" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
                                    }
                                  echo join( ", ", $tag_name);     
                                }
                                ?>
                                </div>
                                <?php endif ?>
                                <div class="post-date"><?php echo get_the_date(); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Section Ends -->
            <div class="container mar-bot-100">     
                <article class="post-single-wrap">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="post-img mar-bot-70">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif ?>
                    <div class="row">
                        <?php if (is_active_sidebar( 'main-sidebar' ) && (!class_exists('lcThemeToolkit') || (class_exists('lcThemeToolkit') && cs_get_option('sidebar')))): ?>
                        <div class="col-md-8 with-sidebar">
                        <?php else: ?>
                        <div class="col-md-8 offset-md-2">
                        <?php endif ?>
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
                            <?php if (class_exists('lcThemeToolkit') && isset(cs_get_option('social-share-options')['enabled'])): ?>
                            <div class="post-share">
                            <?php load_template( WP_PLUGIN_DIR . '/lc-theme-toolkit/social-share/social-share.php', true ); ?>
                            </div>
                            <?php endif ?>
                            <?php comments_template(); ?>
                        </div>
                        <?php if (is_active_sidebar( 'main-sidebar' ) && (!class_exists('lcThemeToolkit') || (class_exists('lcThemeToolkit') && cs_get_option('sidebar')))): ?>
                            <aside class="col-md-3 offset-md-1 sidebar">
                                <?php get_sidebar(); ?>
                            </aside>
                        <?php endif ?>
                    </div>    
                </article>
            </div>
        </div>
        <!-- Content Wrapper Ends -->
<?php endwhile; ?>
<?php get_footer(); ?>