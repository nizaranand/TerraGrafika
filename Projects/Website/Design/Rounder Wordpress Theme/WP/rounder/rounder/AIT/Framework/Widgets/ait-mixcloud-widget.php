<?php
/**
 * Creates widget with albums
 */

class Mixcloud_Widget extends WP_Widget
{

/**
 * Widget constructor
 *
 * @desc sets default options and controls for widget
 */
	function Mixcloud_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'widget_mixcloud',
			'description' => __('Display mixcloud player')
		);

		/* Create the widget */
		$this->WP_Widget('mixcloud-widget', __('Theme &rarr; Mixcloud'), $widget_ops);
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

    echo('<div><object width="100%" height="'.$instance['widget_height'].'"><param name="movie" value="//www.mixcloud.com/media/swf/player/mixcloudLoader.swf?feed='.$instance['player_song'].'&embed_uuid=dae441e6-aeb0-4836-ab7c-dc61fd8b4691&stylecolor=&embed_type=widget_standard"></param><param name="allowFullScreen" value="true"></param><param name="wmode" value="opaque"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.mixcloud.com/media/swf/player/mixcloudLoader.swf?feed='.$instance['player_song'].'&embed_uuid=dae441e6-aeb0-4836-ab7c-dc61fd8b4691&stylecolor=&embed_type=widget_standard" type="application/x-shockwave-flash" wmode="opaque" allowscriptaccess="always" allowfullscreen="true" width="210" height="210"></embed></object></div>');

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
        'player_song' => ''
    ) );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget Title' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" value="<?php echo $instance['widget_title']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'widget_height' ); ?>"><?php echo __( 'Widget Height' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_height' ); ?>" name="<?php echo $this->get_field_name( 'widget_height' ); ?>" value="<?php echo $instance['widget_height']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_image' ); ?>"><?php echo __( 'Album image' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'player_image' ); ?>" name="<?php echo $this->get_field_name( 'player_image' ); ?>" value="<?php echo $instance['player_image']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_song' ); ?>"><?php echo __( 'Song url' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'player_song' ); ?>" name="<?php echo $this->get_field_name( 'player_song' ); ?>" value="<?php echo $instance['player_song']; ?>"class="widefat" style="width:100%;" />
    </p>
    <?php
    }
}

register_widget( 'Mixcloud_Widget' );