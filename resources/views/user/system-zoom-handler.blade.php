<script>
    (function() {
        // Tenta ler do localStorage primeiro, se não tiver usa o default fixo (100%)
        const persistedZoom = localStorage.getItem('app-system-zoom-percent');
        const zoomValue = persistedZoom ? JSON.parse(persistedZoom) : 100;
        
        document.documentElement.style.fontSize = zoomValue + '%';
        document.documentElement.style.visibility = 'hidden'; 
        
        window.addEventListener('DOMContentLoaded', () => {
            document.documentElement.style.visibility = '';
        });
    })();
</script>

<div 
    x-data="{ 
        zoomPercentage: $persist(100).as('app-system-zoom-percent'),
        applyZoom() {
            document.documentElement.style.fontSize = this.zoomPercentage + '%';
        },
        updateTheme(theme) {
            let link = document.getElementById('neobrutalism-theme-link');
            if (theme === 'neobrutalism') {
                if (!link) {
                    link = document.createElement('link');
                    link.id = 'neobrutalism-theme-link';
                    link.rel = 'stylesheet';
                    link.href = this.neobrutalismUrl;
                    document.head.appendChild(link);
                }
            } else {
                if (link) {
                    link.remove();
                }
            }
        }
    }" 
    x-init="applyZoom()" 
    @update-zoom.window="zoomPercentage = $event.detail.zoom; applyZoom()"
    @update-theme.window="updateTheme($event.detail.theme)"
></div>

<style>
    /* Não forçamos height 100% no html/body pois isso quebra o scroll dinâmico do Filament */
    html {
        scroll-behavior: smooth;
    }

    /* Ajuste para a Sidebar do Filament (v4) manter o scroll interno mesmo com font-size reduzido */
    .fi-sidebar-nav {
        flex: 1 1 0%;
        overflow-y: auto !important;
        max-height: 100vh;
    }

    /* Garante que o container principal tenha scroll se necessário */
    body {
        min-height: 100vh;
        /* overflow-y: auto; -- Removido pois quebra o scroll lock do Filament em modais e causa desaparecimento do menu top */
    }

    /* Fix: Overlap entre os Pips/Handles do Slider e o Footer do Slide-over */
    .user-preferences-modal .fi-modal-footer {
        z-index: 100 !important;
        position: relative;
    }

    /* Reduz o z-index padrão dos handles do noUiSlider que costuma ser alto */
    .user-preferences-modal .noUi-handle,
    .user-preferences-modal .noUi-pips,
    .user-preferences-modal .noUi-tooltip {
        z-index: 1 !important;
    }
</style>
