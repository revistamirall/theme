<?php

/*
Plugin Name: Mirall Latest post
Plugin URI:
Description: Show a list of latest posts of a selected role of users.
Version: 1.0
Author: Ismael Julian
Author URI:
License: GPLv2 or later.
*/

class mirall_latest_post extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'widget_latest_post', 'description' => __('Show a list of latest posts of a certain role of users.'));
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('latest_post', __('MIRALL Latest post'), $widget_ops, $control_ops);
    }


    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['image'] = isset($new_instance['image']);
        $instance['role'] = strip_tags($new_instance['role']);
        return $instance;
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('role' => ''));
        $title = strip_tags($instance['title']);
        $number = isset($instance['number']) ? absint($instance['number']) : 1;
        $role = isset($instance['role']) ? $instance['role'] : '';

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
        <p><input id="<?php echo $this->get_field_id('image'); ?>"
                  name="<?php echo $this->get_field_name('image'); ?>"
                  type="checkbox" <?php checked(isset($instance['image']) ? $instance['image'] : 0); ?> />&nbsp;<label
                for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Add featured image'); ?></label>
        </p>
    <?php
    }

    function widget($args, $instance)
    {
        extract($args);

        $number_post = isset($instance['number']) ? $instance['number'] : '1';

        $post = array();
        /* GET USERS BY ROLE */
        $users = get_users(array('role' => isset($instance['role']) ? $instance['role'] : ''));
        foreach ($users as $user) {
            /* FOR EACH USER GET LAST POST */
            $query_args = array(
                'author' => $user->ID,
                'showposts' => $number_post,
                'order' => 'DESC',
                'orderby' => 'date'
            );
            $query = new WP_Query($query_args);
            if ($number_post > 1) {
                $i = 0;
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                    $post[get_the_author()][$i++] = get_post();
                endwhile;
                endif;
                wp_reset_query();

            } else {
                if ($query->have_posts()) {
                    $query->the_post();
                    $post[get_the_ID()] = array(get_post(), get_the_author());
                }

                wp_reset_query();
                /* ORDER POST BY ID */
                krsort($post);
            }

        }



        ?>

<div class="latest">
    <?php echo isset($instance['title']) ? '<div class="latest-title">' . $instance['title'] . '</div>' : '' ?>
</div>

<?php
        /*  PRINT ORDERED POST*/
        if ($number_post > 1) {
            foreach ($post as $author => $posts) {
                echo '<div class="blog_post">';
                if (isset($instance['images'])) {
                    echo get_the_post_thumbnail($posts[0]->ID);
                }
                echo '<div class="blog_post_author">' . $author . '</a> </div>';
                echo '<ul>';
                foreach ($posts as $author_post) {
                    echo '<li>';
                    echo '<div class="blog_post_title"><a href="' . $author_post->guid . '">' . $author_post->post_title . '</a></div>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
        } else {
            foreach ($post as $id => $array) {
                echo '<div class="blog_post">';
                if (isset($instance['images'])) {
                    echo get_the_post_thumbnail($array[0]->ID);
                }
                echo '<div class="blog_post_title"><a href="' . $array[0]->guid . '">' . $array[0]->post_title . '</a></div>';
                echo '<div class="blog_post_author">' . $array[1] . '</a> </div>';
                echo '</div>';
            }
        }

        ?>
        </div>
    <?php
    }
}

function register_mirall_latest_post()
{
    register_widget('mirall_latest_post');
}

add_action('widgets_init', 'register_mirall_latest_post');