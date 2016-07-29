<!doctype html>
<html>
<head>
    <title>Cococ Blog</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css"/>
</head>
<body>

<?php Session::init(); ?>


<div id="header">
    <a href="<?php echo URL; ?>index">Home</a>
    <?php if (Session::get('loggedIn') == true): ?>
        <a href="<?php echo URL; ?>post/create">Create post</a>
        <a href="<?php echo URL; ?>index/logout">Logout</a>
    <?php else: ?>
        <a href="<?php echo URL; ?>login">Login</a>
        <a href="<?php echo URL; ?>signup">Sign up</a>
    <?php endif; ?>
</div>

<div id="content">

	
	