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
            $this->errors[] = 'Name is required';
        }

        if (empty($this->content)) {
            $this->errors[] = 'Comment is required';
        }

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            CommentModel::insert(
                array(
                    'username' => $this->username,
                    'content' => $this->content,
                    'post_id' => $this->post_id
                )
            );
            return null;
        }

        return $this->errors;
    }
}