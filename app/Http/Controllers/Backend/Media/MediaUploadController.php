<?php

namespace App\Http\Controllers\Backend\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Media\StoreMediaRequest;
use App\Services\Backend\Media\MediaUploadService;
use Illuminate\Http\JsonResponse;

/**
 * Generic, model-agnostic endpoint used by the reusable AJAX uploader. It only
 * parks files in a temporary area and returns a token; the owning module then
 * attaches that token to its record on save (see MediaUploadService).
 */
class MediaUploadController extends Controller
{
    public function __construct(protected MediaUploadService $mediaUploadService) {}

    /**
     * Upload a single file to the temporary area.
     */
    public function store(StoreMediaRequest $request): JsonResponse
    {
        $payload = $this->mediaUploadService->storeTemporary($request->file('file'));

        return response()->json([
            'success' => true,
            'data' => $payload,
        ]);
    }

    /**
     * Discard a temporary upload by its token.
     */
    public function destroy(string $token): JsonResponse
    {
        $this->mediaUploadService->deleteTemporary($token);

        return response()->json(['success' => true]);
    }
}
