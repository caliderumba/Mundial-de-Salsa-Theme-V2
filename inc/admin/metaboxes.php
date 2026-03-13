<?php
/**
 * Metaboxes for Multimedia Articles
 */

function mds_pro_add_metaboxes() {
    add_meta_box(
        'mds_article_settings',
        __( 'Article Settings', 'mundialdesalsa-pro' ),
        'mds_article_settings_callback',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mds_pro_add_metaboxes' );

function mds_article_settings_callback( $post ) {
    wp_nonce_field( 'mds_article_settings_save', 'mds_article_settings_nonce' );

    $subtitle = get_post_meta( $post->ID, '_mds_subtitle', true );
    $format = get_post_meta( $post->ID, '_mds_article_format', true );
    $video_url = get_post_meta( $post->ID, '_mds_video_url', true );
    $audio_url = get_post_meta( $post->ID, '_mds_audio_url', true );
    $is_pick = get_post_meta( $post->ID, '_mds_editor_pick', true );

    ?>
    <p>
        <label><strong><?php _e( 'Article Format', 'mundialdesalsa-pro' ); ?></strong></label><br>
        <select name="mds_article_format" class="widefat">
            <option value="standard" <?php selected( $format, 'standard' ); ?>>Standard</option>
            <option value="video" <?php selected( $format, 'video' ); ?>>Video</option>
            <option value="audio" <?php selected( $format, 'audio' ); ?>>Audio</option>
            <option value="gallery" <?php selected( $format, 'gallery' ); ?>>Gallery</option>
        </select>
    </p>
    <p>
        <label><input type="checkbox" name="mds_editor_pick" value="1" <?php checked( $is_pick, '1' ); ?>> <?php _e( "Mark as Editor's Pick", 'mundialdesalsa-pro' ); ?></label>
    </p>
    <hr>
    <p>
        <label for="mds_subtitle"><?php _e( 'Subtitle', 'mundialdesalsa-pro' ); ?></label><br>
        <input type="text" id="mds_subtitle" name="mds_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat">
    </p>
    <p>
        <label for="mds_video_url"><?php _e( 'Video URL (YouTube/Vimeo)', 'mundialdesalsa-pro' ); ?></label><br>
        <input type="url" id="mds_video_url" name="mds_video_url" value="<?php echo esc_url( $video_url ); ?>" class="widefat">
    </p>
    <p>
        <label for="mds_audio_url"><?php _e( 'Audio URL (Podcast)', 'mundialdesalsa-pro' ); ?></label><br>
        <input type="url" id="mds_audio_url" name="mds_audio_url" value="<?php echo esc_url( $audio_url ); ?>" class="widefat">
    </p>
    <?php
}

function mds_pro_save_metaboxes( $post_id ) {
    if ( ! isset( $_POST['mds_article_settings_nonce'] ) || ! wp_verify_nonce( $_POST['mds_article_settings_nonce'], 'mds_article_settings_save' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    $fields = [
        '_mds_subtitle'       => 'mds_subtitle',
        '_mds_article_format' => 'mds_article_format',
        '_mds_video_url'      => 'mds_video_url',
        '_mds_audio_url'      => 'mds_audio_url',
        '_mds_editor_pick'    => 'mds_editor_pick',
    ];

    foreach ( $fields as $meta_key => $post_key ) {
        if ( isset( $_POST[$post_key] ) ) {
            $val = ( $post_key === 'mds_video_url' || $post_key === 'mds_audio_url' ) ? esc_url_raw( $_POST[$post_key] ) : sanitize_text_field( $_POST[$post_key] );
            update_post_meta( $post_id, $meta_key, $val );
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'mds_pro_save_metaboxes' );
