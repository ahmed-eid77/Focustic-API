<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExercisesResource extends JsonResource
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
            'id'  => (string)$this->id,
            'attributes' => [
                'name'        => $this->name,
                'cover'       => $this->cover,
                'description' => $this->description,
                'bodyPart'    => $this->body_part,
                'repetitions' => (string)$this->repetitions,
                'sets'        => (string)$this->sets,
                'duration'    => (string)$this->duration,
                'link'        => $this->link
            ],
            'relationships' => [
                'category' => $this->category
            ]
        ];
    }
}
