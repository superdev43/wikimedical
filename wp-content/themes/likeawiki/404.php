<?php
/*
 * 404 template
 * The 'page-not-found' template.
 */ 
get_header(); ?>
<div class="row">
    <div id="main">
        <div class="spaces" role="complementary">
            <?php get_sidebar(); ?>
        </div>
            <section id="content" class="end" role="main">
               <div id="min-height" class="page-not-found">
                   <h1>!!!!!!!!!!!!!!!!!!!! <?php _e( '404 error, Page Not Found', 'likeawiki' ); ?> !!!!!!!!!!!!!!!!!!!</h1> 
                       <?php get_search_form(); ?>   
               </div>
            </section><!-- ends content --> <div class="clearfix"></div>
    </div><!-- ends main -->
</div><div class="clearfix"></div> 
<?php get_footer(); ?>