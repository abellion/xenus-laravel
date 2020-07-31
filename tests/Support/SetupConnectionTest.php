<?php

namespace Xenus\Laravel\Tests\Support;

trait SetupConnectionTest
{
    use SetupApplication, SetupTestsHooks;

    private $setup = [
        'createApplication'
    ];
}
