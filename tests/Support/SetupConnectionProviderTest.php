<?php

namespace Xenus\Laravel\Tests\Support;

trait SetupConnectionProviderTest
{
    use SetupTestsHooks, SetupApplication;

    private $setup = [
        'createApplication'
    ];
}
