<?php

namespace Ully\Cloudstorages\Services\Responses;

use Illuminate\Support\Collection;

abstract class ExternalFilesCollection
{
    public function __construct(
        public Collection $items
    )
    {
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
}
