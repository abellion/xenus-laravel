<?php

namespace Xenus\Laravel\Tests\Tests\Models;

use Xenus\Laravel\Models\FailedJobs;
use Xenus\Laravel\Tests\Support\SetupFailedJobsTest;

use MongoDB\Model\BSONDocument;

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

    public function test_documents_are_bson()
    {
        $collection = new FailedJobs($this->connection);

        $collection->insertOne([
            'key' => 'val'
        ]);

        $this->assertInstanceOf(
            BSONDocument::class, $collection->findOne()
        );
    }
}
