<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Revista Mirall Premium
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,900' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
        <div class="top-toolbar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-9">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="col-xs-3">
                        <a href="#">Subscriptors</a>
                    </div>
                </div>
            </div>
        </div>
		<div class="container">
            <div class="row">
                <div class="col-xs-7">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <span class="title-black">REVISTA</span> <span class="title-green">MIRALL</span></a></h1>
                    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>  
                </div>
                <div class="col-xs-5">
                    <div class="site-social">
                        <p>
                            <a href="https://ca-es.facebook.com/RevistaMirall" target="_blank"><span class="social-count">750.185</span><i class="fa fa-facebook"></i></a> <a href="https://twitter.com/revista_mirall" target="_blank"><span class="social-count">36k</span><i class="fa fa-twitter"></i></a>
                        </p>
                    </div>
                </div>
            </div>
		</div>

		<nav id="site-navigation" class="main-navigation navbar navbar-inverse" role="navigation">
            <div class="container">
    			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'revista_mirall_premium' ); ?></a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                        <span class="sr-only"><?php _e('Toggle navigation', 'revista_mirall_premium'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#">Brand</a>-->
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    
                        <?php
                        wp_nav_menu( array(
                                'theme_location'  => 'primary',
                                'container'       => false,
                                'menu_class'      => 'nav navbar-nav',//  navbar-right
                                'walker'          => new Bootstrap_Nav_Menu(),
                            )
                        );
                        
                        ?>
                    
                </div><!-- /.navbar-collapse -->
            </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div class="site-content">
        <div class="container">