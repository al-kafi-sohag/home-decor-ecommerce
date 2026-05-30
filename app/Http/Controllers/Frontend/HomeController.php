<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the storefront home page.
     *
     * The data below is static for now but shaped exactly like it will be
     * once it comes from the database, so the blade templates can stay
     * unchanged when models/queries are wired in later.
     */
    public function index(): View
    {
        $features = [
            ['icon' => 'truck', 'title' => 'FREE SHIPPING WORLDWIDE'],
            ['icon' => 'bell', 'title' => '24/7 CUSTOMER SUPPORT'],
            ['icon' => 'zap', 'title' => 'FAST & SECURE CHECKOUT'],
        ];

        $newArrivals = [
            ['title' => 'PRODUCT DUMMY TITLE', 'price' => 110.00, 'compare_price' => 130.00],
            ['title' => 'PRODUCT TITLE HERE', 'price' => 19.00, 'compare_price' => 21.00],
            ['title' => 'DUMMY TEXT FOR TITLE', 'price' => 39.00, 'compare_price' => null],
            ['title' => 'ANOTHER PRODUCT', 'price' => 49.00, 'compare_price' => 65.00],
        ];

        // Ordered to fill the bento layout (first item is the tall feature tile,
        // second is the wide tile). See the collections section for the grid map.
        $collections = [
            ['name' => 'Furniture', 'icon' => 'armchair'],
            ['name' => 'Lighting', 'icon' => 'lightbulb'],
            ['name' => 'Clocks', 'icon' => 'clock'],
            ['name' => 'Planters', 'icon' => 'sprout'],
            ['name' => 'House Hold', 'icon' => 'package'],
            ['name' => 'Home Decor', 'icon' => 'house'],
        ];

        $products = [
            ['title' => 'VARIABLE WITH SOLDOUT PRODUCT', 'price' => 55.00, 'compare_price' => 75.00, 'badges' => ['Sale', '-27%']],
            ['title' => 'SIMPLE PRODUCT', 'price' => 50.00, 'compare_price' => null, 'badges' => []],
            ['title' => 'WITHOUT SHORTCODE PRODUCT', 'price' => 79.00, 'compare_price' => null, 'badges' => ['-34%']],
            ['title' => 'SOLDOUT PRODUCT', 'price' => 19.00, 'compare_price' => 29.00, 'badges' => ['Soldout']],
            ['title' => 'VARIABLE PRODUCT', 'price' => 40.00, 'compare_price' => 85.00, 'badges' => ['Sale', '-18%']],
            ['title' => 'NEW BADGE PRODUCT', 'price' => 80.00, 'compare_price' => null, 'badges' => []],
            ['title' => 'ANOTHER PRODUCT', 'price' => 45.00, 'compare_price' => 65.00, 'badges' => ['-34%']],
            ['title' => 'SIMPLE ITEM', 'price' => 25.00, 'compare_price' => null, 'badges' => []],
        ];

        $productTabs = ['Best Seller', 'Deal Product', 'Most View'];

        // Product video reels (YouTube). 'video' is the YouTube ID; swap these
        // for DB-stored IDs later. Use Shorts/portrait videos for the reel look.
        $reels = [
            ['title' => 'Styling Your Living Room', 'video' => 'ScMzIvxBSi4'],
            ['title' => 'Cozy Bedroom Makeover', 'video' => 'ScMzIvxBSi4'],
            ['title' => 'Minimalist Desk Setup', 'video' => 'ScMzIvxBSi4'],
            ['title' => 'Warm Lighting Ideas', 'video' => 'ScMzIvxBSi4'],
        ];

        return view('frontend.home.index', compact(
            'features',
            'newArrivals',
            'collections',
            'products',
            'productTabs',
            'reels'
        ));
    }
}
