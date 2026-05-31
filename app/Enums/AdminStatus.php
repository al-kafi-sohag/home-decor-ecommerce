<?php

namespace App\Enums;

/**
 * Lifecycle state of an admin account.
 *
 * Stored as a small integer in the `admins.status` column. The helper methods
 * keep labels/colors in one place so blades and controllers never hardcode them.
 */
enum AdminStatus: int
{
    case Inactive = 0;
    case Active = 1;
    case Deleted = -1;

    /**
     * Human readable label for the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Inactive => 'Inactive',
            self::Active => 'Active',
            self::Deleted => 'Deleted',
        };
    }

    /**
     * Tailwind-friendly color token, handy for badges in the dashboard.
     */
    public function color(): string
    {
        return match ($this) {
            self::Inactive => 'amber',
            self::Active => 'emerald',
            self::Deleted => 'rose',
        };
    }

    /**
     * Whether an admin in this state is allowed to authenticate.
     */
    public function canLogin(): bool
    {
        return $this === self::Active;
    }
}
