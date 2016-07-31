<?php
require 'models/PostModel.php';
require 'models/UserModel.php';
require 'models/CommentModel.php';

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
        if (!empty(Session::get('user_id'))) {
            $this->view->user = UserModel::findById(Session::get('user_id'));
        }

        $this->view->post = PostModel::findById($id);
        $this->view->comments = CommentModel::find(array('post_id' => $id));
        $comment = new CommentModel();
        $comment->post_id = $id;

        if (!empty($_POST)) {
            $comment->username = (!empty($_POST['username'])) ? $_POST['username'] : null;
            $comment->content = (!empty($_POST['content'])) ? $_POST['content'] : null;

            if ($comment->validate() && $comment->save()) {
                header('location: ' . URL . 'post/read/' . $id);
            }
            $this->view->errors = $comment->errors;
        }

        $this->view->render('post/read');
    }

    /**
     * Create new post
     */
    public function create()
    {
        Auth::handleLogin();

        $post = new PostModel();
        $this->view->post = $post;

        if (!empty($_POST)) {
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            if ($post->validate() && $post->save()) {
                header('location: ' . URL . 'index');
            }
            $this->view->errors = $post->errors;
        }

        $this->view->render('post/create');
    }

    /**
     * Delete post
     * @param $id
     */
    public function delete($id)
    {
        Auth::handleLogin();

        PostModel::delete(array('id' => $id));
        CommentModel::delete(array('post_id' => $id));

        header('location: ' . URL . 'index');
    }

    /**
     * Update post
     * @param $id
     */
    public function update($id)
    {
        Auth::handleLogin();

        $findPost = PostModel::findById($id);
        $post = new PostModel();
        $this->view->post = $post;

        if (!empty($findPost)) {
            $post->id = $findPost['id'];
            $post->title = $findPost['title'];
            $post->content = $findPost['content'];
        }

        if (!empty($_POST)) {
            $post->title = (!empty($_POST['title'])) ? $_POST['title'] : null;
            $post->content = (!empty($_POST['content'])) ? $_POST['content'] : null;
            if ($post->validate() && $post->save(array('id' => $post->id))) {
                header('location: ' . URL . 'post/read/' . $id);
            }
            $this->view->errors = $post->errors;
        }

        $this->view->render('post/update');
    }
}