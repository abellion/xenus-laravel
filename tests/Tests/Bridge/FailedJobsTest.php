<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Models\FailedJobs as FailedJobsModel;
use Xenus\Laravel\Bridge\FailedJobs as FailedJobsRepository;

use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

use MongoDB\BSON\ObjectID;

class FailedJobsTest extends \PHPUnit\Framework\TestCase
{
    use SetupFailedJobsTest;

    public function test_failed_jobs_are_correctly_logged()
    {
        $repository = new FailedJobsRepository(
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
        $repository = new FailedJobsRepository(
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
        $repository = new FailedJobsRepository(
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
        $repository = new FailedJobsRepository(
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
        $repository = new FailedJobsRepository(
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
