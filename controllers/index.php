<?php
require 'models/PostModel.php';

class Index extends Controller
{
    public $posts = [];

    public function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function index()
    {
        $this->view->posts = PostModel::getAllPosts();
        $this->view->render('index/index');
    }

    public function logout()
    {
        Session::destroy();
        header('location: ' . URL . 'login');
        exit;
    }

}