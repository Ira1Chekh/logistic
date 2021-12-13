<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'extension' => $this->extension,
            'file_name' => $this->file_name,
            'name' => $this->name,
            'original_url' => $this->getUrl(),
            'full_url' => $this->getFullUrl(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
