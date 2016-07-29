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

    /**
     * @inheritdoc
     */
    public function get()
    {
        $sth = $this->db->prepare("SELECT * FROM " . static::tableName() . " WHERE id = :id");
        $sth->execute(array(':id' => $this->id));
        $data = $sth->fetchAll();
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $sth = $this->db->prepare("INSERT INTO " . static::tableName() . "(username, content, post_id) VALUES(:username, :content, :post_id)");
        return $sth->execute(array(
            ':username' => $this->username,
            ':content' => $this->content,
            ':post_id' => $this->post_id
        ));
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        $sth = $this->db->prepare("DELETE FROM  " . static::tableName() . " WHERE id = :id");
        return $sth->execute(array(':id' => $this->id));
    }

    /**
     * @inheritdoc
     */
    public function update()
    {
        $sth = $this->db->prepare("UPDATE " . static::tableName() . " SET username=:username, content=:content, post_id=:post_id WHERE id = :id");
        return $sth->execute(array(
            ':username' => $this->username,
            ':content' => $this->content,
            ':post_id' => $this->post_id,
            ':id' => $this->id
        ));
    }

    /**
     * Get all comments of post
     * @param $post_id
     * @return array
     */
    public static function getCommentByPostId($post_id)
    {
        $db = new Database();
        $sth = $db->prepare("SELECT * FROM " . static::tableName() . " WHERE post_id = :post_id");
        $sth->execute(array(':post_id' => $post_id));
        $data = $sth->fetchAll();
        return $data;
    }

    /**
     * Delete all comment of post
     * @param $post_id
     * @return bool
     */
    public static function deleteCommentByPostId($post_id)
    {
        $db = new Database();
        $sth = $db->prepare("DELETE FROM  " . static::tableName() . " WHERE post_id = :post_id");
        return $sth->execute(array(
            ':post_id' => $post_id
        ));
    }
}