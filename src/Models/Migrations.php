<?php

namespace Xenus\Laravel\Models;

use Xenus\Collection;
use Xenus\Connection;

use MongoDB\Model\BSONDocument;

class Migrations extends Collection
{
    protected $document = BSONDocument::class;

    public function __construct(Connection $connection, string $collection = 'migrations')
    {
        parent::__construct($connection, [
            'name' => $collection
        ]);
    }
}
