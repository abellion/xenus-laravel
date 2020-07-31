<?php

namespace Xenus\Laravel\Tests\Support;

trait SetupFailedJobsTest
{
    use SetupTestsHooks, SetupDatabase;

    private $setup = [
        'createDatabase'
    ];

    private $tearDown = [
        'deleteDatabase'
    ];
}
