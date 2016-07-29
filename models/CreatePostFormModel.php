<?php
require 'PostModel.php';

class CreatePostFormModel extends FormModel
{
    public $title;
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
        if (empty($this->title)) {
            $this->errors[] = 'Title is required';
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
            $post = new PostModel();
            $post->title = $this->title;
            $post->content = $this->content;

            $post->save();
            return null;
        }

        return $this->errors;
    }
}