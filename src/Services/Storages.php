<?php

namespace Ully\Cloudstorages\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Models\StorageType;
use Ully\Cloudstorages\Services\DTO\NewStorage;
use Ully\Cloudstorages\Services\Responses\DownloadedFile;
use Ully\Cloudstorages\Services\Responses\ExternalFilesCollection;

class Storages
{
    public function __construct(
        private Router $router
    )
    {
    }

    public function addStorage(NewStorage $data)
    {
        $storage = Storage::create([
            'label' => $data->label,
            'user_id' => $data->user_id,
            'type_id' => $data->driver
        ]);
        resolve(CredentialsStorage::class)->addCredentials($storage, $data->credentials);
        return $storage;
    }

    public function getList(User $user): Collection
    {
        return $user->storages;
    }

    public function renameStorage(Storage $storage, string $label): Storage
    {
        $storage->label = $label;
        $storage->save();
        return $storage;
    }

    public function deleteStorage(Storage $storage): void
    {
        $storage->delete();
    }

    public function getTypes()
    {
        return StorageType::all();
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
