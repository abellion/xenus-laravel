<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Models\FailedJobs;
use Xenus\Laravel\Bridge\FailedJobsProvider;
use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

use MongoDB\BSON\ObjectID;

class FailedJobsProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsTest;

    public function test_failed_jobs_are_correctly_logged()
    {
        $provider = new FailedJobsProvider(
            $collection = new FailedJobs($this->connection)
        );

        $provider->log(
            'connection', 'queue', 'payload', 'exception'
        );

        $this->assertEquals(
            1, $collection->count()
        );
    }

    public function test_failed_jobs_are_correctly_flushed()
    {
        $provider = new FailedJobsProvider(
            $collection = new FailedJobs($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertEquals(
            1, $collection->count()
        );

        $provider->flush();

        $this->assertEquals(
            0, $collection->count()
        );
    }

    public function test_failed_jobs_are_correctly_forgotten()
    {
        $provider = new FailedJobsProvider(
            $collection = new FailedJobs($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertEquals(
            1, $collection->count()
        );

        $provider->forget(
            new ObjectID()
        );

        $this->assertEquals(
            1, $collection->count()
        );

        $provider->forget(
            $id
        );

        $this->assertEquals(
            0, $collection->count()
        );
    }

    public function test_all_failed_jobs_are_correctly_retrieved()
    {
        $provider = new FailedJobsProvider(
            $collection = new FailedJobs($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $items = $provider->all();

        $this->assertIsArray(
            $items
        );

        $this->assertCount(
            1, $items
        );
    }

    public function test_failed_jobs_are_correctly_found()
    {
        $provider = new FailedJobsProvider(
            $collection = new FailedJobs($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertNotNull(
            $provider->find((string) $id)
        );

        $this->assertNull(
            $provider->find((string) new ObjectID())
        );
    }
}
