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

    /**
     * @inheritdoc
     */
    public static function find($arrConditions)
    {
        try {
            $db = new Database();
            $query = "SELECT * FROM  " . static::tableName() . " WHERE";
            $params = [];
            foreach ($arrConditions as $key => $val) {
                $query .= " " . $key . " = :" . $key;
                $params[':' . $key] = $val;
            }
            $sth = $db->prepare($query);
            $sth->execute($params);
            $data = $sth->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findById($id)
    {
        try {
            $db = new Database();
            $sth = $db->prepare("SELECT * FROM " . static::tableName() . " WHERE id = :id");
            $sth->execute(array(':id' => $id));
            $data = $sth->fetch();
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @inheritdoc
     */
    public static function delete($arrConditions)
    {
        try {
            $db = new Database();
            $query = "DELETE FROM  " . static::tableName();
            $arrWhere = [];
            $paramWhere = [];
            foreach ($arrConditions as $key => $val) {
                $arrWhere[] = " " . $key . " = :" . $key;
                $paramWhere[':' . $key] = $val;
            }
            $query .= ' WHERE ' . implode(' AND ', $arrWhere);
            $sth = $db->prepare($query);
            return $sth->execute($paramWhere);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @inheritdoc
     */
    public static function update($arrFields, $arrConditions)
    {
        try {
            $db = new Database();
            $query = "UPDATE " . static::tableName();
            // set sql
            $arrSet = [];
            $paramSet = [];
            foreach ($arrFields as $key => $val) {
                $arrSet[] = " " . $key . " = :" . $key;
                $paramSet[':' . $key] = $val;
            }
            $query .= ' SET ' . implode(', ', $arrSet);

            // where sql
            $arrWhere = [];
            $paramWhere = [];
            foreach ($arrConditions as $key => $val) {
                $arrWhere[] .= " " . $key . " = :" . $key;
                $paramWhere[':' . $key] = $val;
            }
            $query .= ' WHERE ' . implode(' AND ', $arrWhere);
            $params = array_merge($paramSet, $paramWhere);
            $sth = $db->prepare($query);
            return $sth->execute($params);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * @inheritdoc
     */
    public static function insert($arrFields)
    {
        try {
            $db = new Database();
            $query = "INSERT INTO " . static::tableName();
            $fields = [];
            $values = [];
            $params = [];
            foreach ($arrFields as $key => $val) {
                $fields[] = $key;
                $values[] = ':' . $key;
                $params[':' . $key] = $val;
            }
            $query .= '(' . implode(', ', $fields) . ')';
            $query .= ' VALUES ' . '(' . implode(', ', $values) . ')';
            $sth = $db->prepare($query);
            return $sth->execute($params);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}