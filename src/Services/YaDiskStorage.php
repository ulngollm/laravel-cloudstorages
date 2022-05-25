<?php

namespace Ully\Cloudstorages\Services;

use App\Models\Storage;
use App\Models\StorageCredentials;
use App\Models\TokenStorageCredentials;
use Arhitector\Yandex\Client\Stream\Factory;
use Arhitector\Yandex\Disk;
use Illuminate\Support\LazyCollection;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;
use Ully\Cloudstorages\Services\Responses\YaDisk\DownloadedFile;
use Ully\Cloudstorages\Services\Responses\YaDisk\FilesCollection;

class YaDiskStorage implements ExternalStorage
{

    public function __construct(
        public Disk               $disk,
        public Storage            $storage,
        public CredentialsStorage $credentials,
        public Factory $streamFactory
    )
    {
    }


    public function filterByType(string $mediaType): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $result = $this->disk->getResources()->setMediaType($mediaType);

        $collection = LazyCollection::make($result->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFolderFiles(string $path): ExternalFilesCollection
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $result = $this->disk->getResource($path)->setLimit(100);

        $collection = LazyCollection::make($result->items->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFile(string $path): DownloadedFile
    {
        $credentials = $this->getCredentials();
        $this->disk->setAccessToken($credentials->token);
        $resource = $this->disk->getResource($path);
        $stream = $this->streamFactory->createStream();
        $resource->download($stream);

        return DownloadedFile::from($stream, $resource->mime_type);
    }

    public function getCredentials(): StorageCredentials|TokenStorageCredentials
    {
        return $this->credentials->getCredentials($this->storage,
            TokenStorageCredentials::class);
    }
}
