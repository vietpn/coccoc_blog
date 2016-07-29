<?php
require 'models/CreatePostFormModel.php';
require 'models/UpdatePostFormModel.php';
require 'models/UserModel.php';
require 'models/CreateCommentFormModel.php';

class post extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
    }

    /**
     * Read detail a post
     * @param $id
     */
    public function read($id)
    {
        $readPost = new PostModel();
        $readPost->id = $id;

        if (!empty(Session::get('user_id'))) {
            $user = new UserModel();
            $user->id = Session::get('user_id');
            $this->view->user = $user->get();
        }

        $this->view->post = $readPost->get();
        $this->view->comments = CommentModel::getCommentByPostId($id);

        if (!empty($_POST)) {
            $createCommentForm = new CreateCommentFormModel();
            $createCommentForm->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $createCommentForm->content = (!empty($_POST['content'])) ? $_POST['content'] : null;
            $createCommentForm->post_id = $id;
            $errors = $createCommentForm->run();
            if (empty($errors)) {
                header('location: ' . URL . 'post/read/' . $id);
            }
            $this->view->errors = $errors;
        }

        $this->view->render('post/read');
    }

    /**
     * Create new post
     */
    public function create()
    {
        Auth::handleLogin();

        if (!empty($_POST)) {
            $createPostForm = new CreatePostFormModel();
            $createPostForm->title = $_POST['title'];
            $createPostForm->content = $_POST['content'];
            $errors = $createPostForm->run();
            if (empty($errors)) {
                header('location: ' . URL . 'index');
            }
            $this->view->errors = $errors;
            $this->view->render('post/create');
        } else {
            $this->view->render('post/create');
        }
    }

    /**
     * Delete post
     * @param $id
     */
    public function delete($id)
    {
        Auth::handleLogin();

        $deletePost = new PostModel();
        $deletePost->id = $id;
        $deletePost->delete();

        header('location: ' . URL . 'index');
    }

    /**
     * Update post
     * @param $id
     */
    public function update($id)
    {
        Auth::handleLogin();

        $updatePost = new PostModel();
        $updatePost->id = $id;
        $this->view->post = $updatePost->get();

        if (!empty($_POST)) {
            $updatePostForm = new UpdatePostFormModel();
            $updatePostForm->title = (!empty($_POST['title'])) ? $_POST['title'] : null;
            $updatePostForm->content = (!empty($_POST['content'])) ? $_POST['content'] : null;
            $updatePostForm->id = $id;
            $errors = $updatePostForm->run();
            if (empty($errors)) {
                header('location: ' . URL . 'post/read/' . $id);
            }

            $this->view->errors = $errors;
            $this->view->render('post/update');
        } else {
            $this->view->render('post/update');
        }
    }
}