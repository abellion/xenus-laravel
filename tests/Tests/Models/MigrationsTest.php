<?php

namespace Xenus\Laravel\Tests\Tests\Models;

use Xenus\Laravel\Models\Migrations;
use Xenus\Laravel\Tests\Support\SetupMigrationsTest;

class MigrationsTest extends \PHPUnit\Framework\TestCase
{
    use SetupMigrationsTest;

    public function test_documents_are_castable_to_array()
    {
        $collection = new Migrations($this->connection);

        $collection->insertOne([
            'key' => 'val'
        ]);

        $this->assertArrayHasKey(
            'key', (array) $collection->findOne()
        );
    }
}
