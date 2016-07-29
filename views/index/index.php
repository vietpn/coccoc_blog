<?php foreach ($this->posts as $post): ?>
    <div class="row">
        <h2>
            <a href="<?php echo URL; ?>post/read/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
        </h2>

        <p><?php echo $post['date_created']; ?></p>

        <p><?php echo $post['content'] ?></p>
    </div>
<?php endforeach ?>
