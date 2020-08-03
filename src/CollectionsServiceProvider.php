<?php

namespace Xenus\Laravel;

use Closure;
use Illuminate\Support\ServiceProvider;

use Xenus\Laravel\Support\CollectionExtender;

class CollectionsServiceProvider extends ServiceProvider
{
    /**
     * The collections to register
     * @var array
     */
    protected $collections = [];

    /**
     * Register all the Xenus collections
     *
     * @return void
     */
    public function register()
    {
        $extender = new CollectionExtender($this->app);

        foreach ($this->collections as $collection) {
            $this->bind($collection)->extend(
                $collection, Closure::fromCallable([$extender, 'extend'])
            );
        }
    }

    /**
     * Bind the given collection to the service container
     *
     * @param  string $collection
     *
     * @return object
     */
    protected function bind(string $collection)
    {
        if (getenv('APP_ENV') !== 'testing') {
            $this->app->singleton($collection);
        }

        return $this->app;
    }

    /**
     * Set the collections to register
     *
     * @param  array $collections
     *
     * @return self
     */
    public function setCollections(array $collections)
    {
        $this->collections = $collections;

        return $this;
    }
}
