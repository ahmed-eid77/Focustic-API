<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MachineLearningResource extends JsonResource
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
                'name'        => $this->name,
                'age'         => (string)$this->age,
                'position'          => $this->position,
                'points'            => $this->points
            ],
            'relationships' => [
                'tasks'       => TasksResource::collection($this->tasks)
            ]
        ];
    }
}
