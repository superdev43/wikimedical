<?php
/*
 * index 
 * The main template.
 */ 
get_header(); ?>
<div class="row">
    <div id="main">
        <div class="spaces" role="complementary">
            <?php get_sidebar(); ?>
        </div>
            <section id="content" class="end" role="main">
                <div id="min-height">
                
                    <?php get_template_part( 'content' ); ?> 
                        
                        <?php comments_template(); ?>  

                </div>  
            </section><!-- ends content --> <div class="clearfix"></div> 
    </div><!-- ends main -->
</div>
<?php get_footer(); ?>