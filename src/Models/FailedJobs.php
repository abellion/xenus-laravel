<?php

namespace Xenus\Laravel\Models;

use Xenus\Collection;
use Xenus\Connection;

class FailedJobs extends Collection
{
    public function __construct(Connection $connection, string $collection = 'failed_jobs')
    {
        parent::__construct($connection, [
            'name' => $collection
        ]);
    }
}
