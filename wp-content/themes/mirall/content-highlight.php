<?php
/**
 * @package mirall
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="highlight-box">
        <div class="highlight-img">
            <?php
            if (has_post_thumbnail()) {
                echo '<div class="single-post-thumbnail clear">';
                echo the_post_thumbnail('large-thumb');
                echo '</div>';
            } else {
                $show = '';
                echo '<div class="single-post-thumbnail clear">';
                echo sprintf('<img src="%s/wp-content/themes/mirall/images/default-post.jpeg" width="100%" alt="%s" />', get_site_url(), get_the_title());
                echo '</div>';
            }

            ?>
        </div>
        <div class="highlight-title">
            <?php
            echo the_title(sprintf('<h1><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>');
            ?>
        </div>
    </div>
</article><!-- #post-## -->