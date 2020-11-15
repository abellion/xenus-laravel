<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\FailedJobsServiceProvider;
use Xenus\Laravel\Bridge\FailedJobsProvider;
use Xenus\Laravel\Tests\Support\SetupFailedJobsProviderTest;

class FailedJobsServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsProviderTest;

    public function test_failed_jobs_repository_is_correctly_registered()
    {
        (new FailedJobsServiceProvider($this->container))->register();

        $this->assertInstanceOf(
            FailedJobsProvider::class, $this->container->get('queue.failer')
        );
    }
}
