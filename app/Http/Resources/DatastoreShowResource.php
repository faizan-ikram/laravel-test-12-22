<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DatastoreShowResource extends JsonResource
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
            'name'          =>  $this->name,
            'description'   =>  $this->description,
            'type'          =>  $this->type,
            'file'          =>  Storage::disk('private')->temporaryUrl($this->file, now()->addMinutes(10))
        ];
    }
}
