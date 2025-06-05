<?php get_header(); ?>

<main class="cps-taxonomy">
    <header class="page-header">
        <h1 class="page-title"><?php single_term_title(); ?></h1>
        <?php if ($description = term_description()) : ?>
            <div class="taxonomy-description"><?php echo $description; ?></div>
        <?php endif; ?>
    </header>

    <div class="cps-category-filter">
        <label for="category-select"><?php _e('Filter by Category:', 'textdomain'); ?></label>
        <select id="category-select" data-base="<?php echo esc_url(get_post_type_archive_link('custom_post')); ?>category/">
            <option value="">All Categories</option>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'custom_category',
                'hide_empty' => true,
            ));
            
            foreach ($categories as $category) {
                echo '<option value="' . esc_attr($category->slug) . '"' . 
                    selected(get_queried_object_id(), $category->term_id, false) . '>' . 
                    esc_html($category->name) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="cps-posts-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" class="cps-post-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>

                        <h2><?php the_title(); ?></h2>
                        <?php if ($subtitle = get_post_meta(get_the_ID(), '_cps_subtitle', true)) : ?>
                            <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>
                    </a>

                    <div class="post-meta">
                        <span class="date"><?php echo get_the_date(); ?></span>
                        <?php if ($priority = get_post_meta(get_the_ID(), '_cps_priority', true)) : ?>
                            <span class="priority">Priority: <?php echo absint($priority); ?></span>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e('No posts in this category.', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>

    <?php the_posts_pagination(); ?>
</main>

<?php get_footer(); ?>