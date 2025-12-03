<?php 
    get_header();
    $cover_style_info = get_post_meta( get_the_ID(), '_cover_style_info', true );
?>
<?php while(have_posts()) : the_post(); ?>
<div id="main">
    <?php if ($cover_style_info['cover_style'] == 2): ?>
    <div id="hero" class="hero md">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="page-title">
                        <?php if ($cover_style_info['text_above_portfolio_title']): ?>
                        <span><?php echo esc_html($cover_style_info['text_above_portfolio_title']) ?></span>
                        <?php endif ?>
                        <h1 class="textFadeUp"><?php the_title(); ?></h1>
                        <?php if ($cover_style_info['button_text']): ?>
                        <div class="d-block">
                            <a class="project-link mar-top-20 link" href="<?php echo esc_url( $cover_style_info['button_url'] ); ?>">
                                <?php echo esc_html( $cover_style_info['button_text'] ); ?>
                                <span class="view-project">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 104 104" enable-background="new 0 0 104 104" xml:space="preserve">
                                      <circle class="view-project-circle" fill="none" stroke="#000" stroke-width="4" stroke-miterlimit="10" cx="52" cy="52" r="50"/>
                                    </svg>
                                    <span class="view-project-outline"></span> 
                                    <i class="ion-ios-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="fixed-bg">
                    <div class="parallax-inner" <?php if ( has_post_thumbnail() ): ?>style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover"<?php endif ?>>
                    </div>
                </div>
            </div>
        </div>
        <div class="project-meta mar-top-70 col-md-8 offset-md-2">
            <div class="row">
                <?php if ($cover_style_info['client_title']): ?>
                <div class="col-md-3 col-6 mar-top-30">
                    <span><?php echo esc_html($cover_style_info['client_title']) ?></span> <?php echo esc_html( $cover_style_info['client_name'] ); ?>
                </div>
                <?php endif ?>
                <?php if ($cover_style_info['year_title']): ?>
                <div class="col-md-3 col-6 mar-top-30">
                    <span><?php echo esc_html( $cover_style_info['year_title'] ); ?></span> <?php echo esc_html( $cover_style_info['year'] ); ?>
                </div>
                <?php endif ?>
                <?php if ($cover_style_info['text_above_portfolio_title']): ?>
                <div class="col-md-6 mar-top-30">
                    <span><?php echo esc_html( $cover_style_info['category_title'] ); ?></span>
                    <ul>
                    <?php
                    $terms = get_the_terms( get_the_ID(), 'portfolio-category' ); 
                    if ( $terms && ! is_wp_error( $terms ) ):
                        foreach ( $terms as $term ): ?>
                        <li><a class="ajax-link" href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo esc_html( $term->name ) ?></a></li>
                        <?php endforeach ?>
                    <?php endif ?>
                    </ul>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>        
    <?php else: ?>
    <div id="hero" class="hero lg parallax-background">
        <div class="parallax-inner" <?php if ( has_post_thumbnail() ): ?>style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-repeat: no-repeat; background-position: center; background-size: cover;"<?php endif ?>>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <?php if ($cover_style_info['text_above_portfolio_title']): ?>
                        <span><?php echo esc_html($cover_style_info['text_above_portfolio_title']) ?></span>
                        <?php endif ?>
                        <h1 class="textFadeUp"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mar-top-70 mar-bot-70">
        <div class="project-meta">
            <div class="row">
                <?php if ($cover_style_info['client_title']): ?>
                <div class="col-md-2 col-6 mar-top-30">
                    <span><?php echo esc_html($cover_style_info['client_title']) ?></span> <?php echo esc_html( $cover_style_info['client_name'] ); ?>
                </div>
                <?php endif ?>
                <?php if ($cover_style_info['year_title']): ?>
                <div class="col-md-2 col-6 mar-top-30">
                    <span><?php echo esc_html( $cover_style_info['year_title'] ); ?></span> <?php echo esc_html( $cover_style_info['year'] ); ?>
                </div>
                <?php endif ?>
                <?php if ($cover_style_info['text_above_portfolio_title']): ?>
                <div class="col-md-4 mar-top-30">
                    <span><?php echo esc_html( $cover_style_info['category_title'] ); ?></span>
                    <ul>
                    <?php
                    $terms = get_the_terms( get_the_ID(), 'portfolio-category' ); 
                    if ( $terms && ! is_wp_error( $terms ) ):
                        foreach ( $terms as $term ): ?>
                        <li><a class="ajax-link" href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo esc_html( $term->name ) ?></a></li>
                        <?php endforeach ?>
                    <?php endif ?>
                    </ul>
                </div>
                <?php endif ?>
                <?php if ($cover_style_info['button_text']): ?>
                <div class="col-md-2 offset-md-2">
                    <a class="project-link mar-top-70" href="<?php echo esc_url( $cover_style_info['button_url'] ); ?>">
                        <?php echo esc_html( $cover_style_info['button_text'] ); ?>
                        <span class="view-project">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 104 104" enable-background="new 0 0 104 104" xml:space="preserve">
                              <circle class="view-project-circle" fill="none" stroke="#000" stroke-width="4" stroke-miterlimit="10" cx="52" cy="52" r="50"/>
                            </svg>
                            <span class="view-project-outline"></span> 
                            <i class="ion-ios-arrow-right"></i>
                        </span>
                    </a>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>        
    <?php endif ?>

    <?php the_content(); ?>
    <?php if (cs_get_option('social-share-options')['enabled']): ?>
    <div class="container">
        <div class="project-share">
        <?php load_template( WP_PLUGIN_DIR . '/lc-theme-toolkit/social-share/social-share.php', true ); ?>
        </div>
    </div>
    <?php endif ?>
    <?php 
    $next_post = get_next_post(); 
    $prev_post = get_previous_post();
    ?>
    <?php if (cs_get_option('portfolio_navigation') == 1 && !empty( $next_post )): ?>
    <div class="container mar-bot-100">
        <div class="d-block">
            <a class="ajax-link portfolio-content" href="<?php echo get_the_permalink( $next_post->ID ) ?>">
                <h3 class="clip-text" style="background-image: url(<?php echo get_the_post_thumbnail_url( $next_post->ID ) ?>); background-size: cover;"><?php echo esc_html(cs_get_option( 'next_title' )); ?></h3>
            </a>
        </div>
    </div> 
    <?php elseif (cs_get_option('portfolio_navigation') == 2 && !empty( $next_post )): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="project-next-container">
                <div class="project-next-bg" style="background-image: url(<?php echo get_the_post_thumbnail_url( $next_post->ID ) ?>); background-size: cover; background-position: center;"></div>
                <a class="ajax-link portfolio-content" href="<?php echo get_the_permalink( $next_post->ID ) ?>">
                    <h3>
                        <span><?php echo esc_html(cs_get_option( 'next_title' )); ?></span>
                        <span><?php echo get_the_title( $next_post->ID ) ?></span>
                    </h3>
                </a>
            </div>
        </div>
    </div> 
    <?php elseif (cs_get_option('portfolio_navigation') == 3): ?>
    <div class="container mar-bot-100">
        <div class="col-sm-12">
            <ul class="project-nav clearfix">
                <?php if (!empty( $prev_post )): ?>
                <li class="project-prev">
                    <a class="ajax-link" href="<?php echo get_the_permalink( $prev_post->ID ) ?>" rel="prev">
                        <span><?php echo esc_html(cs_get_option( 'previous_title' )); ?></span>
                        <h4><?php echo get_the_title( $prev_post->ID ) ?></h4>
                    </a>
                </li>
                <?php endif ?>
                <?php if (!empty( $next_post )): ?>
                <li class="project-next">
                    <a class="ajax-link" href="<?php echo get_the_permalink( $next_post->ID ) ?>" rel="next">
                        <span><?php echo esc_html(cs_get_option( 'next_title' )); ?></span>
                        <h4><?php echo get_the_title( $next_post->ID ) ?></h4>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>        
    <?php endif ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>