<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>

<?php
if (!isset($_COOKIE['user'])) {
	?>
  <form method="post">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="buttons">
		<a href="index.php" class="cancel">Cancel</a>
  		<input type="submit" class="btn" name="login_user" value="Login">
  	</div>
  </form>
	<?php
} else {
	?>
	<form method="POST" class="center" action="login.php">
		<input type="submit" class="btn" name="logout_user" value="Logout">
	</form>
	<?php
}
?>
</body>
</html>