<?php
/*
 * the loop!
 * Please note that trackback rdf must stay in comment for XHTML 
 * to work with HTML. Do not remove comment element.
*/
?>
    <article class="content-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark">
<?php the_title(); ?></a></h1>
            </header>
                <div class="entry">
                    <?php if ( has_post_thumbnail() ) { 
                          the_post_thumbnail(); 
                          } else {
                              echo '<div class="hidden"></div>';
                          } ?>
                        <?php the_content(); ?>
                            <?php wp_link_pages(); ?><div class="clearfix"></div>
                    <div class="metadata">
                        <?php if ( ! is_single() ) : ?>  
                            <p><?php the_date(); ?> | <span><?php the_author() ?></span></p>
                        <?php else : ?>
                            <p><span class="linkcat"><?php _e( 'Filed under: ', 'likeawiki' ); ?> <?php the_category(',') ?> </span> -  @ <?php the_time() ?> <?php edit_post_link(__( 'Edit This', 'likeawiki' )); ?></p>
                            <p class="taglink"><?php the_tags(); ?></p>
                        <?php endif; ?>
                    </div>
                                
                </div>   
            <!--
            <?php trackback_rdf(); ?>
            -->
        <?php endwhile; else: ?>
            <?php get_template_part( 'content', 'none' ); ?>   
    <?php endif; ?>
        <div class="article-footer"><hr></div>
    </article>

        <?php get_template_part( 'page-nav' ); ?>