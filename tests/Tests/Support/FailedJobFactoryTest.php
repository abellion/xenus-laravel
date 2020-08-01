<?php

namespace Xenus\Laravel\Tests\Tests\Support;

use Xenus\Laravel\Support\FailedJobFactory;

class FailedJobFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function test_failed_job_document_contains_all_the_necessary_fields()
    {
        $document = FailedJobFactory::build('connection', 'queue', 'payload', new \Exception());

        $this->assertArrayHasKey(
            'id', $document
        );

        $this->assertEquals(
            'connection', $document['connection']
        );

        $this->assertEquals(
            'queue', $document['queue']
        );

        $this->assertEquals(
            'payload', $document['payload']
        );

        $this->assertArrayHasKey(
            'failed_at', $document
        );

        $this->assertIsString(
            $document['exception']
        );
    }
}
