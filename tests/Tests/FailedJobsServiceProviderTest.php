<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\FailedJobsServiceProvider;
use Xenus\Laravel\Bridge\FailedJobs as FailedJobsRepository;
use Xenus\Laravel\Tests\Support\SetupFailedJobsProviderTest;

class FailedJobsServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsProviderTest;

    public function test_failed_jobs_collection_is_correctly_registered()
    {
        (new FailedJobsServiceProvider($this->container))->register();

        $this->assertInstanceOf(
            FailedJobsRepository::class, $this->container->get('queue.failer')
        );
    }
}
