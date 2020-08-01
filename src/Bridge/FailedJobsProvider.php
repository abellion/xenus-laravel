<?php

namespace Xenus\Laravel\Bridge;

use MongoDB\BSON\ObjectID;
use Illuminate\Queue\Failed\FailedJobProviderInterface;

use Xenus\Laravel\Models\FailedJobs as Repository;

class FailedJobsProvider implements FailedJobProviderInterface
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Log a failed job into storage
     *
     * @param  string     $connection
     * @param  string     $queue
     * @param  string     $payload
     * @param  Exception  $exception
     *
     * @return string
     */
    public function log($connection, $queue, $payload, $exception)
    {
        //
    }

    /**
     * Get a single failed job
     *
     * @param  mixed  $id
     *
     * @return object|null
     */
    public function find($id)
    {
        return $this->repository->findOne(
            new ObjectID($id)
        );
    }

    /**
     * Get a list of all of the failed jobs
     *
     * @return array
     */
    public function all()
    {
        return iterator_to_array(
            $this->repository->find()
        );
    }

    /**
     * Delete a single failed job from storage
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    public function forget($id)
    {
        $result = $this->repository->deleteOne(
            new ObjectID($id)
        );

        return $result->getDeletedCount() >= 1;
    }

    /**
     * Flush all of the failed jobs from storage
     *
     * @return void
     */
    public function flush()
    {
        $this->repository->deleteMany([]);
    }
}
