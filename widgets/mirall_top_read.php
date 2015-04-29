<?php

/*
Plugin Name: Mirall Top read post
Plugin URI:
Description: Top read post
Version: 1.0
Author: Ismael Julian
Author URI:
License: GPLv2 or later.
*/

class mirall_top_read extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_top_read', 'description' => __('Show the top readed post on the website.'));
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('top_read', __('MIRALL Top read post'), $widget_ops, $control_ops);
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['category'] = strip_tags($new_instance['category']);
        return $instance;
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('title' => '', 'text' => ''));
        $title = strip_tags($instance['title']);
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $category = isset($instance['category']) ? $instance['category'] : '';

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>"
                   size="3"/>
        </p>
        <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:'); ?></label>
            <select id="<?php echo $this->get_field_id('category'); ?>"
                    name="<?php echo $this->get_field_name('category'); ?>">
                <option value="0"><?php _e('&mdash; Select &mdash;') ?></option>
                <?php
                foreach (get_categories() as $cat) {
                    echo '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
                }
                ?>
            </select>
        </p>
    <?php
    }

    function widget($args, $instance)
    {
        extract($args);
        ?>
        <div class="top-read">
            <div class="top-read-title">
                <?php echo isset($instance['category']) ? $instance['title'] : 'Title not defined'; ?>
            </div>
            <?php
            $query_args = array(
                'cat' => isset($instance['category']) ? $instance['category'] : '0',
                'showposts' => isset($instance['number']) ? $instance['number'] : '5',
                'order' => 'DESC',
                'orderby' => 'meta_value_num',
                'meta_key' => 'post_views_count',
            );
            $query = new WP_Query($query_args);
            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="top-read-post">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            <?php
            endwhile; endif;
            wp_reset_query();
            ?>
        </div>
    <?php
    }
}

function register_mirall_top_read()
{
    register_widget('mirall_top_read');
}

add_action('widgets_init', 'register_mirall_top_read');
?>