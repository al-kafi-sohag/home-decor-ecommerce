<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * NOTE: the figures below are placeholder/sample data so the template can
     * be designed end-to-end. Swap these for real queries (orders, products,
     * customers, revenue) once those models/tables exist.
     */
    public function index(): View
    {
        $stats = [
            [
                'label' => 'Total Revenue',
                'value' => '$48,260',
                'icon' => 'dollar-sign',
                'tone' => 'primary',
                'trend' => 12.4,
                'caption' => 'vs last month',
            ],
            [
                'label' => 'Orders',
                'value' => '1,284',
                'icon' => 'shopping-bag',
                'tone' => 'info',
                'trend' => 8.1,
                'caption' => 'vs last month',
            ],
            [
                'label' => 'Products',
                'value' => '342',
                'icon' => 'package',
                'tone' => 'warning',
                'trend' => 3.2,
                'caption' => '14 low in stock',
            ],
            [
                'label' => 'Customers',
                'value' => '5,690',
                'icon' => 'users',
                'tone' => 'success',
                'trend' => -1.8,
                'caption' => 'vs last month',
            ],
        ];

        // Monthly revenue used by the lightweight CSS bar chart (value in $k).
        $revenue = [
            ['month' => 'Jan', 'value' => 28],
            ['month' => 'Feb', 'value' => 34],
            ['month' => 'Mar', 'value' => 31],
            ['month' => 'Apr', 'value' => 42],
            ['month' => 'May', 'value' => 38],
            ['month' => 'Jun', 'value' => 47],
            ['month' => 'Jul', 'value' => 44],
            ['month' => 'Aug', 'value' => 52],
            ['month' => 'Sep', 'value' => 48],
            ['month' => 'Oct', 'value' => 58],
            ['month' => 'Nov', 'value' => 54],
            ['month' => 'Dec', 'value' => 63],
        ];

        $recentOrders = [
            ['id' => '#ORD-7841', 'customer' => 'Amelia Brooks', 'product' => 'Linen Accent Chair', 'total' => '$389.00', 'status' => 'completed'],
            ['id' => '#ORD-7840', 'customer' => 'Daniel Carter', 'product' => 'Ceramic Table Lamp', 'total' => '$74.50', 'status' => 'processing'],
            ['id' => '#ORD-7839', 'customer' => 'Sophia Nguyen', 'product' => 'Woven Wall Basket Set', 'total' => '$128.00', 'status' => 'pending'],
            ['id' => '#ORD-7838', 'customer' => 'Liam Patel', 'product' => 'Oak Coffee Table', 'total' => '$512.00', 'status' => 'completed'],
            ['id' => '#ORD-7837', 'customer' => 'Olivia Martins', 'product' => 'Velvet Throw Pillow', 'total' => '$39.00', 'status' => 'cancelled'],
        ];

        $topProducts = [
            ['name' => 'Linen Accent Chair', 'sold' => 218, 'share' => 86],
            ['name' => 'Oak Coffee Table', 'sold' => 176, 'share' => 70],
            ['name' => 'Ceramic Table Lamp', 'sold' => 154, 'share' => 61],
            ['name' => 'Woven Wall Basket Set', 'sold' => 132, 'share' => 52],
            ['name' => 'Velvet Throw Pillow', 'sold' => 98, 'share' => 39],
        ];

        return view('backend.dashboard.index', compact('stats', 'revenue', 'recentOrders', 'topProducts'));
    }
}
