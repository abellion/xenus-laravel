<?php

namespace Xenus\Laravel\Tests\Mocks;

use Illuminate\Events\Dispatcher;

class EventDispatcherMock extends Dispatcher
{
    private $dispatched = [];

    /**
     * Dispatch the given event
     *
     * @param  string|object  $event
     * @param  mixed          $payload
     * @param  bool           $halt
     *
     * @return void
     */
    public function dispatch($event, $payload = [], $halt = false)
    {
        $this->dispatched[] = $event;
    }
}
