<?php

namespace Xenus\Laravel\Tests\Support;

trait SetupMigrationsTest
{
    use SetupTestsHooks, SetupDatabase;

    private $setup = [
        'createDatabase'
    ];

    private $tearDown = [
        'deleteDatabase'
    ];
}
