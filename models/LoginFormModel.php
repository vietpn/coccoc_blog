<?php
require 'UserModel.php';

class LoginFormModel extends FormModel
{

    public $username;
    public $password;

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

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            $user = new UserModel();
            $user->username = $this->username;
            $user->password = $this->password;
            $data = $user->getByUsernamePass();

            if (empty($data)) {
                $this->errors['username'] = 'Username or Password is not correct';
                return false;
            }

            Session::init();
            Session::set('loggedIn', true);
            Session::set('user_id', $data['id']);
            return true;
        } else {
            return false;
        }
    }
}