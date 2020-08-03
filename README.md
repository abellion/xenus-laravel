<p align="center">
    <a target="_blank" href="https://abellion.github.io/xenus/">
        <img src="https://res.cloudinary.com/abellion/image/upload/c_scale,w_300/v1535202916/logo_ilpt3s.png" />
    </a>
</p>

This package integrates Xenus to the Laravel and Lumen frameworks (from version `5.8` up to the latest `7.0`) :

- Out of the box **failed jobs** and **migrations** integration
- Binding to the Laravel **event dispatcher**

> Xenus is a simple and elegant ODM for MongoDB. Learn more : https://github.com/abellion/xenus

## Installation

- Require the package 🔽

```bash
composer require abellion/xenus-laravel
```

- Add your connection settings under `mongodb.connection` in `config/database.php` 🔽

```php
[
    'mongodb' => [
        'connection' => [
            'host' => 'mongodb://localhost:27017',
            'database' => 'my_database'
        ]
    ]
]
```

- Extend the `Xenus\Laravel\XenusServiceProvider` and declare your collections 🔽

```php
namespace App\Providers;

use Xenus\Laravel\XenusServiceProvider;

class CollectionsServiceProvider extends XenusServiceProvider
{
    protected $collections = [
        MyCollection::class
    ];
}
```

Declaring your collections is necessary in order for Xenus to extend them with the Laravel's event dispatcher. Additionally, they will be registered as singletons in the service container for optimal performances.

## Failed jobs and migrations

The failed jobs and migrations bridges come pre-configured and ready to work. If you want to change the default collections names they use, edit the following :

**For the migrations :**

```php
// config/database.php

[
    'migrations' => 'my_migration_collection'
]
```

**For the failed jobs :**

```php
// config/queue.php

[
    'failed' => [
        'collection' => 'my_failed_jobs_collection'
    ]
]
```

## License

Xenus is licensed under the [MIT license](http://opensource.org/licenses/MIT).
