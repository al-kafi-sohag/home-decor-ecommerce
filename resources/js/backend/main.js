import $ from 'jquery';
import { createIcons, icons } from 'lucide';

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
    createIcons({ icons });

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

        createIcons({ icons });

        // Keep focus + caret in the field for a smooth flow.
        const el = $field.get(0);
        if (el) {
            const len = el.value.length;
            el.focus();
            el.setSelectionRange(len, len);
        }
    });
});
