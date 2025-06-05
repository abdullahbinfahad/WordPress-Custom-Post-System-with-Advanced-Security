<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" class="cps-single">
    <header>
        <h1><?php the_title(); ?></h1>
        <?php if ($subtitle = get_post_meta(get_the_ID(), '_cps_subtitle', true)) : ?>
            <h2 class="subtitle"><?php echo esc_html($subtitle); ?></h2>
        <?php endif; ?>
        
        <div class="meta">
            <?php the_terms(get_the_ID(), 'custom_category', '<span class="categories">', ', ', '</span>'); ?>
            <span class="date"><?php echo get_the_date(); ?></span>
        </div>
    </header>
    
    <div class="content">
        <?php the_content(); ?>
    </div>
    
    <footer>
        <?php if ($priority = get_post_meta(get_the_ID(), '_cps_priority', true)) : ?>
            <div class="priority">Priority: <?php echo absint($priority); ?>/10</div>
        <?php endif; ?>
    </footer>
</article>

<?php get_footer(); ?>