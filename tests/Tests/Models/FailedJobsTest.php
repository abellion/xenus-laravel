<?php

namespace Xenus\Laravel\Tests\Tests\Models;

use Xenus\Laravel\Models\FailedJobs;
use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

class FailedJobsTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsTest;

    public function test_documents_are_castable_to_array()
    {
        $collection = new FailedJobs($this->connection);

        $collection->insertOne([
            'key' => 'val'
        ]);

        $this->assertArrayHasKey(
            'key', (array) $collection->findOne()
        );
    }
}
