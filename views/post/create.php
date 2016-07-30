<h1>Create post</h1>

<form action="<?php echo URL;?>post/create" method="post">

    <label>Title</label><input type="text" name="title" /><br />
    <?php if (!empty($this->errors['title'])): ?>
        <label class="error"><?php echo $this->errors['title'];?></label>
    <?php endif ?>
    <label>Content</label><textarea name="content" cols="30" rows="5"></textarea><br />
    <?php if (!empty($this->errors['content'])): ?>
        <label class="error"><?php echo $this->errors['content'];?></label>
    <?php endif ?>
    <label></label><input type="submit" />
</form>