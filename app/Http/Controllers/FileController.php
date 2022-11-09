<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\TemporaryUpload;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);
        $collection = uniqid('collection_'.rand(1111, 9999).'_');

        $model = TemporaryUpload::create();
        uploadImage($collection, $request->file('file'), $model);
        $this->body = [
            'url'        => $model->getFirstMediaUrl($collection),
            'collection' => "{$model->id}|{$collection}",
        ];

        return self::apiResponse(200, "done successfully", $this->body);
    }
}
