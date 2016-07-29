<?php
require 'models/LoginFormModel.php';

class Login extends Controller
{
    private $loginForm;

    public function __construct()
    {
        $this->loginForm = new LoginFormModel();
        parent::__construct();
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->loginForm->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $this->loginForm->password = (!empty($_POST['password'])) ? $_POST['password'] : null;
            $errors = $this->loginForm->run();
            if (empty($errors)) {
                header('location: ' . URL . 'index');
            }
            $this->view->errors = $errors;
            $this->view->render('login/index');
        } else {
            $this->view->render('login/index');
        }
    }
}