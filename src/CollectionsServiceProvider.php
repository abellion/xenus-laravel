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
            $this->app->extend($collection, Closure::fromCallable([$extender, 'extend']));

            if (getenv('APP_ENV') !== 'testing') {
                $this->app->singleton($collection);
            }
        }
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
