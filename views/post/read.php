<?php if (!empty($this->post)): ?>
    <h3><?php echo $this->post['title']; ?></h3>
    <?php if (Session::get('loggedIn') == true): ?>
        <label><a href="<?php echo URL . 'post/delete/' . $this->post['id']; ?>">[delete]</a></label>
        <label><a href="<?php echo URL . 'post/update/' . $this->post['id']; ?>">[update]</a></label>
    <?php endif ?>
    <p><?php echo $this->post['content']; ?></p>
<?php endif; ?>

    <h3>Comment</h3>
<?php if (!empty($this->comments)): ?>
    <?php foreach ($this->comments as $comment): ?>
        <ul>
            <li><?php echo $comment['username']; ?> : <?php echo $comment['content']; ?></li>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>


<?php if (!empty($this->post)): ?>
    <?php if (!empty($this->errors)): ?>
        <ul class="error">
            <?php foreach ($this->errors as $error): ?>
                <li><?php echo $error;?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <form action="<?php echo URL; ?>post/read/<?php echo $this->post['id'];?>" method="post">
        <?php if (Session::get('loggedIn') == true && !empty($this->user)) { ?>
            <input type="hidden" name="username" value="<?php echo $this->user['username']; ?>">
        <?php } else { ?>
            <label>User name</label><input type="text" name="username"/><br/>
        <?php } ?>
        <label>content</label><textarea cols="30" rows="5" name="content"></textarea><br/>
        <label></label><input type="submit"/>
    </form>
<?php endif; ?>