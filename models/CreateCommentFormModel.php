<?php
require 'CommentModel.php';

class CreateCommentFormModel extends FormModel
{
    public $post_id;
    public $username;
    public $content;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function validate()
    {
        if (empty($this->post_id)) {
            $this->errors[] = 'Post id is required';
        }

        if (empty($this->username)) {
            $this->errors[] = 'User name is required';
        }

        if (empty($this->content)) {
            $this->errors[] = 'Content is required';
        }

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            $comment = new CommentModel();
            $comment->username = $this->username;
            $comment->content = $this->content;
            $comment->post_id = $this->post_id;

            $comment->save();
            return null;
        }

        return $this->errors;
    }
}