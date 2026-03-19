<?php
/**
 * Homepage Layout: Magazine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Helper to get dummy posts if none exist
function mds_pro_get_dummy_posts($count = 5) {
    $posts = [];
    $titles = [
        'El Renacimiento de la Salsa en Cali: Festival 2026',
        'Entrevista Exclusiva con Marc Anthony: "Mi Vida es la Música"',
        'Los 10 Mejores Pasos de Salsa para Principiantes',
        'Historia de la Fania All Stars: El Sonido de Nueva York',
        'Cómo la Salsa Conquistó el Mundo: De Cuba a Japón',
        'La Evolución del Estilo de Baile en Puerto Rico',
        'Nuevos Lanzamientos: Los Álbumes que Debes Escuchar',
        'Detrás de Escena: La Vida de un Músico de Gira'
    ];
    $categories = ['Noticias', 'Eventos', 'Artistas', 'Entrevistas'];
    
    for ($i = 0; $i < $count; $i++) {
        $posts[] = (object)[
            'ID' => $i + 1000,
            'post_title' => $titles[$i % count($titles)],
            'post_excerpt' => 'Descubre los secretos mejor guardados de la escena salsera mundial en este reportaje exclusivo...',
            'category' => $categories[$i % count($categories)],
            'image' => 'https://picsum.photos/seed/salsa' . $i . '/1200/800',
            'date' => date('M d, Y'),
            'author' => 'Redacción MDS'
        ];
    }
    return $posts;
}

$featured_posts = mds_pro_get_dummy_posts(3);
$category_posts = mds_pro_get_dummy_posts(8);
$latest_posts = mds_pro_get_dummy_posts(12);
?>

<main id="primary" class="site-main magazine-homepage bg-slate-50 dark:bg-slate-950">
    
    <!-- 1. HERO SECTION (Editorial Style) -->
    <section class="featured-hero-section container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Hero -->
            <div class="lg:col-span-8 relative h-[600px] overflow-hidden rounded-3xl group shadow-2xl">
                <img src="<?php echo $featured_posts[0]->image; ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 p-12 text-white max-w-3xl">
                    <span class="bg-emerald-500 text-[10px] font-black uppercase tracking-[0.3em] px-4 py-2 rounded-full mb-6 inline-block">
                        <?php echo $featured_posts[0]->category; ?>
                    </span>
                    <h2 class="text-4xl md:text-6xl font-black mb-6 leading-[0.9] italic tracking-tighter">
                        <a href="#" class="text-white hover:text-emerald-400 transition-colors"><?php echo $featured_posts[0]->post_title; ?></a>
                    </h2>
                    <p class="text-slate-300 text-lg font-medium mb-8 line-clamp-2"><?php echo $featured_posts[0]->post_excerpt; ?></p>
                    <div class="flex items-center gap-6 text-xs font-black uppercase tracking-widest text-emerald-400">
                        <span>Por <?php echo $featured_posts[0]->author; ?></span>
                        <span class="w-1 h-1 bg-slate-500 rounded-full"></span>
                        <span><?php echo $featured_posts[0]->date; ?></span>
                    </div>
                </div>
            </div>

            <!-- Secondary Hero Items -->
            <div class="lg:col-span-4 flex flex-col gap-8">
                <?php for($i=1; $i<3; $i++): ?>
                <div class="relative flex-1 min-h-[280px] overflow-hidden rounded-3xl group shadow-xl">
                    <img src="<?php echo $featured_posts[$i]->image; ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 p-8 text-white">
                        <span class="text-emerald-400 text-[10px] font-black uppercase tracking-widest mb-2 block"><?php echo $featured_posts[$i]->category; ?></span>
                        <h3 class="text-xl font-black leading-tight italic tracking-tight">
                            <a href="#" class="text-white hover:text-emerald-400 transition-colors"><?php echo $featured_posts[$i]->post_title; ?></a>
                        </h3>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- 2. FEATURED GRID (Bento Style) -->
    <section class="container mx-auto px-4 py-12">
        <div class="flex items-center gap-4 mb-12">
            <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white">Destacados <span class="text-emerald-500">MDS</span></h2>
            <div class="h-[2px] bg-slate-200 dark:bg-slate-800 flex-1"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach(array_slice($category_posts, 0, 4) as $post): ?>
            <article class="group bg-white dark:bg-slate-900 p-4 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="aspect-[4/3] overflow-hidden rounded-2xl mb-6 relative">
                    <img src="<?php echo $post->image; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-slate-900 dark:text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-lg">
                            <?php echo $post->category; ?>
                        </span>
                    </div>
                </div>
                <h3 class="text-lg font-black leading-tight italic tracking-tight mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
                    <a href="#"><?php echo $post->post_title; ?></a>
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?php echo $post->date; ?></span>
                    <button class="w-8 h-8 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all text-slate-900 dark:text-slate-200">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 3. VIDEO SECTION (Immersive) -->
    <section class="bg-slate-900 py-24 text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-emerald-500/10 blur-[120px] rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
                <div>
                    <span class="text-emerald-400 text-xs font-black uppercase tracking-[0.4em] mb-4 block">Contenido Multimedia</span>
                    <h2 class="text-5xl font-black uppercase italic tracking-tighter">Videos & <span class="text-emerald-500">Entrevistas</span></h2>
                </div>
                <button class="bg-white text-slate-900 px-8 py-4 rounded-full font-black uppercase tracking-widest text-xs hover:bg-emerald-500 hover:text-white transition-all">Ver Todo el Canal</button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <?php foreach(array_slice($latest_posts, 0, 3) as $post): ?>
                <div class="group cursor-pointer">
                    <div class="aspect-video overflow-hidden rounded-[2rem] relative shadow-2xl mb-8">
                        <img src="<?php echo $post->image; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-60" alt="">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 bg-emerald-500 rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="bg-black/40 backdrop-blur-md p-4 rounded-2xl border border-white/10">
                                <h3 class="text-lg font-bold leading-tight italic"><?php echo $post->post_title; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 4. LATEST NEWS + SIDEBAR -->
    <section class="container mx-auto px-4 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- News Feed -->
            <div class="lg:col-span-8 space-y-12">
                <div class="flex items-center gap-4 mb-12">
                    <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white">Últimas <span class="text-emerald-500">Noticias</span></h2>
                    <div class="h-[2px] bg-slate-200 dark:bg-slate-800 flex-1"></div>
                </div>

                <div class="space-y-12">
                    <?php foreach(array_slice($latest_posts, 3, 6) as $post): ?>
                    <article class="flex flex-col md:flex-row gap-8 group">
                        <div class="md:w-2/5 aspect-[16/10] overflow-hidden rounded-3xl shadow-lg">
                            <img src="<?php echo $post->image; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="">
                        </div>
                        <div class="md:w-3/5 flex flex-col justify-center">
                            <span class="text-emerald-500 text-[10px] font-black uppercase tracking-widest mb-4 block"><?php echo $post->category; ?></span>
                            <h3 class="text-2xl font-black leading-tight italic tracking-tight mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
                                <a href="#"><?php echo $post->post_title; ?></a>
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 line-clamp-2"><?php echo $post->post_excerpt; ?></p>
                            <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span><?php echo $post->author; ?></span>
                                <span class="w-1 h-1 bg-slate-300 dark:bg-slate-700 rounded-full"></span>
                                <span><?php echo $post->date; ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                
                <button class="w-full py-6 bg-white dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-3xl font-black uppercase tracking-widest text-xs hover:bg-slate-900 hover:text-white hover:border-slate-900 dark:hover:bg-emerald-500 dark:hover:border-emerald-500 transition-all text-slate-900 dark:text-white">Cargar Más Artículos</button>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 space-y-12">
                <!-- Trending Widget -->
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-slate-400 flex items-center gap-3">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Tendencias
                    </h3>
                    <div class="space-y-8">
                        <?php foreach(array_slice($latest_posts, 9, 5) as $i => $post): ?>
                        <div class="flex gap-6 items-start group">
                            <span class="text-4xl font-black text-slate-100 dark:text-slate-800 group-hover:text-emerald-100 dark:group-hover:text-emerald-900 transition-colors italic">0<?php echo $i+1; ?></span>
                            <div>
                                <h4 class="text-sm font-black leading-snug italic tracking-tight group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
                                    <a href="#"><?php echo $post->post_title; ?></a>
                                </h4>
                                <span class="text-[9px] text-slate-400 uppercase font-black tracking-widest mt-2 block"><?php echo $post->category; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Newsletter Widget -->
                <div class="bg-emerald-500 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-emerald-500/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                    <h3 class="text-2xl font-black italic tracking-tighter mb-4">Únete a la Comunidad</h3>
                    <p class="text-emerald-100 text-sm mb-8 font-medium">Recibe las mejores noticias de salsa directamente en tu correo.</p>
                    <div class="space-y-4">
                        <input type="email" placeholder="Tu email aquí..." class="w-full bg-white/20 border border-white/20 rounded-2xl px-6 py-4 outline-none placeholder:text-emerald-100 text-sm font-bold">
                        <button class="w-full bg-white text-emerald-600 py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl">Suscribirme</button>
                    </div>
                </div>

                <!-- Ad Widget -->
                <div class="aspect-square bg-slate-100 rounded-[2.5rem] flex items-center justify-center border-2 border-dashed border-slate-200">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Publicidad</span>
                </div>
            </aside>
        </div>
    </section>
</main>
