<?php
if ( post_password_required() ) {
    return;
}
?>
<div class="comments clearfix">
    <?php
    if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
                $comments_number = get_comments_number();
                printf(
                    _nx(
                        'Comment <span>(%1$s)</span>',
                        'Comments <span>(%1$s)</span>',
                        $comments_number,
                        'comments title',
                        'roph'
                    ),
                    number_format_i18n( $comments_number )
                );
            ?>
        </h3>
        <ul class="comment-list">
        <?php 
            wp_list_comments(array(
                'callback'  => 'roph_list_comment'
            ));
        ?>
        </ul>
        <div class="float-left">
            <?php
            echo str_replace('<a', '<a class="ajax-link"', get_previous_comments_link());
            ?>
        </div>
        <div class="float-right">
            <?php
            echo str_replace('<a', '<a class="ajax-link"', get_next_comments_link());
            ?>
        </div>
    <?php 
    endif;
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'roph' ); ?></p>
    <?php endif; ?>
</div>

<?php 
$comment_args = array(
    'title_reply' => esc_html__( 'Leave a comment', 'roph' ),
    'title_reply_before' => '<h3 class="comment-reply-title">',
    'title_reply_after'  => '</h3>',
    'comment_notes_before' => '',
    'submit_button' => '<button type="submit">'.esc_html__( 'Post Comment', 'roph' ).'</button>',
    'submit_field' => '<div class="col-sm-12 form-submit">%1$s %2$s</div>',

    'fields' => apply_filters( 'comment_form_default_fields', array(
        'author' => '<div class="col-md-6"><input id="author" class="form-control" placeholder="'.esc_attr__( 'Name*', 'roph' ). '" name="author" type="text"/></div>',
        'email'  => '<div class="col-md-6"><input id="email" class="form-control" name="email" type="text" placeholder="'.esc_attr__( 'Email*', 'roph' ). '" /></div>',
        'url' => '',
        'cookies' => '<div class="col-md-12"><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />' . '<label for="wp-comment-cookies-consent">&nbsp;' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'roph' ) . '</label></p></div>' 
    ) ),
    'class_form' => 'row comment-form mar-bot-30',
    'comment_field' => '<div class="col-sm-12 text-areas"><textarea name="comment" id="comment" class="form-control" placeholder="'.esc_attr__( 'Comment*', 'roph' ). '"></textarea></div>'
);

comment_form($comment_args); 
?>
