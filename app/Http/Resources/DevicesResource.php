<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DevicesResource extends JsonResource
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
            'id' => (string) $this->id,
            'attributes' => [
                'rotation_x' => (string) $this->rotation_x,
                'rotation_y' => (string) $this->rotation_y,
                'rotation_z' => (string) $this->rotation_z,
                'ultrasonic' => (string) $this->ultrasonic
            ]
        ];
    }
}
