<h1>Login</h1>

<form action="<?php echo URL; ?>login" method="post">

    <label>User name</label>
    <input type="text" name="username" value="<?php echo $this->loginForm->username ?>"/><br/>
    <?php if (!empty($this->errors['username'])): ?>
        <label class="error"><?php echo $this->errors['username']; ?></label>
    <?php endif ?>

    <label>Password</label>
    <input type="password" name="password" value="<?php echo $this->loginForm->password ?>"/><br/>
    <?php if (!empty($this->errors['password'])): ?>
        <label class="error"><?php echo $this->errors['password']; ?></label>
    <?php endif ?>
    <label></label><input type="submit"/>
</form>