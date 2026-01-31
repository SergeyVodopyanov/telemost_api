<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'start_date' => $this->start_date,
            'completed_at' => $this->completed_at,
            'team_id' => $this->team_id,
            'creator_id' => $this->creator_id,
            'assignee_id' => $this->assignee_id
        ];
    }
}
