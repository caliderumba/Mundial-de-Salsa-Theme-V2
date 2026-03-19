<?php
/**
 * The template for displaying search forms
 */
?>

<form role="search" method="get" class="search-form relative group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="block">
        <span class="sr-only"><?php echo _x( 'Buscar por:', 'label', 'mundialdesalsa-pro' ); ?></span>
        <input type="search" class="search-field w-full bg-slate-100 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 outline-none focus:border-emerald-500 transition-all text-slate-900 dark:text-white font-bold placeholder:text-slate-400" placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder', 'mundialdesalsa-pro' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 transition-colors">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <span class="sr-only"><?php echo _x( 'Buscar', 'submit button', 'mundialdesalsa-pro' ); ?></span>
    </button>
</form>
