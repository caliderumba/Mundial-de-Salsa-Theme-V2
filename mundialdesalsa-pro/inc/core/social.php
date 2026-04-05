<?php
/**
 * MundialdeSalsa Pro Social Engine
 * 
 * Logic for social links and sharing.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get social links from theme options.
 * 
 * @return array Social links data.
 */
function mds_get_social_links() {
    $networks = [
        'facebook'  => [ 'label' => 'Facebook',  'icon' => 'fab fa-facebook-f' ],
        'instagram' => [ 'label' => 'Instagram', 'icon' => 'fab fa-instagram' ],
        'youtube'   => [ 'label' => 'YouTube',   'icon' => 'fab fa-youtube' ],
        'twitter'   => [ 'label' => 'Twitter',   'icon' => 'fab fa-x-twitter' ],
        'tiktok'    => [ 'label' => 'TikTok',    'icon' => 'fab fa-tiktok' ],
        'spotify'   => [ 'label' => 'Spotify',   'icon' => 'fab fa-spotify' ],
    ];

    $links = [];

    foreach ( $networks as $key => $data ) {
        $url = mds_pro_get_option( 'social_' . $key . '_url', '' );
        if ( ! empty( $url ) ) {
            $links[$key] = [
                'url'   => $url,
                'label' => $data['label'],
                'icon'  => $data['icon']
            ];
        }
    }

    return $links;
}

/**
 * Render social sharing buttons for a post.
 */
function mds_pro_social_sharing() {
    $post_id   = get_the_ID();
    $permalink = get_permalink( $post_id );
    $title     = get_the_title( $post_id );
    
    $share_links = [
        'facebook' => [
            'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $permalink ),
            'icon'  => 'fab fa-facebook-f',
            'color' => 'bg-[#1877f2]',
            'label' => 'Facebook'
        ],
        'twitter' => [
            'url'   => 'https://twitter.com/intent/tweet?text=' . urlencode( $title ) . '&url=' . urlencode( $permalink ),
            'icon'  => 'fab fa-x-twitter',
            'color' => 'bg-[#000000]',
            'label' => 'X'
        ],
        'whatsapp' => [
            'url'   => 'https://api.whatsapp.com/send?text=' . urlencode( $title . ' ' . $permalink ),
            'icon'  => 'fab fa-whatsapp',
            'color' => 'bg-[#25d366]',
            'label' => 'WhatsApp'
        ]
    ];

    ?>
    <div class="mds-social-sharing flex flex-wrap gap-4 mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
        <span class="w-full text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2"><?php esc_html_e( 'Comparte esta historia:', 'mundialdesalsa-pro' ); ?></span>
        <?php foreach ( $share_links as $network => $data ) : ?>
            <a 
                href="<?php echo esc_url( $data['url'] ); ?>" 
                target="_blank" 
                rel="noopener" 
                class="flex items-center gap-3 px-6 py-3 <?php echo esc_attr( $data['color'] ); ?> text-white text-xs font-black uppercase italic tracking-tighter hover:translate-x-1 hover:-translate-y-1 transition-transform shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]"
                title="<?php echo sprintf( esc_attr__( 'Compartir en %s', 'mundialdesalsa-pro' ), $data['label'] ); ?>"
            >
                <i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
                <span><?php echo esc_html( $data['label'] ); ?></span>
            </a>
        <?php endforeach; ?>
        
        <button 
            id="mds-copy-link" 
            class="flex items-center gap-3 px-6 py-3 bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white text-xs font-black uppercase italic tracking-tighter hover:translate-x-1 hover:-translate-y-1 transition-transform shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]"
            data-url="<?php echo esc_url( $permalink ); ?>"
            title="<?php esc_attr_e( 'Copiar enlace', 'mundialdesalsa-pro' ); ?>"
        >
            <i class="fa-solid fa-link"></i>
            <span class="copy-text"><?php esc_html_e( 'Copiar Enlace', 'mundialdesalsa-pro' ); ?></span>
        </button>
    </div>
    <?php
}
