<?php

namespace App\Models;

use App\Enums\AdminStatus;
use App\Notifications\Admin\AdminResetPasswordNotification;
use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    /** @use HasFactory<AdminFactory> */
    use HasFactory, InteractsWithMedia, Notifiable, SoftDeletes;

    /**
     * Media collection that holds the admin's profile photo.
     */
    public const AVATAR_COLLECTION = 'avatar';

    /**
     * The guard that authenticates this model.
     */
    protected string $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation',
        'bio',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => AdminStatus::class,
        ];
    }

    /**
     * Send the admin-specific password reset notification.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /**
     * Register media collections. The avatar holds a single image at a time.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::AVATAR_COLLECTION)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Up to two uppercase initials derived from the admin's name. Used for the
     * avatar fallback in the topbar and profile screens.
     */
    public function initials(): string
    {
        return Str::of($this->name ?? 'Admin')
            ->trim()
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $part) => Str::upper(Str::substr($part, 0, 1)))
            ->implode('') ?: 'AD';
    }

    /**
     * Public URL for the uploaded avatar, or null when none is set (the UI
     * then falls back to the initials badge).
     */
    public function avatarUrl(): ?string
    {
        return $this->getFirstMediaUrl(self::AVATAR_COLLECTION) ?: null;
    }
}
