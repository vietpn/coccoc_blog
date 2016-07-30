<?php

interface DbInterface
{
    /**
     * Return table name
     * @return mixed
     */
    public static function tableName();

    /**
     * Find record by conditions
     * @param $arrConditions
     * @return mixed
     */
    public static function find($arrConditions);

    /**
     * Find record by id
     * @param $id
     * @return mixed
     */
    public static function findById($id);

    /**
     * Insert new record
     * @param $arrFields
     * @return mixed
     */
    public static function insert($arrFields);

    /**
     * Delete record
     * @param $arrConditions
     * @return mixed
     */
    public static function delete($arrConditions);

    /**
     * Update record
     * @param $arrFields
     * @param $arrConditions
     * @return mixed
     */
    public static function update($arrFields, $arrConditions);
}