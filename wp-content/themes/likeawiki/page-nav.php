<?php if( is_single() ) { ?>
<div id="navigation">
    <p><?php previous_post_link();  ?> <span> &#8656; <?php _e( 'More Pages', 'likeawiki' ); ?> &#8658; </span> <?php next_post_link(); ?></p>
</div>
<?php } elseif( is_category() || is_tag() || is_archive() || is_author() ) { ?>
        <div id="navigation">
            <p><?php posts_nav_link(); ?></p>
        </div>
<?php } elseif( is_home() || is_front_page() && is_home() || is_paged() ) { ?>
 <div id="pagination">
            <p><?php likeawiki_pagination(); ?></p>
        </div>
<?php } else { echo '<div class="no-menu"></div>'; } ?>