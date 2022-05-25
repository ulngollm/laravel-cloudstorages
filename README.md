Пакет предоставляет готовый REST API для работы с пользовательскими облачными хранилищами.

Можно добавить новые типы хранилищ. Как это сделать - см.глава [Использование](#использование)

## Установка пакета

На данный момент пакет доступен только на Github.

1. Чтобы `composer` смог установить пакет из Github, добавить в `composer.json` секцию

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ulngollm/laravel-package-demo"
        }
    ]
}
```

2. Установить

```bash
composer require ully/cloudstorages
```

3. Скопировать в проект миграции и конфиги

```bash
php artisan vendor:publish --provider="Ully\Cloudstorages\CloudStoragesProvider"
```

## Использование

API доступен по эндпоинтам с префиксом `/api/storages`.

Конфигурация сервиса находится в `config/storages.php`. Там перечислены поддерживаемые типы хранилищ.
На данный момент реализована только поддержка Яндекс Диска.

Для реализации нового типа хранилища требуется:

- добавить миграцию для таблицы с доступами (credentials). Добавть модель для этого типа credentials. Модель должна
  наследовать `Ully\Cloudstorages\Models\StorageCredentials`.
- добавить его в конфиге в секцию `drivers` и описать параметры (по существующему примеру);
- реализовать обработчик, имплементирующий интерфейс `Ully\Cloudstorages\Services\ExternalStorage`

## View

Также в пакете есть набор готовых `blade`-шаблонов. Среди них

- страница списка хранилищ (`cloudstorages::storages`)
- страница списка файлов (`cloudstorages::files`)
- view-компоненты File и Storage (`<x-cloud-storage/>`, `<x-cloud-file/>`)

Чтобы кастомизировать их, выполните `php artisan vendor:publish --provider="Ully\Cloudstorages\CloudStoragesProvider"`
. Шаблоны скопируются в папку `resources/views/vendor/cloudstorages`.
