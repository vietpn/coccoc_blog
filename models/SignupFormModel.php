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
        $user = new UserModel();
        $user->username = $this->username;

        if (empty($this->username)) {
            $this->errors[] = 'User name is required';
        }
        if (empty($this->password)) {
            $this->errors[] = 'Password is required';
        }
        if (!empty($user->getByUsername())) {
            $this->errors[] = 'Username is existing';
        }
        if ($this->password != $this->confirm_password) {
            $this->errors[] = 'Password confirm is invalid';
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

            $user->save();
            return null;
        }

        return $this->errors;
    }
}