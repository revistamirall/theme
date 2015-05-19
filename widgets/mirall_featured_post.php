<?php

/*
Plugin Name: Mirall Featured post
Plugin URI:
Description: Show a last post of a selected category.
Version: 1.0
Author: Ismael Julian
Author URI:
License: GPLv2 or later.
*/

class mirall_featured_post extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_featured_post', 'description' => __('Show a last post of a selected category.'));
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('featured_post', __('MIRALL Featured post'), $widget_ops, $control_ops);
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['images'] = isset($new_instance['images']);
        $instance['category'] = strip_tags($new_instance['category']);
        return $instance;
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('role' => ''));
        $title = strip_tags($instance['title']);
        $number = isset($instance['number']) ? absint($instance['number']) : 3;
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
                <option value="0"><?php _e('&mdash; Select category &mdash;') ?></option>
                <?php
                foreach (get_categories() as $cat) {
                    echo '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
                }
                ?>
            </select>
        </p>
        <p><input id="<?php echo $this->get_field_id('images'); ?>"
                  name="<?php echo $this->get_field_name('images'); ?>"
                  type="checkbox" <?php checked(isset($instance['images']) ? $instance['images'] : 0); ?> />&nbsp;<label
                for="<?php echo $this->get_field_id('images'); ?>"><?php _e('Add images'); ?></label>
        </p>
    <?php
    }

    function widget($args, $instance)
    {
        extract($args);
        ?>
        <div class="panel panel-featured-post">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span><?php echo isset($instance['title']) ? $instance['title'] : 'Title not defined'; ?></span>
                </h3>
            </div>
            <div class="panel-body">
                <?php
                    $query_args = array(
                        'cat' => isset($instance['category']) ? $instance['category'] : '0',
                        'showposts' => isset($instance['number']) ? $instance['number'] : '3',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($query_args);
                    if ($query->have_posts()) : while ($query->have_posts()) :
                        $query->the_post(); ?>
                        <div class="featured-post">
                            <?php if (isset($instance['images'])) { ?>
                                <div class="featured-post-image">
                                    <?php if (has_post_thumbnail()) {
                                        echo sprintf(the_post_thumbnail());
                                    } else {
                                        echo sprintf('<img src="%s/wp-content/themes/mirall/images/default-post.jpeg" width="200" height="150" alt="%s" />', get_site_url(), get_the_title());
                                    } ?>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="featured-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <div class="featured-post-resume"><?php the_excerpt(); ?></div>
                        </div>
                    <?php
                    endwhile;
                    endif;
                    wp_reset_query();
                    ?>
            </div>
        </div>
    <?php
    }
}

function register_mirall_featured_post()
{
    register_widget('mirall_featured_post');
}

add_action('widgets_init', 'register_mirall_featured_post');