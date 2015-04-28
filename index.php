<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mirall
 */

get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-8">
                <?php dynamic_sidebar('home-top'); ?>
                <?php
                $myPosts = new WP_Query();
                // category_name=popular&category_name=common&showposts=1
                $myPosts->query('showposts=1');

                while ($myPosts->have_posts()): the_post(); ?>
                    <?php
                    get_template_part('content-highlight', get_post_format());
                    break;
                    ?>
                <?php endwhile; ?>
        </div>
        <div class="col-xs-4">
            <?php dynamic_sidebar('home-top-right'); ?>
            <div class="top-read">
                <div class="top-read-title">Els més llegits</div>
                <?php
                query_posts('showposts=5&meta_key=post_views_count&orderby=meta_value_num&order=DESC');
                if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="top-read-post">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                <?php
                endwhile; endif;
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <?php dynamic_sidebar('left-column'); ?>
        </div>
        <div class="col-xs-6">
            <?php dynamic_sidebar('center-column'); ?>
            <div id="primary" class="content-area">
                <div id="resume" class="content-resume">
                    <?php
                    query_posts('showposts=5&meta_key=post_views_count&orderby=meta_value_num&order=DESC');
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php
                        get_template_part('content-author', get_post_format());
                        ?>
                    <?php endwhile; endif;
                    wp_reset_query(); ?>


                </div>
                <main id="main" class="site-main" role="main">

                    <?php if (have_posts()) : ?>

                        <?php /* Start the Loop */ ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('content', get_post_format());
                            ?>

                        <?php endwhile; ?>

                        <?php the_posts_navigation(); ?>

                    <?php else : ?>

                        <?php get_template_part('content', 'none'); ?>

                    <?php endif; ?>
                </main>
                <!-- #main -->
            </div><!-- #primary -->
        </div>
        <div class="col-xs-3">
            <?php dynamic_sidebar('right-column'); ?>
            <?php get_sidebar(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php get_footer(); ?>
        </div>        
    </div>
</div>

