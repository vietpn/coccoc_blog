<h1>Sign up</h1>

<form action="<?php echo URL; ?>signup" method="post">

    <label>User name</label><input type="text" name="username"/><br/>
    <?php if (!empty($this->errors['username'])): ?>
        <label class="error"><?php echo $this->errors['username'];?></label>
    <?php endif ?>

    <label>Password</label><input type="password" name="password"/><br/>
    <?php if (!empty($this->errors['password'])): ?>
        <label class="error"><?php echo $this->errors['password'];?></label>
    <?php endif ?>

    <label>Confirm Password</label><input type="password" name="confirm_password"/><br/>
    <?php if (!empty($this->errors['confirm_password'])): ?>
        <label class="error"><?php echo $this->errors['confirm_password'];?></label>
    <?php endif ?>

    <label></label><input type="submit"/>
</form>