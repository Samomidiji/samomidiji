<?php
/**
 * Theme functions and definitions
 */
//TGM Plugins Activation
if(file_exists(get_template_directory().'/includes/tgm/required-plugins.php')){
	require_once(get_template_directory().'/includes/tgm/required-plugins.php');
}

//theme setup function
function roph_functions() {
	// Define content width
	if ( ! isset( $content_width ) ) $content_width = 1170;	
	// text domain
	load_theme_textdomain('roph', get_template_directory().'/languages');
	// theme supports
	add_theme_support('custom-logo');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'roph-editor-styles.css' );
	// menu
	register_nav_menus( array(
		'main-menu' => esc_html__('Main Menu', 'roph')
	) );
}
add_action ('after_setup_theme', 'roph_functions');

// main sidebar
if ( !function_exists( 'roph_register_sidebar' ) ) {
 	function roph_register_sidebar() {
		register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'roph' ),
			'id' => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on single posts', 'roph' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) 
		);
	}
	add_action( 'widgets_init', 'roph_register_sidebar' );
}

//adding fonts
function roph_fonts_url() {
	$roph_fonts_url = '';
	/* Translators: If there are characters in your language that are not
	* supported by these fonts, translate these to 'off'. Do not translate
	* into your own language.
	*/
	$roph_roboto = esc_html(_x( 'on', 'Roboto font: on or off', 'roph' ));
	 
	if ( 'off' !== $roph_roboto ) {
		$font_families = array();
		$font_families[] = 'Roboto:300,400,500,700';		 
		$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

//including theme styles
function roph_styles() {
	wp_enqueue_style('roph-fonts', roph_fonts_url());
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('flexnav', get_template_directory_uri().'/css/flexnav.min.css');
	wp_enqueue_style('ionicons', get_template_directory_uri().'/css/ionicons.min.css');
	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.min.css');
	wp_enqueue_style('swiper', get_template_directory_uri().'/css/swiper.min.css');
	wp_enqueue_style('leaflet', get_template_directory_uri().'/css/leaflet.min.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style('roph-style', get_template_directory_uri().'/css/style.css');
	wp_enqueue_style('roph-stylesheet', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'roph_styles');

//including theme scripts
function roph_scripts(){
	wp_enqueue_script('flexnav', get_template_directory_uri().'/js/flexnav.min.js', array('jquery'), '', true);
	wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), '', true);
	wp_enqueue_script('scrollmagic', get_template_directory_uri().'/js/scrollmagic.min.js', array('jquery'), '', true);
	wp_enqueue_script('parallax_background', get_template_directory_uri().'/js/parallax_background.min.js', array('jquery'), '', true);
	wp_enqueue_script('cssplugin', get_template_directory_uri().'/js/cssplugin.min.js', array('jquery'), '', true);
	wp_enqueue_script('tweenlite', get_template_directory_uri().'/js/tweenlite.min.js', array('jquery'), '', true);
	wp_enqueue_script('tweenmax', get_template_directory_uri().'/js/tweenmax.min.js', array('jquery'), '', true);
	wp_enqueue_script('leaflet', get_template_directory_uri().'/js/leaflet.min.js', array('jquery'), '', true);
	wp_enqueue_script('splittext', get_template_directory_uri().'/js/splittext.min.js', array('jquery'), '', true);
	wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.min.js', array('jquery'), '', true);
	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/js/magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('roph-main', get_template_directory_uri().'/js/main.js', array('jquery'), '', true);
	wp_enqueue_script('roph-ajax-comment', get_template_directory_uri().'/js/ajax-comment.js', array('jquery'), '', true);	
 	wp_localize_script( 'roph-ajax-comment', 'roph_ajax_comment_params', array(
		'ajaxurl' => home_url() . '/wp-admin/admin-ajax.php'
	) );
	wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'roph_scripts');

//comment ajaxify
function roph_submit_ajax_comment(){
	$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
	if ( is_wp_error( $comment ) ) {
		$error_data = intval( $comment->get_error_data() );
		if ( ! empty( $error_data ) ) {
			wp_send_json( array( 'status_or_comment_html' => 1, 'alert_data' => '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$comment->get_error_message().'</div>' ) );
		} 
		else {
			wp_send_json( array( 'status_or_comment_html' => 1, 'alert_data' => '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'.esc_html__( 'Unknown error.', 'roph').'</div>' ) );
		}
	}
	elseif ( '0' == $comment->comment_approved ) {
		wp_send_json( array( 'status_or_comment_html' => 2, 'alert_data' => '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'.esc_html__( 'Your comment is awaiting moderation.', 'roph').'</div>' ) );
	}
	else {
		$comments_number = get_comments_number($_POST['comment_post_ID']);
		$comments_number_text = sprintf(
								esc_html(_nx(
									'%1$s comment',
									'%1$s comments',
									$comments_number,
									'comments title',
									'roph'
								)),
								number_format_i18n( $comments_number )
							);
		/*
		 * Set Cookies
		 */
		$user = wp_get_current_user();
		do_action('set_comment_cookies', $comment, $user);
		/*
		 * If you do not like this loop, pass the comment depth from JavaScript code
		 */
		$comment_depth = 1;
		$comment_parent = $comment->comment_parent;
		while( $comment_parent ){
			$comment_depth++;
			$parent_comment = get_comment( $comment_parent );
			$comment_parent = $parent_comment->comment_parent;
		}

		$GLOBALS['comment'] = $comment;
		$GLOBALS['comment_depth'] = $comment_depth;
	
		ob_start();
		roph_list_comment ($comment, array('max_depth' => get_option('thread_comments_depth')), $comment_depth);
	    $comment_html = ob_get_clean();
	    wp_send_json( array( 'status_or_comment_html' => $comment_html, 'alert_data' => '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'.esc_html__( 'Thanks for your comment.', 'roph').'</div>', 'comments_number_text' => $comments_number_text ) );
	}
}
add_action( 'wp_ajax_ajaxcomments', 'roph_submit_ajax_comment' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_ajaxcomments', 'roph_submit_ajax_comment' ); // wp_ajax_nopriv_{action} for not registered users

/* Start Custom Comment list */
function roph_list_comment( $comment, $args, $depth ) {
  	?>
  	<li id="comment-<?php comment_ID(); ?>" class="comment-li">
	  	<div id="div-comment-<?php comment_ID(); ?>" class="comment row">
	  		<?php if (empty($comment->comment_type)) : ?>
		    <div class="comment-author col-sm-2">
		    	<img src="<?php echo esc_url(get_avatar_url( $comment )); ?>" alt="<?php comment_author(); ?>" />
		    </div>
			<?php endif; ?>
		    <div class="comment-details col-sm-10">
		    	<div class="comment-meta">
		    		<span class="comment-date"><?php comment_date(); ?></span>
		    		<span class="commenter"><?php comment_author(); ?></span>
		      	</div>
		      	<?php if ( '0' == $comment->comment_approved ) : ?>
		        <p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'roph' ); ?></p>
		      	<?php endif; ?>
		      	<div class="comment-content">
		      		<?php comment_text(); ?>
			      	<?php
			      	comment_reply_link( array_merge( $args, array(
			        'add_below' => 'div-comment',
			        'depth'     => $depth,
			        'max_depth' => $args['max_depth'],
			        'before'    => '<div class="comment-reply">',
			        'after'     => '</div>'
			        ) ) );
			        ?>
		      	</div>
	    	</div>
	    </div>	  
    <?php
  }
/* End Custom Comment list */
/* Start Move Comment Form Field */
function roph_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'roph_move_comment_field' );
/* End Move Comment Form Field */

/* Start add custom body class */
function roph_body_classes( $classes ) {
    $classes[] = 'hidden';
    if (class_exists('lcThemeToolkit') && cs_get_option('custom_cursor_disable')) {
    	$classes[] = 'no-cursor';
    }
    return $classes;
}
add_filter( 'body_class','roph_body_classes' );
/* End add custom body class */