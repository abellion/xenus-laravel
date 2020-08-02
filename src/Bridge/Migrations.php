<?php

namespace Xenus\Laravel\Bridge;

use Illuminate\Database\Migrations\MigrationRepositoryInterface;

use Xenus\Laravel\Support\MigrationsSetup;

class Migrations implements MigrationRepositoryInterface
{
    use MigrationsSetup;

    /**
     * Get the completed migrations
     *
     * @return array
     */
    public function getRan()
    {

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

    }

    /**
     * Get the last migration batch
     *
     * @return array
     */
    public function getLast()
    {

    }

    /**
     * Get the completed migrations with their batch numbers
     *
     * @return array
     */
    public function getMigrationBatches()
    {

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

    }

    /**
     * Get the next migration batch number
     *
     * @return int
     */
    public function getNextBatchNumber()
    {

    }
}
