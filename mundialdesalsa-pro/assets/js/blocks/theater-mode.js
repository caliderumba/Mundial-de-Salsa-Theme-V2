document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mds-theater-toggle');
    const container = document.getElementById('mds-theater-container');
    
    if (toggle && container) {
        let isTheater = false;
        
        // Create overlay
        const overlay = document.createElement('div');
        overlay.id = 'mds-theater-overlay';
        overlay.className = 'fixed inset-0 bg-black/90 z-10 opacity-0 pointer-events-none transition-opacity duration-500';
        document.body.appendChild(overlay);
        
        toggle.addEventListener('click', function() {
            isTheater = !isTheater;
            
            if (isTheater) {
                overlay.classList.remove('pointer-events-none');
                overlay.classList.add('opacity-100');
                container.classList.add('theater-active');
                toggle.textContent = 'Salir Modo Teatro';
                document.body.style.overflow = 'hidden';
            } else {
                overlay.classList.add('pointer-events-none');
                overlay.classList.remove('opacity-100');
                container.classList.remove('theater-active');
                toggle.textContent = 'Modo Teatro';
                document.body.style.overflow = '';
            }
        });
        
        overlay.addEventListener('click', function() {
            if (isTheater) toggle.click();
        });
    }
});
