<?php
function get_custom_album( $params ) {
    extract( shortcode_atts( array (
		'excerpt' => 290,
        'description' => 'no',
        'category' => '0',
    ), $params ) );

    global $wpdb;
    $album_categories = get_categories( array( 'taxonomy' => 'ait-album-category', 'orderby' => 'menu_order', 'order' => 'ASC'));
    $albums = array();

    foreach($album_categories as $aCat){
        $album = array();
        $album['id'] = $aCat->term_id;
        $album['name'] = $aCat->name;
        $album['slug'] = $aCat->slug;
        $album['desc'] = $aCat->description;
        $album['tax'] = $aCat->taxonomy;
        $album['link'] = get_term_link( intval($aCat->term_id), "ait-album-category" );
        $thumb = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."ait_album_categorymeta WHERE `ait_album_category_id` = ".$aCat->term_id );
        $album['thumb'] = $thumb[0]->meta_value;
        $album['author'] = $thumb[1]->meta_value;
        $album['order'] = $thumb[3]->meta_value;

        array_push($albums, $album);
    }
    aasort($albums,"order");
    $albums = array_reverse($albums);

    $result = '<div class="albums-holder clearfix">';
    foreach($albums as $album){
        if($category == $album['id']){
            if($description == 'yes'){
                $result .= '<div class="album-shortcode shortcode-descritpion clearfix">';
            } else {
                $result .= '<div class="album-shortcode clearfix">';
            }

            $result .= '<a class="album-image left" href="'.get_term_link( intval($album['id']), "ait-album-category" ).'"><img src="'.$album['thumb'].'" alt="'. $album['name'].'" width="170" height="170"></a>';
            $result .= '<div class="album-name"><h5>'.$album['author'] .' - '.$album['name'].'</h5></div>';
            
            if($description == 'yes'){
              $result .= '<div class="album-description left">'.$album['desc'].'</div>';
            }

            $result .= '</div>';
        } else {
            if($category == 0){
                
                if($description == 'yes'){
                    $result .= '<div class="album-shortcode shortcode-descritpion clearfix">';
                } else {
                    $result .= '<div class="album-shortcode left clearfix">';
                }
                
                $result .= '<a class="album-image" href="'.get_term_link( intval($album['id']), "ait-album-category" ).'"><img src="'.$album['thumb'].'" alt="'. $album['name'].'" width="170" height="170"></a>';
                $result .= '<div class="album-name"><h5>'.$album['author'] .' - '.$album['name'].'</h5></div>';
                
                if($description == 'yes'){
                  $result .= '<div class="album-description left">'.$album['desc'].'</div>';
                }
                
                $result .= '</div>';
            }
        }
    }
    $result .= '</div>';

    return $result;
}
add_shortcode( "get_album", "get_custom_album" );