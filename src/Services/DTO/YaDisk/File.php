<?php

namespace Ully\Cloudstorages\Services\DTO;

use Arhitector\Yandex\Disk\AbstractResource;
use Illuminate\Support\Str;

class File extends ExternalFile
{
    public static function from(AbstractResource $item): static
    {
        return new static(
            id: $item['resource_id'],
            type: $item['type'],
            name: $item['name'],
            path: Str::of($item['path'])->remove('disk:') ?? null,//удалить disk:
            mediaType: $item['media_type'] ?? null,
            mimeType: $item['mime_type'] ?? null,
            preview: $item['preview'] ?? null,
            file: $item['file'] ?? null
        );
    }
}
