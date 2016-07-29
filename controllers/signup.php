<?php
require 'models/SignupFormModel.php';

class signup extends Controller
{
    private $signupForm;

    public function __construct()
    {
        $this->signupForm = new SignupFormModel();
        parent::__construct();
        Session::init();
    }


    public function index()
    {
        if (!empty($_POST)) {
            $this->signupForm->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $this->signupForm->password = (!empty($_POST['password'])) ? $_POST['password'] : null;
            $this->signupForm->confirm_password = (!empty($_POST['confirm_password'])) ? $_POST['confirm_password'] : null;
            $errors = $this->signupForm->run();
            if (empty($errors)) {
                header('location: ' . URL . 'login');
            }
            $this->view->errors = $errors;
            $this->view->render('signup/index');
        } else {
            $this->view->render('signup/index');
        }
    }
}