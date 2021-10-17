<?php
/**
 * Advanced Text widget class
 * exmpl url  <iframe width="560" height="315" src="https://www.youtube.com/embed/cpo_OMgi-1Y" frameborder="0" allowfullscreen></iframe>
 */
class Law_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'likewiki-video-text',  // Base ID
             __( 'Likewiki Video Widget', 'likeawiki' )   // Name
        );

        add_action( 'widgets_init', function() {
            register_widget( 'Likewiki_Video_Widget' );
        });

    }

    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );

    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        echo '<div class="textwidget">';

        echo $instance['text'];

        echo '</div>';

        echo $args['after_widget'];

    }

    public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
    $title = $instance[ 'title' ];
    }
    else {
    $title = __( 'Latest Video', 'likeawiki' );
    }

        $text = ! empty( $instance['text'] ) ? $instance['text'] : $text;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'likeawiki' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        <?php

    }

    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

        return $instance;
    }

}
$likeawiki_video_widget = new Law_Widget();
