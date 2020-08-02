<?php

namespace Xenus\Laravel\Support;

trait MigrationsSetup
{
    /**
     * Create the migration repository data store
     *
     * @return void
     */
    public function createRepository()
    {
        // ...
    }

    /**
     * Determine if the migration repository exists
     *
     * @return bool
     */
    public function repositoryExists()
    {
        return true;
    }

    /**
     * Set the information source to gather data
     *
     * @param  string  $name
     *
     * @return void
     */
    public function setSource($name)
    {
        // ...
    }
}
