<h1>Sign up</h1>
<?php if (!empty($this->errors)): ?>
    <ul class="error">
        <?php foreach ($this->errors as $error): ?>
            <li><?php echo $error;?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
<form action="<?php echo URL; ?>signup" method="post">

    <label>User name</label><input type="text" name="username"/><br/>
    <label>Password</label><input type="password" name="password"/><br/>
    <label>Confirm Password</label><input type="password" name="confirm_password"/><br/>
    <label></label><input type="submit"/>
</form>