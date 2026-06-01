import $ from 'jquery';
import {
    createIcons,
    ArrowLeft,
    ArrowRight,
    BarChart3,
    Bell,
    ChevronDown,
    DollarSign,
    Download,
    Eye,
    EyeOff,
    Image,
    KeyRound,
    Layers,
    LayoutDashboard,
    LayoutGrid,
    LifeBuoy,
    LoaderCircle,
    Lock,
    LogIn,
    LogOut,
    Mail,
    Package,
    PanelLeft,
    Plus,
    Search,
    Send,
    Settings,
    ShieldCheck,
    ShoppingBag,
    Sofa,
    Star,
    TicketPercent,
    Trash2,
    TrendingDown,
    TrendingUp,
    Upload,
    User,
    Users,
} from 'lucide';
import { initImageUploaders } from './uploader.js';
// Lucide resolves data-lucide="log-in" via PascalCase (LogIn), so keys must be component names.
const adminIcons = {
    ArrowLeft,
    ArrowRight,
    BarChart3,
    Bell,
    ChevronDown,
    DollarSign,
    Download,
    Eye,
    EyeOff,
    Image,
    KeyRound,
    Layers,
    LayoutDashboard,
    LayoutGrid,
    LifeBuoy,
    LoaderCircle,
    Lock,
    LogIn,
    LogOut,
    Mail,
    Package,
    PanelLeft,
    Plus,
    Search,
    Send,
    Settings,
    ShieldCheck,
    ShoppingBag,
    Sofa,
    Star,
    TicketPercent,
    Trash2,
    TrendingDown,
    TrendingUp,
    Upload,
    User,
    Users,
};


/*
|--------------------------------------------------------------------------
| Backend (admin panel) scripts
|--------------------------------------------------------------------------
|
| jQuery is available globally as $. Wire interactive admin behaviour here
| (sidebar toggles, datatables, ajax forms...) as the dashboard grows.
|
*/

$(function () {
    // Render every <i data-lucide="..."> placeholder as an inline SVG icon.
    createIcons({ icons: adminIcons });

    // Wire up any reusable image uploaders present on the page.
    initImageUploaders();

    // ---------------------------------------------------------------------
    // Sidebar toggle
    //
    // On desktop (>=1024px) the toggle collapses/expands the rail and the
    // choice is remembered in localStorage. On smaller screens it slides the
    // sidebar in over a backdrop instead.
    // ---------------------------------------------------------------------
    const $body = $('body');
    const COLLAPSE_KEY = 'admin.sidebar.collapsed';

    if (localStorage.getItem(COLLAPSE_KEY) === '1') {
        $body.addClass('admin-sidebar-collapsed');
    }

    $(document).on('click', '[data-sidebar-toggle]', function () {
        if (window.matchMedia('(max-width: 1023px)').matches) {
            $body.toggleClass('admin-sidebar-open');
            return;
        }
        $body.toggleClass('admin-sidebar-collapsed');
        localStorage.setItem(COLLAPSE_KEY, $body.hasClass('admin-sidebar-collapsed') ? '1' : '0');
    });

    $(document).on('click', '[data-sidebar-close]', function () {
        $body.removeClass('admin-sidebar-open');
    });

    // ---------------------------------------------------------------------
    // Dropdowns (user menu, etc.)
    // ---------------------------------------------------------------------
    $(document).on('click', '[data-dropdown-toggle]', function (e) {
        e.stopPropagation();
        const $menu = $(this).closest('[data-dropdown]').find('[data-dropdown-menu]');
        $('[data-dropdown-menu]').not($menu).addClass('hidden');
        $menu.toggleClass('hidden');
    });

    $(document).on('click', function () {
        $('[data-dropdown-menu]').addClass('hidden');
    });

    $(document).on('click', '[data-dropdown-menu]', function (e) {
        e.stopPropagation();
    });

    // Password visibility toggle for auth forms.
    //
    // Lucide replaces the <i data-lucide> placeholder with an <svg> on load (and
    // drops the data-lucide attribute), so we can't just tweak the attribute. We
    // rewrite the button's icon to a fresh placeholder and let lucide re-render.
    $(document).on('click', '[data-toggle-password]', function () {
        const $btn = $(this);
        const $field = $($btn.data('toggle-password'));
        const reveal = $field.attr('type') === 'password';

        $field.attr('type', reveal ? 'text' : 'password');

        // "eye-off" = currently visible (click to hide), "eye" = currently hidden.
        $btn
            .attr('aria-pressed', reveal ? 'true' : 'false')
            .attr('title', reveal ? 'Hide password' : 'Show password')
            .html('<i data-lucide="' + (reveal ? 'eye-off' : 'eye') + '" class="h-4 w-4"></i>');

        createIcons({ icons: adminIcons });

        // Keep focus + caret in the field for a smooth flow.
        const el = $field.get(0);
        if (el) {
            const len = el.value.length;
            el.focus();
            el.setSelectionRange(len, len);
        }
    });
});
