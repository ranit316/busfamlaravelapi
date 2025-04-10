<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseData($data, $message = "", $status = true,)
    {
        $response = [
            "success" => $status,
            "message" => $message,
            "data" => $data
        ];

        return response()->json($response);
    }

    protected function getMediaUrlsByIds(array $ids): array
    {
        $baseURL = request()->root();

        $mediaItems = Media::whereIn('id', $ids)->get()->keyBy('id');

        return collect($ids)
            ->map(fn($id) => $mediaItems[$id]->path ?? null)
            ->filter()
            ->map(fn($path) => $baseURL . '/' . $path)
            ->values()
            ->toArray();
    }

    protected function getMediaUrlById($id)
    {
        $baseURL = request()->root();
        $media = Media::find($id);

        return $media ? $baseURL . '/' . $media->path : null;
    }
}
