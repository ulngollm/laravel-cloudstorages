<?php

namespace Ully\Cloudstorages\Services;

use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Models\StorageType;
use Ully\Cloudstorages\Services\DTO\InputStorage;
use Illuminate\Support\Collection;

class CommonStorage
{
    public function addStorage(InputStorage $data)
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
}