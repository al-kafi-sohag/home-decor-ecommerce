<?php

namespace App\Services\Backend\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;

/**
 * Drives the reusable, AJAX-based file/image uploader.
 *
 * Files are first uploaded to a short-lived temporary location (keyed by a
 * random token) so the UI can preview them in real time before the parent
 * form is submitted. When the owning record is saved, the controller hands
 * the token(s) to {@see attachToModel()} which moves the file into the
 * model's Spatie media collection and clears the temporary copy.
 */
class MediaUploadService
{
    /**
     * Disk + base folder for pending (not-yet-attached) uploads.
     */
    protected const DISK = 'public';

    protected const TEMP_DIR = 'tmp/uploads';

    /**
     * Store a freshly uploaded file in the temporary area.
     *
     * @return array{token: string, name: string, url: string, size: int}
     */
    public function storeTemporary(UploadedFile $file): array
    {
        $token = (string) Str::uuid();

        $path = $file->storeAs(
            self::TEMP_DIR.'/'.$token,
            $this->sanitizedName($file),
            self::DISK,
        );

        return [
            'token' => $token,
            'name' => $file->getClientOriginalName(),
            'url' => asset('storage/'.$path),
            'size' => $file->getSize(),
        ];
    }

    /**
     * Remove a temporary upload (e.g. the user cancelled before submitting).
     */
    public function deleteTemporary(string $token): void
    {
        if (! $this->isValidToken($token)) {
            return;
        }

        Storage::disk(self::DISK)->deleteDirectory(self::TEMP_DIR.'/'.$token);
    }

    /**
     * Move a temporary upload into the given model's media collection.
     */
    public function attachToModel(HasMedia $model, string $collection, string $token): void
    {
        if (! $this->isValidToken($token)) {
            return;
        }

        $directory = self::TEMP_DIR.'/'.$token;
        $files = Storage::disk(self::DISK)->files($directory);

        if (empty($files)) {
            return;
        }

        $model->addMedia(Storage::disk(self::DISK)->path($files[0]))
            ->toMediaCollection($collection);

        $this->deleteTemporary($token);
    }

    /**
     * Guard against path traversal — tokens are always UUIDs.
     */
    protected function isValidToken(string $token): bool
    {
        return Str::isUuid($token);
    }

    /**
     * A filesystem-safe version of the original filename.
     */
    protected function sanitizedName(UploadedFile $file): string
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin';

        return Str::slug($name).'-'.Str::random(6).'.'.$extension;
    }
}
