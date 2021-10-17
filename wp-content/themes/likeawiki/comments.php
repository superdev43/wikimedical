<?php
/*
 * comments 
 * @likeawiki
 */
    if ( post_password_required() )
        return;
if ( have_comments() ) : ?>
<br>  
    <aside id="comments">
        <h2 class="comments-title"><?php get_the_title() ?></h2>
            
                <ol class="commentlist">
                <?php wp_list_comments(); ?>
                </ol><!-- ends commentlist -->
                <div class="navigation">
                  <div class="alignleft"><?php previous_comments_link() ?></div>
                  <div class="alignright"><?php next_comments_link() ?></div>
                </div>
   
        <?php comment_form(); ?><hr>
    </aside><!-- #comments .comments-area -->
<?php endif; // end have_comments() ?>