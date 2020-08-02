<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Models\Migrations as MigrationsModel;
use Xenus\Laravel\Bridge\Migrations as MigrationsRepository;

use Xenus\Laravel\Tests\Support\SetupMigrationsTest;

class MigrationsTest extends \PHPUnit\Framework\TestCase
{
    use SetupMigrationsTest;

    public function test_ran_migration_are_correctly_ordered()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $collection->insertOne([
            'batch' => 2, 'migration' => 'B'
        ]);

        $collection->insertOne([
            'batch' => 1, 'migration' => 'A'
        ]);

        $collection->insertOne([
            'batch' => 3, 'migration' => 'C'
        ]);

        $migrations = $repository->getRan();

        $this->assertEquals(
            'A', $migrations[0]
        );

        $this->assertEquals(
            'B', $migrations[1]
        );

        $this->assertEquals(
            'C', $migrations[2]
        );
    }

    public function test_next_batch_number_is_correctly_computed()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $this->assertEquals(
            1, $repository->getNextBatchNumber()
        );

        $collection->insertOne([
            'batch' => 1, 'migration' => 'A'
        ]);

        $collection->insertOne([
            'batch' => 2, 'migration' => 'B'
        ]);

        $this->assertEquals(
            3, $repository->getNextBatchNumber()
        );
    }

    public function test_delete_method_works_as_expected()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $collection->insertOne([
            'batch' => 0, 'migration' => 'A'
        ]);

        $this->assertEquals(
            1, $collection->count()
        );

        $repository->delete(
            $collection->findOne()
        );

        $this->assertEquals(
            0, $collection->count()
        );
    }

    public function test_batches_are_correctly_formatted()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $collection->insertOne([
            'batch' => 0, 'migration' => 'A'
        ]);

        $collection->insertOne([
            'batch' => 1, 'migration' => 'B'
        ]);

        $this->assertEquals(
            ['A' => 0, 'B' => 1], $repository->getMigrationBatches()
        );
    }

    public function test_migrations_are_correctly_ordered()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $collection->insertOne([
            'batch' => 2, 'migration' => 'B'
        ]);

        $collection->insertOne([
            'batch' => 1, 'migration' => 'A'
        ]);

        $collection->insertOne([
            'batch' => 3, 'migration' => 'C'
        ]);

        $migrations = $repository->getMigrations(3);

        $this->assertEquals(
            3, $migrations[0]['batch']
        );

        $this->assertEquals(
            2, $migrations[1]['batch']
        );

        $this->assertEquals(
            1, $migrations[2]['batch']
        );
    }

    public function test_last_batch_is_correctly_computed()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $collection->insertOne([
            'batch' => 1, 'migration' => 'A'
        ]);

        $collection->insertOne([
            'batch' => 1, 'migration' => 'B'
        ]);

        $collection->insertOne([
            'batch' => 2, 'migration' => 'C'
        ]);

        $migrations = $repository->getLast();

        $this->assertCount(
            1, $migrations
        );

        $this->assertEquals(
            'C', $migrations[0]['migration']
        );
    }

    public function test_log_method_works_as_expected()
    {
        $repository = new MigrationsRepository(
            $collection = new MigrationsModel($this->connection)
        );

        $repository->log(
            'file', 'batch'
        );

        $this->assertEquals(
            1, $collection->count()
        );

        $migration = $collection->findOne();

        $this->assertEquals(
            'file', $migration['migration']
        );

        $this->assertEquals(
            'batch', $migration['batch']
        );
    }
}
