<?php


use App\Http\Services\ExternalStorage\YaDiskStorage;
use App\Models\TokenStorageCredentials;

return [
    'driver' => [
        'ya_disk' => [
            'name' => 'Яндекс Диск', //название, которое будет отображаться пользователю
            'handler' => YaDiskStorage::class,
            'credentials_type' => TokenStorageCredentials::class,
            'base_url' => 'https://cloud-api.yandex.net/v1',
            'icon' => null
        ]
    ]
];
