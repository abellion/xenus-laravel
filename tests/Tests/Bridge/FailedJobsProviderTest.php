<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Bridge\FailedJobsProvider;
use Xenus\Laravel\Models\FailedJobs as FailedJobsModel;

use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

use MongoDB\BSON\ObjectID;

class FailedJobsProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsTest;

    public function test_failed_jobs_are_correctly_logged()
    {
        $repository = new FailedJobsProvider(
            $collection = new FailedJobsModel($this->connection)
        );

        $repository->log(
            'connection', 'queue', 'payload', 'exception'
        );

        $this->assertEquals(
            1, $collection->count()
        );
    }

    public function test_failed_jobs_are_correctly_flushed()
    {
        $repository = new FailedJobsProvider(
            $collection = new FailedJobsModel($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertEquals(
            1, $collection->count()
        );

        $repository->flush();

        $this->assertEquals(
            0, $collection->count()
        );
    }

    public function test_failed_jobs_are_correctly_forgotten()
    {
        $repository = new FailedJobsProvider(
            $collection = new FailedJobsModel($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertEquals(
            1, $collection->count()
        );

        $repository->forget(
            new ObjectID()
        );

        $this->assertEquals(
            1, $collection->count()
        );

        $repository->forget(
            $id
        );

        $this->assertEquals(
            0, $collection->count()
        );
    }

    public function test_all_failed_jobs_are_correctly_retrieved()
    {
        $repository = new FailedJobsProvider(
            $collection = new FailedJobsModel($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $items = $repository->all();

        $this->assertIsArray(
            $items
        );

        $this->assertCount(
            1, $items
        );
    }

    public function test_failed_jobs_are_correctly_found()
    {
        $repository = new FailedJobsProvider(
            $collection = new FailedJobsModel($this->connection)
        );

        $collection->insertOne([
            '_id' => $id = new ObjectID()
        ]);

        $this->assertNotNull(
            $repository->find((string) $id)
        );

        $this->assertNull(
            $repository->find((string) new ObjectID())
        );
    }
}
