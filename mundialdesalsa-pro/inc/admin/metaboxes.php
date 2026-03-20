<?php
/**
 * Custom Metaboxes for Reviews and Playlists
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Review Metabox
 */
function mds_pro_add_review_meta_box() {
    add_meta_box(
        'mds_pro_review_meta',
        __( 'Sistema de Críticas (Review)', 'mundialdesalsa-pro' ),
        'mds_pro_review_meta_box_callback',
        'post',
        'normal',
        'high'
    );

    add_meta_box(
        'mds_pro_playlist_meta',
        __( 'Configuración de Audio', 'mundialdesalsa-pro' ),
        'mds_pro_playlist_meta_box_callback',
        'post',
        'side'
    );
}
add_action( 'add_meta_boxes', 'mds_pro_add_review_meta_box' );

/**
 * Review Metabox Callback
 */
function mds_pro_review_meta_box_callback( $post ) {
    wp_nonce_field( 'mds_pro_save_review_meta', 'mds_pro_review_nonce' );
    
    $rating = get_post_meta( $post->ID, '_mds_pro_review_rating', true );
    $pros   = get_post_meta( $post->ID, '_mds_pro_review_pros', true );
    $cons   = get_post_meta( $post->ID, '_mds_pro_review_cons', true );
    ?>
    <div class="mds-metabox-field mb-4">
        <label class="block font-bold mb-2" for="mds_pro_review_rating"><?php _e( 'Puntuación (1-5)', 'mundialdesalsa-pro' ); ?></label>
        <input type="number" id="mds_pro_review_rating" name="mds_pro_review_rating" value="<?php echo esc_attr( $rating ); ?>" min="1" max="5" step="0.5" class="widefat" />
    </div>
    <div class="mds-metabox-field mb-4">
        <label class="block font-bold mb-2" for="mds_pro_review_pros"><?php _e( 'Pros (Uno por línea)', 'mundialdesalsa-pro' ); ?></label>
        <textarea id="mds_pro_review_pros" name="mds_pro_review_pros" rows="4" class="widefat"><?php echo esc_textarea( $pros ); ?></textarea>
    </div>
    <div class="mds-metabox-field">
        <label class="block font-bold mb-2" for="mds_pro_review_cons"><?php _e( 'Contras (Uno por línea)', 'mundialdesalsa-pro' ); ?></label>
        <textarea id="mds_pro_review_cons" name="mds_pro_review_cons" rows="4" class="widefat"><?php echo esc_textarea( $cons ); ?></textarea>
    </div>
    <?php
}

/**
 * Playlist Metabox Callback
 */
function mds_pro_playlist_meta_box_callback( $post ) {
    wp_nonce_field( 'mds_pro_save_playlist_meta', 'mds_pro_playlist_nonce' );
    $url = get_post_meta( $post->ID, '_mds_playlist_url', true );
    ?>
    <p><?php _e( 'Pega aquí la URL de Spotify o Soundcloud para el reproductor flotante.', 'mundialdesalsa-pro' ); ?></p>
    <input type="url" id="mds_playlist_url" name="mds_playlist_url" value="<?php echo esc_url( $url ); ?>" class="widefat" placeholder="https://open.spotify.com/..." />
    <?php
}

/**
 * Save Metabox Data
 */
function mds_pro_save_custom_meta( $post_id ) {
    // Review Nonce
    if ( isset( $_POST['mds_pro_review_nonce'] ) && wp_verify_nonce( $_POST['mds_pro_review_nonce'], 'mds_pro_save_review_meta' ) ) {
        if ( isset( $_POST['mds_pro_review_rating'] ) ) {
            update_post_meta( $post_id, '_mds_pro_review_rating', sanitize_text_field( $_POST['mds_pro_review_rating'] ) );
        }
        if ( isset( $_POST['mds_pro_review_pros'] ) ) {
            update_post_meta( $post_id, '_mds_pro_review_pros', sanitize_textarea_field( $_POST['mds_pro_review_pros'] ) );
        }
        if ( isset( $_POST['mds_pro_review_cons'] ) ) {
            update_post_meta( $post_id, '_mds_pro_review_cons', sanitize_textarea_field( $_POST['mds_pro_review_cons'] ) );
        }
    }

    // Playlist Nonce
    if ( isset( $_POST['mds_pro_playlist_nonce'] ) && wp_verify_nonce( $_POST['mds_pro_playlist_nonce'], 'mds_pro_save_playlist_meta' ) ) {
        if ( isset( $_POST['mds_playlist_url'] ) ) {
            update_post_meta( $post_id, '_mds_playlist_url', esc_url_raw( $_POST['mds_playlist_url'] ) );
        }
    }
}
add_action( 'save_post', 'mds_pro_save_custom_meta' );
