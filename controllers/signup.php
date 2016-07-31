<?php
require 'models/SignupFormModel.php';

class signup extends Controller
{
    public function __construct()
    {

        parent::__construct();
        Session::init();
    }


    public function index()
    {
        $signupForm = new SignupFormModel();
        $this->view->signupForm = $signupForm;

        if (!empty($_POST)) {
            $signupForm->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $signupForm->password = (!empty($_POST['password'])) ? $_POST['password'] : null;
            $signupForm->confirm_password = (!empty($_POST['confirm_password'])) ? $_POST['confirm_password'] : null;
            if ($signupForm->validate() && $signupForm->run()) {
                header('location: ' . URL . 'login');
            }
            $this->view->errors = $signupForm->errors;
            $this->view->render('signup/index');
        } else {
            $this->view->render('signup/index');
        }
    }
}