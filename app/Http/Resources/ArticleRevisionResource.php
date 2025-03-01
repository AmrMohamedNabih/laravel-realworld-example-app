<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleRevisionResource extends JsonResource
{
    public static $wrap = '';
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
            'body' => $this->body,
            'tags' => $this->tags ?? [],
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
    public function withResponse($request, $response)
    {
        $response->setData($this->toArray($request));
    }
}
