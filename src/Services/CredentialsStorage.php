<?php

namespace Ully\Cloudstorages\Services;

use Illuminate\Support\Arr;
use Ully\Cloudstorages\Models\Storage;
use Ully\Cloudstorages\Models\StorageCredentials;

class CredentialsStorage
{


    public function __construct(public array $drivers)
    {
    }

    public function findCredType(string $driver): string
    {
        return Arr::get($this->drivers, "$driver.credentials_type");
    }

    public function getCredentials(Storage $storage, string $credType): StorageCredentials
    {
        return $credType::where('storage_id', $storage->id)->get()->first();
    }

    public function addCredentials(Storage $storage, array $credentials): void
    {
        $storage->loadMissing('type');
        $driver = $storage->type->driver;
        $credType = $this->findCredType($driver);
        $newCred = new $credType;
        $newCred->fill($credentials)
            ->storage()
            ->associate($storage)
            ->save();
    }
}
