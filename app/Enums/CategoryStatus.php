<?php

namespace App\Enums;

/**
 * Publication state of a product category.
 *
 * Stored as a small integer in the `categories.status` column. The helper
 * methods keep labels/colors in one place so blades and controllers never
 * hardcode them.
 */
enum CategoryStatus: int
{
    case Deactive = 0;
    case Active = 1;

    /**
     * Human readable label for the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Deactive => 'Deactive',
            self::Active => 'Active',
        };
    }

    /**
     * Tailwind-friendly color token, handy for badges in the dashboard.
     */
    public function color(): string
    {
        return match ($this) {
            self::Deactive => 'amber',
            self::Active => 'emerald',
        };
    }

    /**
     * Whether a category in this state should be visible on the storefront.
     */
    public function isActive(): bool
    {
        return $this === self::Active;
    }
}
