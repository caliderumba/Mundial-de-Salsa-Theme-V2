<?php
/**
 * Footer Main Template
 */
$footer_layout = mds_pro_get_option( 'footer', 'footer_layout', 'standard' );
$footer_bg     = mds_pro_get_option( 'footer', 'footer_bg_color', '#111827' );
$footer_text   = mds_pro_get_option( 'footer', 'footer_text_color', '#9ca3af' );
?>
<div class="pt-24 pb-12" style="background-color: <?php echo esc_attr( $footer_bg ); ?>; color: <?php echo esc_attr( $footer_text ); ?>;">
    <div class="container mx-auto px-4">
        <?php if ( 'standard' === $footer_layout ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-24">
                <!-- About -->
                <div class="space-y-6">
                    <h3 class="text-3xl font-black uppercase italic tracking-tighter text-white">
                        <?php 
                        $site_name = mds_pro_get_option( 'general', 'site_name', 'MundialdeSalsa' );
                        echo esc_html( $site_name );
                        ?><span class="text-emerald-500">.</span>
                    </h3>
                    <p class="text-sm font-medium leading-relaxed opacity-80">
                        La plataforma número uno para los amantes de la salsa. Noticias, eventos, entrevistas y todo lo que necesitas saber sobre el mundo de la salsa.
                    </p>
                    <div class="flex gap-4">
                        <?php
                        $social_links = array(
                            'facebook'  => mds_pro_get_option( 'social', 'facebook_url', '#' ),
                            'instagram' => mds_pro_get_option( 'social', 'instagram_url', '#' ),
                            'youtube'   => mds_pro_get_option( 'social', 'youtube_url', '#' ),
                            'tiktok'    => mds_pro_get_option( 'social', 'tiktok_url', '#' ),
                            'twitter'   => mds_pro_get_option( 'social', 'twitter_url', '#' ),
                        );
                        foreach ( $social_links as $network => $url ) :
                            if ( $url && $url !== '#' ) : ?>
                                <a href="<?php echo esc_url( $url ); ?>" target="_blank" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-emerald-500 transition-all uppercase text-[10px] font-bold text-white">
                                    <?php echo substr($network, 0, 2); ?>
                                </a>
                            <?php endif;
                        endforeach; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-emerald-500">Navegación</h4>
                    <ul class="space-y-4 text-sm font-bold opacity-80">
                        <li><a href="#" class="hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Noticias</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Eventos</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Artistas</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Entrevistas</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-emerald-500">Categorías</h4>
                    <ul class="space-y-4 text-sm font-bold opacity-80">
                        <li><a href="#" class="hover:text-white transition-colors">Salsa Brava</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Salsa Romántica</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Timba Cubana</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pachanga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Boogaloo</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-emerald-500">Contacto</h4>
                    <ul class="space-y-4 text-sm font-bold opacity-80">
                        <li class="flex items-center gap-3">
                            <span>📍</span>
                            Cali, Valle del Cauca, Colombia
                        </li>
                        <li class="flex items-center gap-3">
                            <span>📧</span>
                            info@mundialdesalsa.com
                        </li>
                        <li class="flex items-center gap-3">
                            <span>📞</span>
                            +57 300 123 4567
                        </li>
                    </ul>
                </div>
            </div>
        <?php elseif ( 'widgets' === $footer_layout ) : ?>
            <!-- Widgets Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-24">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <!-- Simple Layout -->
            <div class="flex flex-col items-center text-center mb-12 space-y-6">
                <h3 class="text-3xl font-black uppercase italic tracking-tighter text-white">
                    <?php echo esc_html( mds_pro_get_option( 'general', 'site_name', 'MundialdeSalsa' ) ); ?><span class="text-emerald-500">.</span>
                </h3>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors text-xs font-bold uppercase tracking-widest">Inicio</a>
                    <a href="#" class="hover:text-white transition-colors text-xs font-bold uppercase tracking-widest">Noticias</a>
                    <a href="#" class="hover:text-white transition-colors text-xs font-bold uppercase tracking-widest">Eventos</a>
                    <a href="#" class="hover:text-white transition-colors text-xs font-bold uppercase tracking-widest">Contacto</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="border-t border-white/5 pt-12 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-[10px] font-black uppercase tracking-widest opacity-60">
                <?php 
                $copyright = mds_pro_get_option( 'footer', 'copyright_text', '© ' . date('Y') . ' MundialdeSalsa Pro. Todos los derechos reservados.' );
                echo wp_kses_post( $copyright );
                ?>
            </div>
            <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest opacity-60">
                <a href="#" class="hover:text-white transition-colors">Privacidad</a>
                <a href="#" class="hover:text-white transition-colors">Términos</a>
                <a href="#" class="hover:text-white transition-colors">Publicidad</a>
            </div>
        </div>
    </div>
</div>
