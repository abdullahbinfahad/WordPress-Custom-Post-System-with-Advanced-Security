<div class="cps-featured-post">
    <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('medium'); ?>
            </div>
        <?php endif; ?>
        
        <h3><?php the_title(); ?></h3>
        <?php if ($subtitle = get_post_meta(get_the_ID(), '_cps_subtitle', true)) : ?>
            <p><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
    </a>
</div>