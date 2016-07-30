<?php

class UpdatePostFormModel extends FormModel
{
    public $id;
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

        if (empty($this->id)) {
            $this->errors[] = 'Id is required';
        }

        return (empty($this->errors)) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->validate()) {
            PostModel::update(
                array('title' => $this->title, 'content' => $this->content),
                array('id' => $this->id)
            );
            return null;
        }

        return $this->errors;
    }
}