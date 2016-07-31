<?php
require 'UserModel.php';

class SignupFormModel extends FormModel
{
    public $username;
    public $password;
    public $confirm_password;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function validate()
    {
        if (empty($this->username)) {
            $this->errors['username'] = 'User name is required';
        }
        if (empty($this->password)) {
            $this->errors['password'] = 'Password is required';
        }
        if (!empty(UserModel::find(array('username' => $this->username)))) {
            $this->errors['username'] = 'Username is existing';
        }
        if ($this->password != $this->confirm_password) {
            $this->errors['confirm_password'] = 'Password confirm is invalid';
        }

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            return UserModel::insert(
                array(
                    'username' => $this->username,
                    'password' => md5($this->password)
                )
            );
        }

        return false;
    }
}