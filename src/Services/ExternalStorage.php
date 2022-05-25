<?php

namespace Ully\Cloudstorages\Services;

use Ully\Cloudstorages\Models\StorageCredentials;
use Ully\Cloudstorages\Services\Responses\DownloadedFile;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;

interface ExternalStorage
{
    public function filterByType(string $mediaType): ExternalFilesCollection;

    public function getFolderFiles(string $path): ExternalFilesCollection;

    public function getFile(string $path): DownloadedFile;

    public function getCredentials(): StorageCredentials;

}
