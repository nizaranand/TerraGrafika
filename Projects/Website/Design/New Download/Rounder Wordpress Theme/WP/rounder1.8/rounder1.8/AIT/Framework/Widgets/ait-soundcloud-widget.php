<?php
/**
 * Creates widget with albums
 */

class Soundcloud_Widget extends WP_Widget
{

/**
 * Widget constructor
 *
 * @desc sets default options and controls for widget
 */
	function Soundcloud_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'widget_soundcloud',
			'description' => __('Display soundcloud player', 'ait')
		);

		/* Create the widget */
		$this->WP_Widget('soundcloud-widget', __('Theme &rarr; Soundcloud', 'ait'), $widget_ops);
	}

/**
 * Displaying the widget
 *
 * Handle the display of the widget
 * @param array
 * @param array
 */
function widget ( $args, $instance ) {
    extract ($args);

    /* Before widget(defined by theme)*/
    echo $before_widget;

    echo('<div class="box widget-container widget_album" id="featured-5689">');
    echo('<div class="box-wrapper">');
    echo($before_title.do_shortcode($instance['widget_title']).$after_title);

    if(!empty($instance['player_image'])){
    echo('<img src="'.TIMTHUMB_URL . '?src='.$instance['player_image'].'&amp;w=210" />');
    }

    echo('<iframe width="100%" height="'.$instance['widget_height'].'" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url='.$instance['player_song'].'&amp;auto_play='.$instance['player_autoplay'].'&amp;show_artwork='.$instance['player_artwork'].'&amp;color='.$instance['player_color'].'"></iframe>');

    echo('</div>');
    echo('</div>');

    /* After widget(defined by theme)*/
    echo $after_widget;
}

/**
 * Update and save widget
 *
 * @param array $new_instance
 * @param array $old_instance
 * @return array New widget values
 */
function update ( $new_instance, $old_instance ) {
    $old_instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
    $old_instance['widget_height'] = strip_tags( $new_instance['widget_height'] );
    $old_instance['player_image'] = strip_tags( $new_instance['player_image'] );
    $old_instance['player_song'] = strip_tags( $new_instance['player_song'] );
    $old_instance['player_autoplay'] = strip_tags( $new_instance['player_autoplay'] );
    $old_instance['player_artwork'] = strip_tags( $new_instance['player_artwork'] );
    $old_instance['player_color'] = strip_tags( $new_instance['player_color'] );

    return $old_instance;
}


/**
 * Creates widget controls or settings
 *
 * @param array Return widget options form
 */

function form ( $instance ) {
    $instance = wp_parse_args( (array) $instance, array(
        'widget_title' => '',
        'widget_height' => 300,
        'player_image' => '',
        'player_song' => '',
        'player_autoplay' => true,
        'player_artwork' => true,
        'player_color' => ''
    ) );
?>
    <p>
        <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget Title', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" value="<?php echo $instance['widget_title']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'widget_height' ); ?>"><?php echo __( 'Widget Height', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_height' ); ?>" name="<?php echo $this->get_field_name( 'widget_height' ); ?>" value="<?php echo $instance['widget_height']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_image' ); ?>"><?php echo __( 'Album image', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'player_image' ); ?>" name="<?php echo $this->get_field_name( 'player_image' ); ?>" value="<?php echo $instance['player_image']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_song' ); ?>"><?php echo __( 'Song url', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'player_song' ); ?>" name="<?php echo $this->get_field_name( 'player_song' ); ?>" value="<?php echo $instance['player_song']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_autoplay' ); ?>"><?php echo __( 'Autoplay', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_autoplay' ); ?>" name="<?php echo $this->get_field_name( 'player_autoplay' ); ?>">
            <option <?php if ( 'true' == $instance['player_autoplay'] ) echo 'selected="selected"'; ?> value="true">Yes</option>
            <option <?php if ( 'false' == $instance['player_autoplay'] ) echo 'selected="selected"'; ?> value="false">No</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_artwork' ); ?>"><?php echo __( 'Show artwork', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_artwork' ); ?>" name="<?php echo $this->get_field_name( 'player_artwork' ); ?>">
            <option <?php if ( 'true' == $instance['player_artwork'] ) echo 'selected="selected"'; ?> value="true">Yes</option>
            <option <?php if ( 'false' == $instance['player_artwork'] ) echo 'selected="selected"'; ?> value="false">No</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_color' ); ?>"><?php echo __( 'Player color', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'player_color' ); ?>" name="<?php echo $this->get_field_name( 'player_color' ); ?>" value="<?php echo $instance['player_color']; ?>"class="widefat" style="width:100%;" />
    </p>

    <?php
    }
}

register_widget( 'Soundcloud_Widget' );