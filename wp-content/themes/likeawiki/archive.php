<?php
/*
* archive.php
* The archive template. Used when a category, author, or date is queried. 
* Note that this template will be overridden by category.php, author.php, and date.php for their respective query types. 
*/
get_header(); ?>
<div class="row">
    <div id="main">
        <div class="spaces" role="complementary">
            <?php get_sidebar(); ?>
        </div>

            <div id="content" class="end" role="main">
                <h2><?php _e( 'Relative Content', 'likeawiki' ); ?></h2>
                <div id="min-height">
                <?php if ( have_posts() ) : ?>
                    <header id="archive-header">
                        <h1 class="page-title">
                    <?php if ( is_category() ) : ?>
                    <?php echo single_cat_title( '', false ); ?>
                    <?php elseif ( is_author() ) : ?>
                    <?php printf( __( 'Author Archive for %s', 'likeawiki' ), esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ) ); ?>
                    <?php elseif ( is_tag() ) : ?>
                    <?php printf( __( 'Tag Archive for %s', 'likeawiki' ), single_tag_title( '', false ) ); ?>
                    <?php elseif ( is_day() ) : ?>
                    <?php printf( __( 'Daily Archives: %s', 'likeawiki' ), get_the_date() ); ?>
                    <?php elseif ( is_month() ) : ?>
                    <?php printf( __( 'Monthly Archives: %s', 'likeawiki' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'likeawiki' ) ) ); ?>
                    <?php elseif ( is_year() ) : ?>
                    <?php printf( __( 'Yearly Archives: %s', 'likeawiki' ), get_the_date( _x( 'Y', 'yearly archives date format', 'likeawiki' ) ) ); ?>
                <?php else : ?>
                    <?php _e( 'Blog Archives', 'likeawiki' ); ?>
                <?php endif; ?>
                        </h1><!-- .page-title -->
                        <?php if ( is_category() ) :
                            if ( $category_description = category_description() )
                                echo 'category'; /*<h2 class="archive-meta">' . $category_description . '</h2>'; */
                            endif;
                            if ( is_author() ) :
                                $curauth = ( get_query_var('author_name') ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var(' author' ) );
                            if ( isset( $curauth->description ) )
                                echo '<h2 class="archive-meta">' . wp_kses_post( $curauth->description ) . '</h2>';
                            endif;
                            if ( is_tag() ) :
                                if ( $tag_description = tag_description() )
                                echo '<h2 class="archive-meta">' . $tag_description . '</h2>';
                            endif;
                            ?>
                    </header><!-- #archive-header -->
                        <div class="entry">
                            <div class="excerpt-container">
                                <?php while ( have_posts() ) : the_post(); ?>	
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div><!-- .entry-content -->
                                </article><!-- #post-<?php the_ID(); ?> -->
                                <?php endwhile; // end of the loop ?>
                            </div>
                        </div>
                </div><!-- ends min-height -->
            <?php else: ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
                <nav class="navigation">
                    <p><?php posts_nav_link(); ?></p>
                </nav>
            </div><!-- ends content --> 
            
    </div><!-- ends main -->
</div><!-- ends row --><div class="clearfix"></div> 
<?php get_footer(); ?>