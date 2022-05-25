<?php

namespace Ully\Cloudstorages\Services\DTO;

abstract class ExternalFile
{
    public function __construct(
        public string  $id,
        public string  $type,
        public string  $name,
        public string  $path,
        public ?string $mediaType = null,
        public ?string $mimeType = null,
        public ?string $preview = null,
        public ?string $file = null
    )
    {
    }
}
