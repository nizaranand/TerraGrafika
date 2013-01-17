<?php
/**
 * Creates widget with albums
 */

class Album_Widget extends WP_Widget
{

/**
 * Widget constructor
 *
 * @desc sets default options and controls for widget
 */
	function Album_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'widget_album',
			'description' => __('Display album info', 'ait')
		);

		/* Create the widget */
		$this->WP_Widget('album-widget', __('Theme &rarr; Album', 'ait'), $widget_ops);
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
    global $wpdb;

    /* Before widget(defined by theme)*/
    echo $before_widget;

    echo($before_title.do_shortcode($instance['widget_title']).$after_title);

    $albumThumb = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."ait_album_categorymeta WHERE ait_album_category_id = ".$instance['widget_album']);
    $songs_base = query_posts( array( 'post_type' => 'ait-album', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'ait-album-category', 'field' => 'id', 'terms' => $instance['widget_album']) ) )  );
    wp_reset_query();

    $songLinksString = "";
    foreach($songs_base as $song){
       $info = get_post_meta($song->ID);
       $song->info = unserialize($info['_ait-album'][0]);
       $songLinksString .= $song->post_title.'@'.$song->info['songEmbed'].", ";
    }
    if(!empty($albumThumb[0]->meta_value)){
        echo('<img src="'.TIMTHUMB_URL . '?src='.$albumThumb[0]->meta_value.'&amp;w=210" />');
    }
    echo(do_shortcode('[mp3-jplayer tracks="'.$songLinksString.'" autoplay="'.$instance['player_autoplay'].'" dload="'.$instance['player_download'].'" width="100%" pn="'.$instance['player_controls'].'" stop="'.$instance['player_controls'].'" loop="'.$instance['player_loop'].'" shuffle="'.$instance['player_shuffle'].'" list="'.$instance['player_playlist'].'"]'));


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
    $old_instance['widget_album'] = strip_tags( $new_instance['widget_album'] );
    $old_instance['player_autoplay'] = strip_tags( $new_instance['player_autoplay'] );
    $old_instance['player_loop'] = strip_tags( $new_instance['player_loop'] );
    $old_instance['player_shuffle'] = strip_tags( $new_instance['player_shuffle'] );
    $old_instance['player_controls'] = strip_tags( $new_instance['player_controls'] );
    $old_instance['player_playlist'] = strip_tags( $new_instance['player_playlist'] );
    $old_instance['player_download'] = strip_tags( $new_instance['player_download'] );

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
        'widget_album' => '',
        'player_autoplay' => 'y',
        'player_loop' => 'y',
        'player_shuffle' => 'y',
        'player_controls' => 'y',
        'player_playlist' => 'y',
        'player_download' => 'y'
        ) );
?>
    <p>
        <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget Title', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" value="<?php echo $instance['widget_title']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'widget_album' ); ?>"><?php echo __( 'Album', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'widget_album' ); ?>" name="<?php echo $this->get_field_name( 'widget_album' ); ?>">
            <?php
            global $wpdb;
            $albums = $wpdb->get_results("SELECT ".$wpdb->prefix."terms.* FROM ".$wpdb->prefix."terms LEFT JOIN (".$wpdb->prefix."term_taxonomy) ON (".$wpdb->prefix."terms.term_id = ".$wpdb->prefix."term_taxonomy.term_taxonomy_id) WHERE ".$wpdb->prefix."term_taxonomy.taxonomy='ait-album-category';");
            foreach($albums as $album){
                if($instance['widget_album'] == $album->term_id){
                    echo('<option selected="selected" value="'.$album->term_id.'">'.$album->name.'</option>');
                } else {
                    echo('<option value="'.$album->term_id.'">'.$album->name.'</option>');
                }
            }
            ?>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_autoplay' ); ?>"><?php echo __( 'Autoplay', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_autoplay' ); ?>" name="<?php echo $this->get_field_name( 'player_autoplay' ); ?>">
            <option <?php if ( 'y' == $instance['player_autoplay'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_autoplay'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_loop' ); ?>"><?php echo __( 'Loop', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_loop' ); ?>" name="<?php echo $this->get_field_name( 'player_loop' ); ?>">
            <option <?php if ( 'y' == $instance['player_loop'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_loop'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_shuffle' ); ?>"><?php echo __( 'Shuffle', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_shuffle' ); ?>" name="<?php echo $this->get_field_name( 'player_shuffle' ); ?>">
            <option <?php if ( 'y' == $instance['player_shuffle'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_shuffle'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'player_controls' ); ?>"><?php echo __( 'Display Controls', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_controls' ); ?>" name="<?php echo $this->get_field_name( 'player_controls' ); ?>">
            <option <?php if ( 'y' == $instance['player_controls'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_controls'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'player_playlist' ); ?>"><?php echo __( 'Display Playlist', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_playlist' ); ?>" name="<?php echo $this->get_field_name( 'player_playlist' ); ?>">
            <option <?php if ( 'y' == $instance['player_playlist'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_playlist'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'player_download' ); ?>"><?php echo __( 'Display Download Link', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'player_download' ); ?>" name="<?php echo $this->get_field_name( 'player_download' ); ?>">
            <option <?php if ( 'y' == $instance['player_download'] ) echo 'selected="selected"'; ?> value="y">Yes</option>
            <option <?php if ( 'n' == $instance['player_download'] ) echo 'selected="selected"'; ?> value="n">No</option>
        </select>
    </p>
    <?php
    }
}

register_widget( 'Album_Widget' );