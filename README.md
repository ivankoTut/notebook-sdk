### Библиотека для упрощенной работы с апи notebook

### Установка
```
composer require ivankotut/notebook-sdk
```

#### конфигурация
```yaml
IvankoTut\NotebookSdk\ApiClient:
    arguments:
        $apiBaseUrl: 'http://url/api/'
        $serializer: '@serializer'
        $defaultHeaders:
            - {name: 'custom-header-name', value: 'value'}
```
```php
$client = new IvankoTut\NotebookSdk\ApiClient(
    'http://url/api/',
    new SerializerInterface(),
    [
        ['name' => 'ngrok-skip-browser-warning', 'value' => true]
    ]
);
```

#### Примеры:

Создание телеграм-пользователя
```php
$data = [
    'telegramId' => '11111',
    'firstName' => 'FirstName'
    'lastName' => 'LastNAme'
    'username' => 'Username'
];
$client->telegramUser()->createTelegramUser($token, $data);
```

Получение данных телеграм-пользователя
```php
$client->telegramUser()->getByTelegramId($token, $telegramId);
```

Получение данных телеграм-пользователя
```php
$data = [
    'name' => 'Tag name'
];
$client->tag()->create($token, $data);
```

Получение записей по тегу
```php
$client->note()->byTag($token, $tagId, $page, $limit);
```

Поиск записей
```php
$data = [
    'page' => 1,     // опционально
    'limit' => 10,   // опционально
    'tagName' => '', // опционально
    'tagId' => '',   // опционально
    'note' => '',    // опционально
];
$client->note()->list($token, $data);
```