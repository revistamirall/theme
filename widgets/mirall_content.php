<?php

/*
Plugin Name: Mirall Content
Plugin URI:
Description: Show all content post.
Version: 1.0
Author: Ismael Julian
Author URI:
License: GPLv2 or later.
*/

class mirall_content extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_content', 'description' => __('Show all content post.'));
        parent::__construct('content_post', __('MIRALL Content'), $widget_ops);
    }


    public function update()
    {
    }

    public function form()
    {
    }

    function widget($args, $instance)
    {

        /* Start the Loop */
        ?>
        <?php while (have_posts()) : the_post(); ?>

        <?php
        /* Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part('content', get_post_format());


    endwhile;

    }
}

function register_mirall_content()
{
    register_widget('mirall_content');
}

add_action('widgets_init', 'register_mirall_content');