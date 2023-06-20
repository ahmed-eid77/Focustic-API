<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $mySessions = $this->whenLoaded('mySessions');

        return [
            'id' => (string) $this->id,
            'attributes' => [
                'name'          => $this->name,
                'note'          => $this->note,
                'state'         => $this->state,
                'duration'      => $this->duration,
                'reminder'      => $this->reminder,
                'reminder_date' => $this->reminder_date,
                'kind'          => $this->kind,
                'repeat'        => $this->repeat,
                'initiated_at'  => $this->initiated_at,
                'due_date'      => $this->due_date
            ],
            'relationships' => [
                'sessions' => MySessionResource::collection($this->whenLoaded('mySessions')),
            ]
        ];
    }
}
