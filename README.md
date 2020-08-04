<p align="center">
    <a target="_blank" href="https://abellion.github.io/xenus/">
        <img src="https://res.cloudinary.com/abellion/image/upload/c_scale,w_300/v1535202916/logo_ilpt3s.png" />
    </a>
</p>

This package integrates [Xenus](https://github.com/abellion/xenus) to the Laravel and Lumen frameworks (from version `5.8` up to the latest `7.0`) :

- Out of the box **failed jobs** and **migrations** integration
- Ready to work **event dispatcher**

> Xenus is a simple and elegant ODM for MongoDB. Learn more : https://github.com/abellion/xenus

## Installation

If you haven't already installed [Xenus](https://github.com/abellion/xenus), and thus satisfied its requirement to the `mondogd` extension, make sure to install the extension before requiring this package : https://www.php.net/manual/en/mongodb.installation.php
Once installed, require the package :

```bash
composer require abellion/xenus-laravel
```

## Configuration

An instance of the `Xenus\Connection` class will automatically be constructed and registered inside the service container for you.
To do so, Xenus reads the connection's settings from your `config/database.php` file under the `mongodb.connection` key. It must at least contain the `host` and the `database` you wish to connect to :

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

## Service provider

In order to configure your collections, that is linking them to the Laravel's event dispatcher and defining them as singleton inside the service container, you must create a service provider.
This service provider must extend `Xenus\Laravel\XenusServiceProvider` and contain a `$collections` property holding your collections :

```php
use Xenus\Laravel\XenusServiceProvider as ServiceProvider;

class XenusServiceProvider extends ServiceProvider
{
    protected $collections = [
        MyCollection::class
    ];
}
```

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
