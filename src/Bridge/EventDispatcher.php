<?php

namespace Xenus\Laravel\Bridge;

use Illuminate\Contracts\Events\Dispatcher;

use Xenus\EventDispatcher as EventDispatcherContract;

class EventDispatcher implements EventDispatcherContract
{
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Dispatch the given event
     *
     * @param  object $event
     *
     * @return void
     */
    public function dispatch($event)
    {
        $this->dispatcher->dispatch(
            $event
        );
    }
}
