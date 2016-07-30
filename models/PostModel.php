<?php

class PostModel extends DbModel
{
    public $id;
    public $title;
    public $content;
    public $date_created;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * Get all posts
     * @return array
     */
    public static function getAllPosts()
    {
        $db = new Database();
        $sth = $db->prepare("SELECT * FROM " . static::tableName() . " ORDER BY date_created DESC ");
        $sth->execute();

        $data = $sth->fetchAll();
        return $data;
    }
}