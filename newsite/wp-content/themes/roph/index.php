<?php 
get_header();
$hero_section = get_post_meta( get_option('page_for_posts'), '_hero_section', true );
?>
        <!-- Content Wrapper -->
        <div id="main">
            <!-- Hero Section -->
            <div id="hero" class="hero" <?php if (class_exists('lcThemeToolkit') && isset($hero_section['hero_image'])): ?> style="background: url(<?php echo esc_url(wp_get_attachment_image_src( $hero_section['hero_image'], 'full' )[0]) ?>)"<?php endif ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12">
                            <?php 
                            $hero_text1 = '';
                            $hero_text2 = '';
                            if (is_home()) {
                                if (wp_title('', false)) {
                                    $hero_text1 = (class_exists('lcThemeToolkit') && isset($hero_section['hero_text1'])) ? $hero_section['hero_text1'] : '';
                                    $hero_text2 = (class_exists('lcThemeToolkit') && isset($hero_section['hero_text2'])) ? $hero_section['hero_text2'] : '';
                                    if (!$hero_text1 && !$hero_text2) {
                                        $hero_text2 = wp_title('', false);
                                    }
                                } else {
                                    $hero_text2 = esc_html__('Blog', 'roph');
                                }
                            }
                            elseif (is_category()) {
                                $hero_text1 = esc_html__('Blog Category:', 'roph');
                                $hero_text2 = single_cat_title('', false);
                            }
                            elseif (is_tag()) {
                                $hero_text1 = esc_html__('Blog Tag:', 'roph');
                                $hero_text2 = single_tag_title('', false);
                            }
                            elseif (is_tax('portfolio-category')) {
                                $hero_text1 = esc_html__('Portfolio Category:', 'roph');
                                $hero_text2 = single_term_title('', false);
                            }
                            elseif (is_author()) {
                                $hero_text1 = esc_html__('Author:', 'roph');
                                $hero_text2 = get_the_author();
                            }
                            elseif (is_date()) {
                                $hero_text2 = get_the_archive_title();
                            }
                            elseif (is_search()) {
                                $hero_text1 = esc_html__('Search:', 'roph');
                                $hero_text2 = get_search_query();
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
            <?php if (have_posts()) : ?>
            <div class="container-fluid mar-bot-100 mar-top-60">
                <?php if (is_active_sidebar( 'main-sidebar' ) && (!class_exists('lcThemeToolkit') || (class_exists('lcThemeToolkit') && cs_get_option('sidebar')))): ?>
                <div class="row with-sidebar">                
                    <div class="col-md-9">
                <?php endif ?>
                        <div class="post-container">
                            <?php while(have_posts()) : the_post(); ?>
                            <article <?php has_post_thumbnail() ? post_class('post') : post_class('post without-thumbnail'); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                <div class="post-img-wrap">
                                    <a class="ajax-link post-img" href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                                <?php endif ?>
                                <div class="post-content-wrap">
                                    <div class="post-content">
                                        <div class="post-cat">
                                        <?php 
                                        if (get_post_type() == 'portfolio') { 
                                            $terms = get_the_terms( get_the_ID(), 'portfolio-category' ); 
                                        }
                                        else {
                                            $terms = get_the_terms( get_the_ID(), 'category' ); 
                                        }
                                        if ( $terms && ! is_wp_error( $terms ) ) {
                                            $cat_name = array();
                                            foreach ( $terms as $term ) {
                                                $cat_name[] = '<a class="ajax-link" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
                                            }
                                          echo join( ", ", $cat_name);     
                                        }
                                        ?>
                                        </div>
                                        <h2 class="post-title"><a class="ajax-link post-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-date"><?php echo get_the_date(); ?></div>
                                    </div>
                                </div>
                            </article>
                            <?php endwhile; ?>
                        </div>
                        <?php 
                        $pagination = paginate_links( array(
                            'type' => 'array',
                            'prev_next' => false
                        ) ); 
                        ?>
                        <?php if ( ! empty( $pagination ) ) : ?>
                        <ul class="post-nav">
                            <?php foreach ( $pagination as $page_link ) : ?>
                            <li class="post-number <?php if ( strpos( $page_link, 'current' ) !== false ) { echo esc_attr( 'active' ); } ?>">
                            <?php echo str_replace('page-numbers', 'ajax-link', $page_link); ?>
                            </li>
                            <?php endforeach ?>
                        </ul>
                        <?php endif; ?>
                <?php if (is_active_sidebar( 'main-sidebar' ) && (!class_exists('lcThemeToolkit') || (class_exists('lcThemeToolkit') && cs_get_option('sidebar')))): ?>
                    </div>
                    <!-- Sidebar -->
                    <aside class="col-md-3 sidebar">
                    <?php get_sidebar(); ?>
                    </aside>
                    <!-- end sidebar -->
                </div>
                <?php endif ?>
            </div>
            <?php else: ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-md-12">
                        <div class="mar-bot-100">
                            <h2><?php echo esc_html__( 'Sorry, no posts matched your criteria.', 'roph' ) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
        <!-- Content Wrapper Ends -->
<?php get_footer(); ?>