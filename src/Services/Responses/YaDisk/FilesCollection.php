<?php

namespace Ully\Cloudstorages\Services\Responses\YaDisk;

use Arhitector\Yandex\Disk\AbstractResource;
use Illuminate\Support\Collection;
use Ully\Cloudstorages\Services\DTO\YaDiskFile;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;

class FilesCollection extends ExternalFilesCollection
{

    public static function from(Collection $data): static
    {
        $items = $data
            ->map(function (AbstractResource $item) {
                return YaDiskFile::from($item);
            });
        return new static($items);
    }
}
