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
    public function validate()
    {
        if (empty($this->post_id)) {
            $this->errors['post_id'] = 'Post id is required';
        }

        if (empty($this->username)) {
            $this->errors['username'] = 'Name is required';
        }

        if (empty($this->content)) {
            $this->errors['content'] = 'Comment is required';
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
                    return CommentModel::insert(
                        array(
                            'post_id' => $this->post_id,
                            'username' => $this->username,
                            'content' => $this->content
                        )
                    );
                } else {
                    return CommentModel::update(
                        array(
                            'post_id' => $this->post_id,
                            'username' => $this->username,
                            'content' => $this->content
                        ),
                        $condition
                    );
                }
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }
}