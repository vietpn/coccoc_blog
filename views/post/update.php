<?php if (!empty($this->post)): ?>
    <h1>Update post</h1>
    <form action="<?php echo URL; ?>post/update/<?php echo $this->post['id'];?>" method="post">

        <label>Title</label><input type="text" name="title" value="<?php echo $this->post['title']?>"/><br/>
        <?php if (!empty($this->errors['title'])): ?>
            <label class="error"><?php echo $this->errors['title'];?></label>
        <?php endif ?>

        <label>Content</label><textarea name="content" cols="30" rows="5"><?php echo $this->post['content']?></textarea><br/>
        <?php if (!empty($this->errors['content'])): ?>
            <label class="error"><?php echo $this->errors['content'];?></label>
        <?php endif ?>

        <label></label><input type="submit"/>
    </form>
<?php endif; ?>