<h1>Create post</h1>
<?php if (!empty($this->errors)): ?>
    <ul class="error">
        <?php foreach ($this->errors as $error): ?>
            <li><?php echo $error;?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
<form action="<?php echo URL;?>post/create" method="post">

    <label>Title</label><input type="text" name="title" /><br />
    <label>Content</label><textarea name="content" cols="30" rows="5"></textarea><br />
    <label></label><input type="submit" />
</form>