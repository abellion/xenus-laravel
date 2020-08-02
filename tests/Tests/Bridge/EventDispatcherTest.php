<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Bridge\EventDispatcher;
use Xenus\Laravel\Tests\Mocks\EventDispatcherMock;

class EventDispatcherTest extends \PHPUnit\Framework\TestCase
{
    public function test_event_dispatcher_correctly_dispatches_events()
    {
        $ed = new EventDispatcher(
            $edm = new EventDispatcherMock()
        );

        $ed->dispatch(
            'some_event'
        );

        $this->assertContains(
            'some_event', $edm->dispatched
        );
    }
}
