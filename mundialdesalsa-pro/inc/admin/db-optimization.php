<?php
/**
 * Database Optimization Module - Mundial de Salsa Pro
 * 
 * Provides tools to clean up the database from revisions, transients, and other junk.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add sub-menu for Database Optimization
 */
function mds_pro_db_optimization_menu() {
    add_submenu_page(
        'mds_pro_options_panel', // Parent slug (Redux panel slug)
        __( 'Optimización BD', 'mundialdesalsa-pro' ),
        __( 'Optimización BD', 'mundialdesalsa-pro' ),
        'manage_options',
        'mds-pro-db-optimization',
        'mds_pro_db_optimization_page'
    );
}
add_action( 'admin_menu', 'mds_pro_db_optimization_menu', 20 );

/**
 * Render the optimization page
 */
function mds_pro_db_optimization_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Handle Actions
    $message = '';
    if ( isset( $_POST['mds_pro_optimize_db'] ) && check_admin_referer( 'mds_pro_db_opt_nonce' ) ) {
        $action = sanitize_text_field( $_POST['mds_pro_optimize_db'] );
        $count = 0;

        switch ( $action ) {
            case 'revisions':
                $count = mds_pro_clean_revisions();
                $message = sprintf( __( 'Se han eliminado %d revisiones antiguas.', 'mundialdesalsa-pro' ), $count );
                break;
            case 'transients':
                $count = mds_pro_clean_transients();
                $message = sprintf( __( 'Se han eliminado %d transientes expirados.', 'mundialdesalsa-pro' ), $count );
                break;
            case 'autodrafts':
                $count = mds_pro_clean_autodrafts();
                $message = sprintf( __( 'Se han eliminado %d borradores automáticos.', 'mundialdesalsa-pro' ), $count );
                break;
            case 'orphan_meta':
                $count = mds_pro_clean_orphan_meta();
                $message = sprintf( __( 'Se han eliminado %d metadatos huérfanos.', 'mundialdesalsa-pro' ), $count );
                break;
        }
    }

    ?>
    <div class="wrap mds-pro-admin-wrap">
        <h1 class="wp-heading-inline"><?php _e( 'Optimización de Base de Datos', 'mundialdesalsa-pro' ); ?></h1>
        <hr class="wp-header-end">

        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible"><p><?php echo $message; ?></p></div>
        <?php endif; ?>

        <div class="card" style="max-width: 800px; margin-top: 20px; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <h2 class="title" style="font-weight: 900; text-transform: uppercase; letter-spacing: -0.025em; font-style: italic; color: #0f172a;"><?php _e( 'Mantenimiento Preventivo', 'mundialdesalsa-pro' ); ?></h2>
            <p><?php _e( 'Utiliza estas herramientas para mantener tu base de datos ligera y rápida. Se recomienda realizar un backup antes de proceder.', 'mundialdesalsa-pro' ); ?></p>
            
            <table class="widefat striped" style="margin-top: 20px; border: none;">
                <thead>
                    <tr>
                        <th style="font-weight: 900;"><?php _e( 'Acción', 'mundialdesalsa-pro' ); ?></th>
                        <th style="font-weight: 900;"><?php _e( 'Descripción', 'mundialdesalsa-pro' ); ?></th>
                        <th style="font-weight: 900;"><?php _e( 'Ejecutar', 'mundialdesalsa-pro' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?php _e( 'Revisiones', 'mundialdesalsa-pro' ); ?></strong></td>
                        <td><?php _e( 'Elimina todas las revisiones de posts excepto las últimas 5.', 'mundialdesalsa-pro' ); ?></td>
                        <td>
                            <form method="post">
                                <?php wp_nonce_field( 'mds_pro_db_opt_nonce' ); ?>
                                <button type="submit" name="mds_pro_optimize_db" value="revisions" class="button button-secondary"><?php _e( 'Limpiar', 'mundialdesalsa-pro' ); ?></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php _e( 'Transientes', 'mundialdesalsa-pro' ); ?></strong></td>
                        <td><?php _e( 'Elimina todos los transientes expirados de la tabla options.', 'mundialdesalsa-pro' ); ?></td>
                        <td>
                            <form method="post">
                                <?php wp_nonce_field( 'mds_pro_db_opt_nonce' ); ?>
                                <button type="submit" name="mds_pro_optimize_db" value="transients" class="button button-secondary"><?php _e( 'Limpiar', 'mundialdesalsa-pro' ); ?></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php _e( 'Borradores', 'mundialdesalsa-pro' ); ?></strong></td>
                        <td><?php _e( 'Elimina borradores automáticos antiguos.', 'mundialdesalsa-pro' ); ?></td>
                        <td>
                            <form method="post">
                                <?php wp_nonce_field( 'mds_pro_db_opt_nonce' ); ?>
                                <button type="submit" name="mds_pro_optimize_db" value="autodrafts" class="button button-secondary"><?php _e( 'Limpiar', 'mundialdesalsa-pro' ); ?></button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php _e( 'Meta Huérfana', 'mundialdesalsa-pro' ); ?></strong></td>
                        <td><?php _e( 'Elimina metadatos de posts que ya no existen.', 'mundialdesalsa-pro' ); ?></td>
                        <td>
                            <form method="post">
                                <?php wp_nonce_field( 'mds_pro_db_opt_nonce' ); ?>
                                <button type="submit" name="mds_pro_optimize_db" value="orphan_meta" class="button button-secondary"><?php _e( 'Limpiar', 'mundialdesalsa-pro' ); ?></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * Clean Revisions
 */
function mds_pro_clean_revisions() {
    global $wpdb;
    $revisions = $wpdb->get_results( "SELECT ID, post_parent FROM $wpdb->posts WHERE post_type = 'revision' ORDER BY post_date DESC" );
    $count = 0;
    $keep = [];

    foreach ( $revisions as $revision ) {
        if ( ! isset( $keep[$revision->post_parent] ) ) {
            $keep[$revision->post_parent] = 0;
        }
        
        if ( $keep[$revision->post_parent] < 5 ) {
            $keep[$revision->post_parent]++;
        } else {
            wp_delete_post_revision( $revision->ID );
            $count++;
        }
    }
    return $count;
}

/**
 * Clean Transients
 */
function mds_pro_clean_transients() {
    global $wpdb;
    $sql = "DELETE a, b FROM $wpdb->options a, $wpdb->options b
            WHERE a.option_name LIKE '_transient_%'
            AND a.option_name NOT LIKE '_transient_timeout_%'
            AND b.option_name = CONCAT('_transient_timeout_', SUBSTRING(a.option_name, 12))
            AND b.option_value < UNIX_TIMESTAMP()";
    return $wpdb->query( $sql );
}

/**
 * Clean Auto-drafts
 */
function mds_pro_clean_autodrafts() {
    global $wpdb;
    $sql = "DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'";
    return $wpdb->query( $sql );
}

/**
 * Clean Orphan Meta
 */
function mds_pro_clean_orphan_meta() {
    global $wpdb;
    $sql = "DELETE pm FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL";
    return $wpdb->query( $sql );
}
