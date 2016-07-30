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
            $this->errors['title'] = 'Title is required';
        }

        if (empty($this->content)) {
            $this->errors['content'] = 'Content is required';
        }

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            PostModel::insert(
                array(
                    'title' => $this->title,
                    'content' => $this->content
                )
            );
            return null;
        }

        return $this->errors;
    }
}