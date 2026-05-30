import $ from 'jquery';
import { createIcons, icons } from 'lucide';

/*
|--------------------------------------------------------------------------
| Frontend (storefront) scripts
|--------------------------------------------------------------------------
|
| Intentionally minimal for now. jQuery is available globally as $ and is
| the place to wire interactive behaviour later (cart, filters, sliders...).
|
*/

$(function () {
    // Render every <i data-lucide="..."> placeholder as an inline SVG icon.
    createIcons({ icons });
});
