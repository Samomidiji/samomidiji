<ul>
    <?php foreach (cs_get_option('social-share-options')['enabled'] as $key => $value): ?>
        <?php switch($key): 
        case 'facebook': ?>
            <li><a target="_blank" href="<?php $share_url = '//facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); echo esc_url($share_url); ?>"><?php echo esc_html__( 'Facebook', 'roph' ) ?></a></li>
        <?php break; ?>
        <?php case 'twitter': ?>
            <li><a target="_blank" href="<?php $share_url = '//twitter.com/home?status='.urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')).':'.get_the_permalink(); echo esc_url($share_url); ?>"><?php echo esc_html__( 'Twitter', 'roph' ) ?></a></li>
        <?php break; ?>
        <?php case 'pinterest': ?>
            <li><a target="_blank" href="<?php $share_url = '//pinterest.com/pin/create/button/?url='.get_the_permalink().'&media='.wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'&description='.urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); echo esc_url($share_url); ?>" class="pin-it-button" data-count-layout="horizontal"><?php echo esc_html__( 'Pinterest', 'roph' ) ?></a></li>
        <?php break; ?>
        <?php endswitch; ?>        
    <?php endforeach ?>
</ul>