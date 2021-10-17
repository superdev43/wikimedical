<?php
/**
* The Sidebar containing the video widget areas.
* @likeawiki
* @since likewiki 1.1
*/
?>
<section id="sidebar-law-widget">

    <?php if ( is_active_sidebar( 'sidebar-lawwidget' ) ) : ?>
    
    <?php dynamic_sidebar( 'sidebar-lawwidget'); ?>

    <?php endif;  ?>

</section>