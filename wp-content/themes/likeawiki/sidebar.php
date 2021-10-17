<?php
/**
* The Sidebar containing the main widget areas.
* @likeawiki
* @since likewiki 1.0
*/
?>
<section id="sidebar">

    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    
    <?php dynamic_sidebar('sidebar'); ?><br>
    
        <?php else : ?>
    
        <div class="meta-default">

            <?php the_widget( 'WP_Widget_Categories', '', '' ); ?>
                <?php get_search_form(); ?>
                    <hr>
                        <ul><?php wp_loginout(); ?></ul><br>
        </div>

    <?php endif;  ?>

</section><!-- ends secondary - widget-area -->