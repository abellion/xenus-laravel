<?php

namespace Xenus\Laravel\Bridge;

use Illuminate\Support\Arr;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;

use Xenus\Laravel\Support\MigrationsSetup;
use Xenus\Laravel\Models\Migrations as Repository;

class MigrationsRepository implements MigrationRepositoryInterface
{
    use MigrationsSetup;

    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of migrations
     *
     * @param  int  $steps
     *
     * @return array
     */
    public function getMigrations($steps)
    {
        $result = $this->repository->find(['batch' => ['$gte' => 1]], [
            'sort' => ['batch' => -1], 'limit' => $steps
        ]);

        return iterator_to_array($result);
    }

    /**
     * Get the completed migrations
     *
     * @return array
     */
    public function getRan()
    {
        $result = $this->repository->find([], [
            'sort' => ['batch' => 1]
        ]);

        return Arr::pluck($result, 'migration');
    }

    /**
     * Get the last migration batch
     *
     * @return array
     */
    public function getLast()
    {
        $result = $this->repository->find([
            'batch' => $this->getNextBatchNumber() - 1
        ]);

        return iterator_to_array($result);
    }

    /**
     * Get the completed migrations with their batch numbers
     *
     * @return array
     */
    public function getMigrationBatches()
    {
        $result = $this->repository->find([], [
            'sort' => ['batch' => 1]
        ]);

        return Arr::pluck($result, 'batch', 'migration');
    }

    /**
     * Log that a migration was run
     *
     * @param  string  $file
     * @param  int     $batch
     *
     * @return void
     */
    public function log($file, $batch)
    {
        $this->repository->insertOne([
            'migration' => $file, 'batch' => $batch
        ]);
    }

    /**
     * Remove a migration from the log
     *
     * @param  object  $migration
     *
     * @return void
     */
    public function delete($migration)
    {
        $this->repository->deleteOne([
            'migration' => $migration->migration
        ]);
    }

    /**
     * Get the next migration batch number
     *
     * @return int
     */
    public function getNextBatchNumber()
    {
        $result = $this->repository->findOne([], [
            'sort' => ['batch' => -1]
        ]);

        return ($result) ? $result['batch'] + 1 : 1;
    }

    /**
     * Delete the migration repository data store
     *
     * @return void
     */
    public function deleteRepository()
    {
        $this->repository->drop();
    }
}
