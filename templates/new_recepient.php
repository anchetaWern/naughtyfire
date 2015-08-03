<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Naughtyfire</title>
	<link rel="stylesheet" href="/bower_components/picnic/releases/picnic.min.css">
	<link rel="stylesheet" href="/bower_components/pikaday/css/pikaday.css">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body>
	<div class="container">
		<header>		
			<img src="/img/naughtyfire.png" id="logo" alt="logo">
			<h1>Naughtyfire</h1>
		</header>
		<div id="message" class="<?= $flash['message']['type'] ?>">
			<?= $flash['message']['text'] ?>
		</div>
		<form action="/recepients/create" method="POST">	
			<legend>New Recepient</legend>	
			<p>		
				<label for="name">Name</label>
				<input type="text" id="name" name="name">
			</p>
			<p>
				<label for="email">Email</label>
				<input type="text" id="email" name="email">
			</p>
			<p>
				<label for="phone_number">Phone Number</label>
				<input type="text" id="phone_number" name="phone_number">
			</p>
			<p>
				<button type="submit">Save</button>
			</p>
		</form>
	</div>
</body>
</html>