<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

trait HasDocuments
{
    public function addDocuments(array $documents)
    {
        foreach ($documents as $document) {
            $this->addMedia($document)
                ->toMediaCollection('documents');
        }
    }

    public function documents(): MediaCollection
    {
        return $this->getMedia('documents');
    }
}
