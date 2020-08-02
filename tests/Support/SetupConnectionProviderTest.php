<?php

namespace Xenus\Laravel\Tests\Support;

trait SetupConnectionProviderTest
{
    use SetupApplication, SetupTestsHooks;

    private $setup = [
        'createApplication'
    ];
}
