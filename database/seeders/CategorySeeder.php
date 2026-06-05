<?php

namespace Database\Seeders;

use App\Enums\CategoryStatus;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['title' => 'Furniture', 'is_featured' => true, 'is_menu' => true],
            ['title' => 'Lighting', 'is_featured' => true, 'is_menu' => true],
            ['title' => 'Clocks', 'is_featured' => false, 'is_menu' => true],
            ['title' => 'Planters', 'is_featured' => false, 'is_menu' => true],
            ['title' => 'House Hold', 'is_featured' => false, 'is_menu' => true],
            ['title' => 'Home Decor', 'is_featured' => false, 'is_menu' => true],
        ];

        foreach ($categories as $category) {
            $record = Category::query()->firstOrNew(['title' => $category['title']]);

            $record->fill([
                'is_featured' => $category['is_featured'],
                'is_menu' => $category['is_menu'],
                'status' => CategoryStatus::Active,
            ]);

            // DatabaseSeeder disables model events, so Sluggable's creating
            // hook does not run — generate the slug manually before persisting.
            if (blank($record->slug)) {
                $record->generateSlug();
            }

            $record->save();
        }
    }
}
