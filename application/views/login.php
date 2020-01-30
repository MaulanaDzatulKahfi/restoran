<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<?php 
		if ($this->session->flashdata());
		{
			echo $this->session->flashdata('message');
		}
	?>
		<form action="<?= base_url('Auth/login') ?>" method="post">
			<input type="text" name="username" placeholder="Masukkan Username"><br>
			<?= form_error('nama') ?>
			<input type="password" name="password" placeholder="Masukkan password Meja"><br>
			<?= form_error('password') ?>
			<button type="submit">Login</button>
		</form>
</body>
</html>
