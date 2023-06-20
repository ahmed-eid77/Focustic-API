<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MySessionResource extends JsonResource
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
                'name'          => $this->name,
                'state'         => $this->state,
                'start_time'    => $this->start_time,
                'end_time'      => $this->end_time
            ],
            'relationships' => [
                'tasks' => TasksResource::collection($this->whenLoaded('tasks'))
            ]
        ];
    }
}
