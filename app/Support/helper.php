<?php

use App\Models\TemporaryUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;



if (! function_exists('uploadImage')) {
    function uploadImage($name, $file, ?Model $model)
    {
        if ($file instanceof UploadedFile) {
            $model?->clearMediaCollection($name);

            return $model->addMedia($file)->toMediaCollection($name);
        }
    }
}

if (! function_exists('moveTempImage')) {
    function moveTempImage($collections_name, ?Model $toModel, $newCollectionName, $disk = 'public')
    {
        if (is_array($collections_name)) {
            foreach ($collections_name as $collection_name) {
                $array_id_collection = explode('|', $collection_name);
                if (is_array($array_id_collection) && count($array_id_collection) === 2) {
                    $fromModel = TemporaryUpload::findOrFail($array_id_collection[0]);
                    $mediaItem = $fromModel->getMedia($array_id_collection[1])->first();
                    $mediaItem && $mediaItem->move($toModel, $newCollectionName, $disk);
                    $mediaItem && $fromModel->clearMediaCollection($collection_name);
                }
            }
        }
        if (is_string($collections_name)) {
            $array_id_collection = explode('|', $collections_name);
            if (is_array($array_id_collection) && count($array_id_collection) === 2) {
                $fromModel = TemporaryUpload::findOrFail($array_id_collection[0]);
                $mediaItem = $fromModel->getMedia($array_id_collection[1])->first();
                $mediaItem && $mediaItem->move($toModel, $newCollectionName, $disk);
                $mediaItem && $fromModel->clearMediaCollection($collections_name);
            }
        }
    }
}
