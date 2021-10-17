<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php //wp_body_open hook if WordPress 5.2
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } ?>
<div class="skip-link screen-reader-text">
    <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'likeawiki' ); ?>"><?php _e( 'Skip to content', 'likeawiki' ); ?></a>
</div>
    <div id="masthead">
        <div id="access" class="secondary-nav" role="navigation">

            <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>

        </div>

        <div class="topnav">
            <div class="toggler-container">
            <a href="<?php print likeawiki_void_link(); ?>" class="icon" onclick="lawtopnavMobi()">
            <span class="sbar1"></span><span class="sbar1"></span><span class="sbar1"></span></a>
            </div>
            
                <nav id="topnavLinks" style="display:none">
            
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        
                </nav>
        </div>

            <header class="site-header" role="banner">
                <figure class="logo">   
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                       title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>  &mdash; 
                       <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" 
                       rel="home"><img src="<?php header_image(); ?>" 
                       height="<?php echo esc_attr( get_custom_header()->height ); ?>" 
                       width="<?php echo esc_attr( get_custom_header()->width ); ?>" 
                       alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" /></a>
                </figure> 

                    <div class="hgroup">	
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url() ); ?>/"><?php echo esc_attr( bloginfo( 'name' ) ); ?></a></h1>
	                <h2 class="site-description"><?php bloginfo('description'); ?></h2>	
                    </div>
                    
            </header>

                <div id="access" class="primary-nav" role="navigation">
        
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        
                </div><!-- ends access# -->
    </div><!-- ends masthead -->

                    <?php get_template_part( 'content', 'tools' ); ?> 
                    
                    <div class="clearfix"></div>