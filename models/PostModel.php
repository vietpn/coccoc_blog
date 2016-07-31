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
     * @inheritdoc
     * @return bool
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
     * Save record
     * @return bool|mixed
     */
    public function save($condition = null)
    {
        if ($this->validate()) {
            try {
                if (empty($condition)) {
                    return PostModel::insert(
                        array('title' => $this->title, 'content' => $this->content)
                    );
                } else {
                    return PostModel::update(
                        array('title' => $this->title, 'content' => $this->content),
                        $condition
                    );
                }
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }

    /**
     * Get all posts
     * @return array
     */
    public static function getAllPosts()
    {
        try {
            $db = new Database();
            $sth = $db->prepare("SELECT * FROM " . static::tableName() . " ORDER BY date_created DESC ");
            $sth->execute();

            $data = $sth->fetchAll();
            return $data;
        } catch (Exception $e) {
            return [];
        }
    }
}