<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

use Xenus\Connection;

use Xenus\Laravel\Models\FailedJobs as FailedJobsModel;
use Xenus\Laravel\Bridge\FailedJobs as FailedJobsRepository;

class FailedJobsServiceProvider extends ServiceProvider
{
    /**
     * Register the failed jobs collection
     *
     * @return void
     */
    public function register()
    {
        $collection = $this->app->config->get('queue.failed.collection', 'failed_jobs');

        $this->app->extend('queue.failer', function () use ($collection) {
            return new FailedJobsRepository(
                new FailedJobsModel($this->app->make(Connection::class), $collection)
            );
        });
    }
}
