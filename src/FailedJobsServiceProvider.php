<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

use Xenus\Connection;

use Xenus\Laravel\Bridge\FailedJobsProvider;
use Xenus\Laravel\Models\FailedJobs as FailedJobsModel;

class FailedJobsServiceProvider extends ServiceProvider
{
    /**
     * The default collection name to store the failed jobs
     */
    protected const DEFAULT_COLLECTION_NAME = 'failed_jobs';

    /**
     * Register the failed jobs repository
     *
     * @return void
     */
    public function register()
    {
        $collection = $this->app->config->get('queue.failed.collection', static::DEFAULT_COLLECTION_NAME);

        $this->app->extend('queue.failer', function () use ($collection) {
            return new FailedJobsProvider(
                new FailedJobsModel($this->app->make(Connection::class), $collection)
            );
        });
    }
}
