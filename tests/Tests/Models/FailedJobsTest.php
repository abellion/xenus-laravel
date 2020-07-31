<?php

namespace Xenus\Laravel\Tests\Tests\Models;

use Xenus\Laravel\Models\FailedJobs;
use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

class FailedJobsTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsTest;

    public function test_collection_is_correctly_constructed()
    {
        $collection = new FailedJobs($this->connection, 'failed-jobs');

        $this->assertEquals(
            'failed-jobs', $collection->getCollectionName()
        );
    }
}
