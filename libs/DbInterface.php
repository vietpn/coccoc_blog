<?php

interface DbInterface
{
    /**
     * Get record
     * @return mixed
     */
    public function get();

    /**
     * Create new record
     * @return mixed
     */
    public function save();

    /**
     * Delete record
     * @return mixed
     */
    public function delete();

    /**
     * Update record
     * @return mixed
     */
    public function update();
}