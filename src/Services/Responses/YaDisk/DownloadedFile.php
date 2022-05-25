<?php

namespace Ully\Cloudstorages\Services\Responses\YaDisk;

use Laminas\Diactoros\Stream;

class DownloadedFile extends \Ully\Cloudstorages\Services\Responses\DownloadedFile
{
    public static function from(Stream $stream, string $contentType): static
    {
        return new static($stream, $contentType);
    }
}
