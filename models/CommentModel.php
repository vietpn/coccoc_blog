<?php

class CommentModel extends DbModel
{
    public $id;
    public $post_id;
    public $username;
    public $content;
    public $date_created;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }
}