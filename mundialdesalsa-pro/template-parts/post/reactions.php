<?php
/**
 * Template part for displaying post reactions
 */
$post_id = get_the_ID();
?>

<div class="post-reactions flex items-center gap-3" data-post-id="<?php echo esc_attr( $post_id ); ?>">
    <button class="reaction-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 hover:border-emerald-500/50 transition-all duration-300" data-reaction="salsa">
        <span class="text-lg group-hover:scale-125 transition-transform duration-300">💃</span>
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 group-hover:text-emerald-500 transition-colors">Salsa</span>
    </button>
    
    <button class="reaction-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 hover:border-orange-500/50 transition-all duration-300" data-reaction="fuego">
        <span class="text-lg group-hover:scale-125 transition-transform duration-300">🔥</span>
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 group-hover:text-orange-500 transition-colors">Fuego</span>
    </button>
    
    <button class="reaction-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 hover:border-indigo-500/50 transition-all duration-300" data-reaction="clave">
        <span class="text-lg group-hover:scale-125 transition-transform duration-300">🥁</span>
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 group-hover:text-indigo-500 transition-colors">Clave</span>
    </button>
</div>
