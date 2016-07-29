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
     */
    public function get()
    {
        $sth = $this->db->prepare("SELECT * FROM " . static::tableName() . " WHERE id = :id");
        $sth->execute(array(':id' => $this->id));
        $data = $sth->fetch();
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $sth = $this->db->prepare("INSERT INTO " . static::tableName() . "(title, content) VALUES(:title, :content)");
        return $sth->execute(array(
            ':title' => $this->title,
            ':content' => $this->content
        ));
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        CommentModel::deleteCommentByPostId($this->id);
        $sth = $this->db->prepare("DELETE FROM  " . static::tableName() . " WHERE id = :id");
        return $sth->execute(array(':id' => $this->id));
    }

    /**
     * @inheritdoc
     */
    public function update()
    {
        $sth = $this->db->prepare("UPDATE " . static::tableName() . " SET title=:title, content=:content WHERE id = :id");
        return $sth->execute(array(
            ':title' => $this->title,
            ':content' => $this->content,
            ':id' => $this->id
        ));
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