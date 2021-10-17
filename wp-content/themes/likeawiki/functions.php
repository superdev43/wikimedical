<?php
/**
 * @package WordPress - 4.5+
 * @subpackage LikeAWiki theme
 * @since likeawiki 0.3
 * Use a child theme for customization (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes).
 * Copyright 2015 Larry Judd, Tradesouthwest.com
 */

/**
 * Compares the version of WordPress running to the $version specified.
 *
 * @uses get_bloginfo() Retrieve info about WP.
 * @uses switch_theme() Revert back to last theme if false.
 * @returns boolean
 */
function likeawiki_test_min_version() 
{
    if(version_compare(get_bloginfo('version'),'4.5', '<') ) {
	    
		add_action( 'admin_notices', 'likeawiki_min_version_not_met_notice' );
        // Switches back to the previous theme if the minimum WP version is not met.
        switch_theme( get_option( 'theme_switched' ) );
        unset( $_GET['activated'] );
		return false;
	}
}
// An error notice that can be displayed if the Minimum PHP version is not met.
function likeawiki_min_version_not_met_notice() 
{
	
	$class = 'notice notice-error';
    $message = __( 'It is recommended that you update WordPress to 4.5 or higher in order to use this theme.', 
                   'likeawiki' );
 
    printf( '<div class="%1$s"><p>%2$s</p></div>', 
                esc_attr( $class ), esc_html( $message ) ); 
}

/**
 * Theme setup
 * @since 0.3
 */
function likeawiki_setup() {

    /* Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     * @since 1.31
     */
    add_theme_support( 'html5', array( 'search-form', 
                                        'comment-form', 
                                        'comment-list', 
                                        'gallery', 
                                        'caption', )
                                    );
    add_theme_support('automatic-feed-links');
    add_theme_support( 'title-tag' );
    add_editor_style( 'editor-style.css' );

    // This theme uses Featured Images (also known as post thumbnails)
    add_theme_support('post-thumbnails');
    //set_post_thumbnail_size( 150, 150 );

     // language support - add your translation
    load_theme_textdomain('likeawiki', get_template_directory() . '/inc/languages');

    // This theme uses wp_nav_menu in one location.
    register_nav_menus(array(
        'primary' => __('Main Primary Navigation', 'likeawiki'),
        'secondary' => __('Top Secondary Navigation', 'likeawiki')
        ));

   /**
     * customer background color and image support
     */
    $likeawiki_custom_background = array(
        'default-color'      => '#fafafb',
        'default-image'       => '',
        'wp-head-callback'     => '_custom_background_cb',
        'admin-head-callback'   => '',
        'admin-preview-callback' => ''
        );
    add_theme_support( 'custom-background', $likeawiki_custom_background );

   /*
     * customer header image banner support
     */
    add_theme_support( 'custom-header',
        apply_filters( 
            'likeawiki_custom_header_args', array( 
            'default-image'          => get_template_directory_uri() . '/inc/default-header.png',
            'random-default'         => false,
            'width'                  => 400,
            'height'                 => 98,
            'flex-height'            => true,
            'flex-width'             => true,
            'repeat'                 => 'no-repeat',
            'default-text-color'     => 'FFFFFF',
            'header-text'            => false,
            'uploads'                => true,
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
            )
          ) 
        );
         /* Register Default Headers 
          * @since 1.31
          * Left @string $parenturl to adjust for child theme */
        $parenturl = get_template_directory_uri();

        $likeawiki_suggested_imgs  =  array( 
            'likeawiki_default_header' => array( 
            'description'          => __( 'Generic default image', 'likeawiki' ),
            'url'                => $parenturl . '/inc/default-header.png',
            'thumbnail_url'    => $parenturl . '/inc/default-header.png',
            ), 
        );
    register_default_headers( $likeawiki_suggested_imgs );   
}
add_action('after_setup_theme', 'likeawiki_setup');

/**
 * Set the $content_width for things such as video embeds that may have generic widths.
 * @since 1.31
 */
add_action( 'after_setup_theme', 'likeawiki_content_width', 0 );

function likeawiki_content_width() 
{

	$GLOBALS['content_width'] = apply_filters( 'likeawiki_content_width', 740 );
}


function likeawiki_add_theme_scripts() {

    // Loads default main stylesheet.
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    // likeawiki toggle tool bar script
    wp_enqueue_script( 'likeawiki-tools-js', 
                      get_template_directory_uri() .'/inc/likeawiki-tools.js', 
                      array(), '', true );
    wp_enqueue_script( 'likeawikimobi', 
                      get_template_directory_uri() .'/inc/likeawikimobi.js', 
                      array(), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	      wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'likeawiki_add_theme_scripts' );


    // add ie conditional html5 shim to header
function likeawiki_add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_template_directory_uri() . 'inc/html5shiv.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'likeawiki_add_ie_html5_shim');


// init for widgets
function likeawiki_widgets_init() {
    register_sidebar(array(
            'name' => __('Primary Left Side', 'likeawiki'),
            'id' => 'sidebar',
            'description' => __('The left-side widget area', 'likeawiki'),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    register_sidebar(array(
            'name' => __('Likeawiki Toolbar Widget', 'likeawiki'),
            'id' => 'sidebar-lawwidget',
            'description' => __('Custom widget area only shows in toolbox', 'likeawiki'),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
}
add_action( 'widgets_init', 'likeawiki_widgets_init' );

  /**
  * Filters wp_title to print a neat <title> tag based on what is being viewed.
  *
  * @param string $title Default title text for current view.
  * @param string $sep Optional separator.
  * @return string The filtered title.
  */
function likeawiki_wp_title( $title, $sep ) {
         if ( is_feed() ) {
             return $title;
         }
         global $page, $paged;
          // Add the blog name
         $title .= get_bloginfo( 'name', 'display' );
          // Add the blog description for the home/front page.
         $site_description = get_bloginfo( 'description', 'display' );
         if ( $site_description && ( is_home() || is_front_page() ) ) {
             $title .= " $sep $site_description";
         }
          // Add a page number if necessary:
         if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
             $title .= " $sep " . sprintf( __( 'Page %s', 'likeawiki' ), max( $paged, $page ) );
         }
             return $title;
}
add_filter( 'wp_title', 'likeawiki_wp_title', 10, 2 );

// breadcrumbs added to theme here
function likeawiki_breadcrumbs() {

  /* === OPTIONS === */

  $text['home']     = __( 'Home', 'likeawiki' );                            // text for the 'Home' link
  $text['category'] = __( 'Archive by Category "%s"', 'likeawiki' );       // text for a category page
  $text['search']   = __( 'Search Results for "%s" Query', 'likeawiki' ); // text for a search results page
  $text['tag']      = __( 'Posts Tagged "%s"', 'likeawiki' );            // text for a tag page
  $text['author']   = __( 'Articles Posted by %s', 'likeawiki' );       // text for an author page
  $text['404']      = __( 'Error 404', 'likeawiki' );                  // text for the 404 page

  $show_current   = 1;                             // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
  $show_on_home   = 0;                            // 1 - show breadcrumbs on the homepage, 0 - don't show
  $show_home_link = 1;                           // 1 - show the 'Home' link, 0 - don't show
  $show_title     = 1;                          // 1 - show the title for the links, 0 - don't show
  $delimiter      = ' &raquo; ';               // delimiter between crumbs
  $before         = '<span class="current">'; // tag before the current crumb
  $after          = '</span>';               // tag after the current crumb

  /* === END OF OPTIONS === */

  global $post;
  $home_link  = esc_url( home_url('/') );
  $link_before = '<span typeof="v:Breadcrumb">';
  $link_after  = '</span>';
  $link_attr  = ' rel="v:url" property="v:title"';
  $link     = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
  $parent_id  = $parent_id_2 = $post->post_parent;
  $frontpage_id = get_option('page_on_front');

  if (is_home() || is_front_page()) {

    if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . esc_url( $home_link ) . '">' . $text['home'] . '</a></div>';

  } else {

    echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
    if ($show_home_link == 1) {
      echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
      if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
    }

    if ( is_category() ) {
      $this_cat = get_category(get_query_var('cat'), false);
      if ($this_cat->parent != 0) {
        $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
      }
      if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;

    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_link . $slug['slug'] . '/', esc_html( $post_type->labels->singular_name) );
        if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
        if ($show_current == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . esc_html( $post_type->labels->singular_name ) . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $delimiter);
        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
        echo $cats;
      }
      printf($link, esc_url( get_permalink($parent) ), esc_html( $parent->post_title) );
      if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link,  esc_url( get_permalink($page->ID) ), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $delimiter;
        }
      }
      if ($show_current == 1) {
        if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
        echo $before . get_the_title() . $after;
      }

    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;

    /*} elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
     * could not find valid callback for 404 page
     */

    } elseif ( has_post_format() && !is_singular() ) {
      echo  esc_html( get_post_format_string( get_post_format() ) );
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __( 'Page', 'likeawiki' ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div><!-- .breadcrumbs -->';

  }
} // end tari_breadcrumbs

/**
 * Add pagination
 *
 * @uses	paginate_links()
 * @uses	add_query_arg()
 *
 * @since tari 0.1
 */
function likeawiki_pagination() {
	global $wp_query;

	$current = max( 1, get_query_var('paged') );
	$big = 999999999; // need an unlikely integer

	$pagination_return = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => $current,
		'total' => $wp_query->max_num_pages,
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;'
	) );

	if ( ! empty( $pagination_return ) ) {
		echo '<div id="pagination">';
		echo '<div class="total-pages">';
		printf( __( 'Page %1$s of %2$s', 'likeawiki' ), $current, $wp_query->max_num_pages );
		echo '<div class="sep"> </div></div>';
		echo $pagination_return;
		echo '</div>';
	}
}

add_filter( 'wp_title', 'likeawiki_filter_wp_title', 10, 2 );
/**
 * Filters the page title appropriately depending on the current page
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 *
 * @since likeawiki 0.1
 */
function likeawiki_filter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'likeawiki' ), max( $paged, $page ) );

	return $title;
}
/**
 * Programatically add script to mobile menu close link url.
 * @uses javascript void to avoid screen jumping onclick event.
 * 
 * @since 1.31
 * 
 */
function likeawiki_void_link()
{
    
    return esc_js( 'javascript:void(0);' );
}


/**
 * Display toolbox on page
 * @since: 1.31
 * 
 */
add_action( 'likeawiki_display_toolbox', 'likeawiki_display_toolbox_onpage' );
function likeawiki_display_toolbox_onpage()
{
    if( get_theme_mods() ) {

    if ( '1' == get_theme_mod('likeawiki_checkbox') ) : 

      ob_start();
        $options = get_option( 'likeawiki_theme_options' );
        $likeawiki_t1 = (empty( $options['likeawiki_t1'] ) ) 
                      ? false : $options['likeawiki_t1']; 
        $likeawiki_t2 = (empty( $options['likeawiki_t2'] ) ) 
                      ? false : $options['likeawiki_t2']; 
        $likeawiki_t3 = (empty( $options['likeawiki_t3'] ) ) 
                      ? false : $options['likeawiki_t3']; 
        $likeawiki_t4 = (empty( $options['likeawiki_t4'] ) ) 
                      ? false : $options['likeawiki_t4']; 


        echo '<div class="likeawiki-tool-container">
        <table class="likeawiki-tools-top"><tbody>
        <tr><td>
        <ul class="above-law-widget">';
        if( $likeawiki_t1 ) : 
            echo '<li>' . esc_attr( $likeawiki_t1 ) . '</li>'; 
        endif;
        if( $likeawiki_t2 ) :  
            echo '<li>' . esc_attr( $likeawiki_t2 ) . '</li>';
        endif;
        if( $likeawiki_t3 ) : 
            echo '<li>' . esc_attr( $likeawiki_t3 ) .'</li>'; 
        endif;
        if( $likeawiki_t4 ) : 
            echo '<li>' . esc_attr( $likeawiki_t4 ) .'</li>'; 
        endif; 
        echo '<li class="blank-lister"></li></ul>
        </td></tr>
        <tr><td>
        <div class="law-widget-inner">';

            get_sidebar( 'lawwidget' ); 

        echo '</div></td></tr></tbody></table>
        </div>';

    else : 

      $likeawiki_font_size = (empty( $options['likeawiki_font_size'] ) ) 
                           ?  '16' : $options['likeawiki_font_size']; 
        echo '<div class="meta-default">
        <ul>
        <li>' . __( 'To search for a word and highlight it on page use <span>Ctrl + F</span>', 'likeawiki' ) .'</li>
        <li>' . __( 'To copy text from page, highlight text and then <span>Ctrl + C</span>', 'likeawiki' ) .'</li>
        <li>' . __( 'To paste that text into another page, click page then <span>Ctrl + V</span>', 'likeawiki' ) .'</li>
        <li>' . __( 'To search Internet, highlight text then right click <span>Options List</span>', 'likeawiki' ) .'</li>
        <li>' . __( 'Current pixel font size is', 'likeawiki' ) 
        .'<span>' .  esc_attr( $likeawiki_font_size ) .'</span></li>
    &nbsp; <small>' . esc_html__( ' Click Tools to remove', 'likeawiki' ) .'</small>
        </ul>
        </div>';

    endif;

        $output = ob_get_clean();
            
            echo $output;
    }
}

// load customizer 
include_once (get_template_directory() . '/inc/theme-options.php');
?>