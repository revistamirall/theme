<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mirall
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="page" class="hfeed site container-fluid" class="">
    <div class="row">
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'mirall'); ?></a>

        <div class="site-search-color"></div>
        <header id="masthead" class="container" role="banner">
            <div class="site-search">
                <div class="search-engine">Cerca:<?php //get_search_form()?></div>
                <div class="search-subscribers">Subscriptors</div>
            </div>
            <div class="site-branding">
                <h1 class="site-title"><?php bloginfo('name'); ?></h1>

                <h2 class="site-description"><?php bloginfo('description'); ?></h2>
            </div>
            <div class="site-social">
                <p><a><i class="fa fa-facebook"></i></a> <a><i class="fa fa-twitter"></i></a> <a><i
                            class="fa fa-google-plus-square"></i></a></p>
            </div>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false"><?php _e('Primary Menu', 'mirall'); ?></button>
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>

            </nav>
        </header>
        <div class="main-navigation-color"></div>
    </div>    
    <div class="clear-content"></div>

    <div id="content" class="row">