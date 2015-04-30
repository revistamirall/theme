<?php

/*
Plugin Name: Mirall Last post
Plugin URI:
Description: Show a list of last post of a certain role of users.
Version: 1.0
Author: Ismael Julian
Author URI:
License: GPLv2 or later.
*/

class mirall_last_post extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_last_post', 'description' => __('Show a list of last post of a certain role of users.'));
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('last_post', __('MIRALL Last post'), $widget_ops, $control_ops);
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['role'] = strip_tags($new_instance['role']);
        return $instance;
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('role' => ''));
        $role = isset($instance['role']) ? $instance['role'] : '';

        ?>
        <p><label for="<?php echo $this->get_field_id('role'); ?>"><?php _e('Role:'); ?></label>
            <select id="<?php echo $this->get_field_id('role'); ?>"
                    name="<?php echo $this->get_field_name('role'); ?>">
                <option value="0"><?php _e('&mdash; Select &mdash;') ?></option>
                <?php
                foreach (get_editable_roles() as $role_name => $role_info) {
                    echo '<option value="' . $role_name . '">' . $role_name . '</option>';
                }
                ?>
            </select>
        </p>
    <?php
    }

    function widget($args, $instance)
    {
        extract($args);

        $post = array();
        /* GET USERS BY ROLE */
        $users = get_users(array('role' => isset($instance['role']) ? $instance['role'] : ''));
        foreach ($users as $user) {
            /* FOR EACH USER GET LAST POST */
            $query_args = array(
                'author' => $user->ID,
                'showposts' => '1',
                'order' => 'DESC',
                'orderby' => 'date'
            );
            $query = new WP_Query($query_args);
            if ($query->have_posts()) {
                $query->the_post();
                $post[get_the_ID()] = array(get_post(), get_the_author());
            }
            wp_reset_query();
        }

        /* ORDER POST BY ID */
        krsort($post);

        /* PRINT ORDERED POST */
        foreach ($post as $id => $array) {
            echo '<div class="blog_post">';
            echo '<div class="blog_post_title"><a href="' . $array[0]->guid . '">' . $array[0]->post_title . '</a> </div>';
            echo '<div class="blog_post_author">' . $array[1] . '</a> </div>';
            echo '</div>';
        }
    }
}

function register_mirall_last_post()
{
    register_widget('mirall_last_post');
}

add_action('widgets_init', 'register_mirall_last_post');