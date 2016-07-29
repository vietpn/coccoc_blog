<?php if (!empty($this->post)): ?>
    <h1>Update post</h1>
    <?php if (!empty($this->errors)): ?>
        <ul class="error">
            <?php foreach ($this->errors as $error): ?>
                <li><?php echo $error;?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <form action="<?php echo URL; ?>post/update/<?php echo $this->post['id'];?>" method="post">

        <label>Title</label><input type="text" name="title" value="<?php echo $this->post['title']?>"/><br/>
        <label>Content</label><textarea name="content" cols="30" rows="5"><?php echo $this->post['content']?></textarea><br/>
        <label></label><input type="submit"/>
    </form>
<?php endif; ?>