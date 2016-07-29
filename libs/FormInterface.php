<?php

interface FormInterface
{
    /**
     * validate data
     * @return bool
     */
    public function validate();

    /**
     * run form
     * @return mixed
     */
    public function run();
}