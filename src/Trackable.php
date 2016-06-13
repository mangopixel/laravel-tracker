<?php

namespace Mangopixel\Tracker;

interface Trackable
{
    /**
     * Get an array with all fields that have been modified since last fetch.
     *
     * @return array
     */
    public function getNewData();

    /**
     * Get an array with all fields that have been modified since last fetch,
     * but with the data the model had before the last fetch.
     *
     * @return array
     */
    public function getOldData();

    /**
     * Get the changes associated with the changeable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function changes();
}