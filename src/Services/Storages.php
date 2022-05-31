<?php

namespace Ully\Cloudstorages\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Models\StorageType;
use Ully\Cloudstorages\Services\DTO\InputStorage;
use Ully\Cloudstorages\Services\Responses\DownloadedFile;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;

class Storages
{
    public function __construct(
        private Router        $router,
        private CommonStorage $storage
    )
    {
    }

    public function addStorage(InputStorage $data)
    {
        return $this->storage->addStorage($data);
    }

    public function getList(User $user): Collection
    {
        return $this->storage->getList($user);
    }

    public function renameStorage(Storage $storage, string $label): Storage
    {
        return $this->storage->renameStorage($storage, $label);
    }

    public function deleteStorage(Storage $storage): void
    {
        $this->storage->deleteStorage($storage);
    }

    public function getTypes(): Collection
    {
        return $this->storage->getTypes();
    }

    public function getFolderFiles(Storage $storage, string $path): ExternalFilesCollection
    {
        $handler = $this->router->findHandler($storage);
        return $handler->getFolderFiles($path);
    }

    public function filterByType(Storage $storage, string $type): ExternalFilesCollection
    {
        $handler = $this->router->findHandler($storage);
        return $handler->filterByType($type);
    }

    public function getFile(Storage $storage, string $path): DownloadedFile
    {
        $handler = $this->router->findHandler($storage);
        return $handler->getFile($path);
    }

}
