<?php

namespace Xenus\Laravel\Support;

use MongoDB\BSON\ObjectID;
use Illuminate\Support\Arr;

class FailedJobFactory
{
    /**
     * Create a failed job
     *
     * @param  string     $connection
     * @param  string     $queue
     * @param  string     $payload
     * @param  Exception  $exception
     *
     * @return array
     */
    public static function create($connection, $queue, $payload, $exception)
    {
        $document = [];

        Arr::set(
            $document, '_id', new ObjectID()
        );

        Arr::set(
            $document, 'connection', $connection
        );

        Arr::set(
            $document, 'queue', $queue
        );

        Arr::set(
            $document, 'payload', $payload
        );

        Arr::set(
            $document, 'exception', (string) $exception
        );

        Arr::set(
            $document, 'failed_at', time()
        );

        Arr::set(
            $document, 'id', (string) $document['_id']
        );

        return $document;
    }
}
