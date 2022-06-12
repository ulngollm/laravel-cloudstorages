<?php

namespace Ully\Cloudstorages\Services;


use Arhitector\Yandex\Client\Stream\Factory;
use Arhitector\Yandex\Disk;
use Illuminate\Support\LazyCollection;
use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Services\Responses\YaDisk\DownloadedFile;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;
use Ully\Cloudstorages\Services\Responses\YaDisk\FilesCollection;

class YaDiskStorage implements ExternalStorage
{
    public function __construct(
        public Disk        $disk,
        public Storage     $storage,
        public Factory     $streamFactory,
        CredentialsStorage $credentialsStorage
    )
    {
        $credType = $credentialsStorage->findCredType($this->storage->type->driver);
        $credentials = $credentialsStorage->getCredentials($this->storage, $credType);
        $this->disk->setAccessToken($credentials->token);
    }


    public function filterByType(string $mediaType): ExternalFilesCollection
    {
        $result = $this->disk->getResources()->setMediaType($mediaType);

        $collection = LazyCollection::make($result->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFolderFiles(string $path): ExternalFilesCollection
    {
        $result = $this->disk->getResource($path)->setLimit(100);

        $collection = LazyCollection::make($result->items->getIterator())->collect();
        return FilesCollection::from($collection);
    }

    public function getFile(string $path): DownloadedFile
    {
        $resource = $this->disk->getResource($path);
        $stream = $this->streamFactory->createStream();
        $resource->download($stream);

        return DownloadedFile::from($stream, $resource->mime_type);
    }

}
