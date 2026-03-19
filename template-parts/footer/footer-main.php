<?php
/**
 * Footer Main Template
 */
?>
<div class="bg-slate-900 dark:bg-black text-white pt-24 pb-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-24">
            <!-- About -->
            <div class="space-y-6">
                <h3 class="text-3xl font-black uppercase italic tracking-tighter">
                    <?php 
                    $site_name = mds_pro_get_option( 'general', 'site_name', 'MundialdeSalsa' );
                    echo esc_html( $site_name );
                    ?><span class="text-emerald-500">.</span>
                </h3>
                <p class="text-slate-400 text-sm font-medium leading-relaxed">
                    La plataforma número uno para los amantes de la salsa. Noticias, eventos, entrevistas y todo lo que necesitas saber sobre el mundo de la salsa.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-emerald-500 transition-all">FB</a>
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-emerald-500 transition-all">IG</a>
                    <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center hover:bg-emerald-500 transition-all">YT</a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-emerald-500">Navegación</h4>
                <ul class="space-y-4 text-sm font-bold text-slate-400">
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
                <ul class="space-y-4 text-sm font-bold text-slate-400">
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
                <ul class="space-y-4 text-sm font-bold text-slate-400">
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

        <div class="border-t border-white/5 pt-12 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">
                <?php 
                $copyright = mds_pro_get_option( 'footer', 'copyright_text', '© ' . date('Y') . ' MundialdeSalsa Pro. Todos los derechos reservados.' );
                echo esc_html( $copyright );
                ?>
            </p>
            <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="#" class="hover:text-white transition-colors">Privacidad</a>
                <a href="#" class="hover:text-white transition-colors">Términos</a>
                <a href="#" class="hover:text-white transition-colors">Publicidad</a>
            </div>
        </div>
    </div>
</div>
