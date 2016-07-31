<?php

abstract class FormModel extends Model implements FormInterface
{
    /**
     * List errors
     * @var array
     */
    public $errors = [];

    /**
     * Validate fields
     * @return bool
     */
    public function validate()
    {
        return (empty($this->errors)) ? true : false;
    }
}