<?php
require 'models/LoginFormModel.php';

class Login extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $loginForm = new LoginFormModel();
        $this->view->loginForm = $loginForm;

        if (!empty($_POST)) {
            $loginForm->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $loginForm->password = (!empty($_POST['password'])) ? $_POST['password'] : null;
            if ($loginForm->validate() && $loginForm->run()) {
                header('location: ' . URL . 'index');
            }
            $this->view->errors = $loginForm->errors;
            $this->view->render('login/index');
        } else {
            $this->view->render('login/index');
        }
    }
}