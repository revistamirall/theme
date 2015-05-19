<?php
/**
 * @package Revista Mirall Premium
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Do not print first post
    if ($wp_query->current_post == 0 && !is_paged() && is_front_page()) {
        return;
    }
    ?>

    <div class="index-box">
        <div class="post-img">
            <?php
            if (has_post_thumbnail()) {
                echo '<div class="single-post-thumbnail clear">';
                echo the_post_thumbnail('index-thumb');
                echo '</div>';
            } else {
                $show = '';
                echo '<div class="single-post-thumbnail clear">';
                echo sprintf('<img src="%s/wp-content/themes/mirall/images/default-post.jpeg" width="200" height="150" alt="%s" />', get_site_url(), get_the_title());
                echo '</div>';
            }

            ?>
        </div>
        <div class="post-header-content">
            <header class="entry-header">
                <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>

                <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header>
            <!-- .entry-header -->

            <div class="entry-content">
                <?php

                the_excerpt();
                ?>

                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'mirall'),
                    'after' => '</div>',
                ));
                ?>
            </div>
            <!-- .entry-content -->
        </div>
    </div>
</article><!-- #post-## -->