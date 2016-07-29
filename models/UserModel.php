<?php

class UserModel extends DbModel
{
    public $id;
    public $username;
    public $password;
    public $date_created;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        $sth = $this->db->prepare("SELECT id,username FROM " . static::tableName() . " WHERE id = :id");
        $sth->execute(array(':id' => $this->id));
        $data = $sth->fetch();
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $sth = $this->db->prepare("INSERT INTO " . static::tableName() . "(username, password) VALUES(:username, md5(:password))");
        return $sth->execute(array(
            ':username' => $this->username,
            ':password' => $this->password
        ));
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {

    }

    /**
     * @inheritdoc
     */
    public function update()
    {

    }

    /**
     * Get user by username and password
     * @return array
     */
    public function getByUsernamePass()
    {
        $sth = $this->db->prepare("SELECT id FROM " . static::tableName() . " WHERE
				username = :username AND password = MD5(:password)");
        $sth->execute(array(
            ':username' => $this->username,
            ':password' => $this->password
        ));
        $data = $sth->fetch();
        return $data;
    }

    /**
     * get user by username
     * @return mixed
     */
    public function getByUsername(){
        $sth = $this->db->prepare("SELECT id FROM " . static::tableName() . " WHERE
				username = :username");
        $sth->execute(array(
            ':username' => $this->username,
        ));
        $data = $sth->fetch();
        return $data;
    }
}