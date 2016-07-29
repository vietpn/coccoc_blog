<?php

abstract class DbModel extends Model implements DbInterface
{
    /**
     * Return  table name
     * @return string
     */
    public static function tableName()
    {
        return '';
    }
}