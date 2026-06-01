import $ from 'jquery';
import {
    createIcons,
    Armchair,
    Banknote,
    Bell,
    ChevronLeft,
    ChevronRight,
    CircleDollarSign,
    Clock,
    CreditCard,
    House,
    Image,
    Lightbulb,
    Menu,
    Package,
    Search,
    ShoppingCart,
    Sofa,
    Sprout,
    Truck,
    User,
    Wallet,
    Zap,
} from 'lucide';

/*
|--------------------------------------------------------------------------
| Frontend (storefront) scripts
|--------------------------------------------------------------------------
|
| Intentionally minimal for now. jQuery is available globally as $ and is
| the place to wire interactive behaviour later (cart, filters, sliders...).
|
*/

const frontendIcons = {
    Armchair,
    Banknote,
    Bell,
    ChevronLeft,
    ChevronRight,
    CircleDollarSign,
    Clock,
    CreditCard,
    House,
    Image,
    Lightbulb,
    Menu,
    Package,
    Search,
    ShoppingCart,
    Sofa,
    Sprout,
    Truck,
    User,
    Wallet,
    Zap,
};

function mountYouTubeIframe(container) {
    if (!container || container.dataset.youtubeLoaded === '1') {
        return;
    }

    const videoId = container.dataset.videoId;
    const videoTitle = container.dataset.videoTitle || 'Product reel';
    if (!videoId) {
        return;
    }

    const iframe = document.createElement('iframe');
    iframe.className = 'absolute inset-0 w-full h-full';
    iframe.src = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
    iframe.title = videoTitle;
    iframe.loading = 'lazy';
    iframe.referrerPolicy = 'strict-origin-when-cross-origin';
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
    iframe.allowFullscreen = true;

    container.innerHTML = '';
    container.appendChild(iframe);
    container.dataset.youtubeLoaded = '1';
}

function initLiteYouTubeEmbeds() {
    const containers = document.querySelectorAll('[data-youtube-lite]');
    containers.forEach((container) => {
        const button = container.querySelector('button');
        if (!button) {
            return;
        }

        button.addEventListener('click', () => mountYouTubeIframe(container), { once: true });
    });
}

$(function () {
    // Render storefront icons without bundling the full lucide icon registry.
    createIcons({ icons: frontendIcons });
    // Delay YouTube iframe boot to click so homepage stays lightweight.
    initLiteYouTubeEmbeds();
});
