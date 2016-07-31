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
}