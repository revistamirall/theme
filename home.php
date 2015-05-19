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

    </div>
</div>
<div class="row">
    <div class="col-xs-3">
        <?php dynamic_sidebar('left-column'); ?>
    </div>
    <div class="col-xs-6">
        <?php dynamic_sidebar('center-column'); ?>
    </div>
    <div class="col-xs-3">
        <?php dynamic_sidebar('right-column'); ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>

