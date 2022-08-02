<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicInStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'artist' => $this->artist,
            'title' => $this->title,
            'featuring' => $this->featuring,
            'genre' => $this->genre,
            'year' => $this->year,
            'cover' => $this->cover,
            'song' => $this->song,
            'price' => $this->price
        ];
    }
}
