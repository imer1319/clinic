<?php

namespace App\Http\Resources;

use App\Models\HistoryQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryTypeResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'history_questions' => HistoryQuestionResource::collection($this->historyQuestions),
        ];
    }
}
