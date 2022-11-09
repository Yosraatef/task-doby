<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"       => (int) $this->id,
            "username" => (string) $this->username,
            "bio" => (string) $this->bio,
            "email" => (string) $this->email,
            "birthday" => (string) data_get($this, 'info.birthday'),
            "latitude" => (double) data_get($this, 'info.latitude'),
            "longitude" => (double) data_get($this, 'info.longitude'),
            "file" => (string) $this->file,

        ];
    }
}
