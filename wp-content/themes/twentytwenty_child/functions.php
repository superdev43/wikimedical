<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' ); 
    function theme_enqueue_styles() 
    { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
	 
	 
	 
	 //REST APIのユーザー無効化
function remove_rest_api_users( $endpoints ) {
	if ( isset( $endpoints['/wp/v2/users'] ) ) {
		unset( $endpoints['/wp/v2/users'] );
	}
	if ( isset( $endpoints['/wp/v2/users/(?P[\d]+)'] ) ) {
		unset( $endpoints['/wp/v2/users/(?P[\d]+)'] );
	}
	return $endpoints;
}
add_filter( 'rest_endpoints', 'remove_rest_api_users');

//コメントCSSクラスの除去
function remove_comments_class( $classes ) {
	foreach ( $classes as $key => $class ) {
		if ( strstr( $class, 'comment-author-' ) ) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}
add_filter( 'comment_class', 'remove_comments_class');

	 
	 
	 
} ?>
