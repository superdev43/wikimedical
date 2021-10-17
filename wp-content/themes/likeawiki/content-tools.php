<aside id="tool-bar">
    <div id="breadcrumbs">
        <?php likeawiki_breadcrumbs(); ?>
    </div>

        <nav class="toolbar">

            <span><button class="law-button" 
            onclick="toggle_visibility('law-tools');">
            <?php _e( 'Tools', 'likeawiki' ); ?></button></span>

            <div id="law-tools" style="display:none;">
                <div class="likeawiki-tools">
                    <div class="tools-inner">
                                
    <?php if( function_exists( 'likeawiki_display_toolbox_onpage' ) ) : ?>

    <?php do_action( 'likeawiki_display_toolbox' ); ?>
    
    <?php endif; ?>
        
                    </div>
                </div>
            </div>

        </nav>  <div class="clearfix"></div>  
</aside>
