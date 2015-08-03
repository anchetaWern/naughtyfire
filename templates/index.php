<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Naughtyfire</title>
	<link rel="stylesheet" href="bower_components/picnic/releases/picnic.min.css">
	<link rel="stylesheet" href="bower_components/pikaday/css/pikaday.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container">
		<header>		
			<img src="img/naughtyfire.png" id="logo" alt="logo">
			<h1>Naughtyfire</h1>
		</header>
		<div id="message" class="<?= $flash['message']['type'] ?>">
			<?= $flash['message']['text'] ?>
		</div>
		<form action="holiday/create" method="POST">	
			<legend>New Event</legend>	
			<p>		
				<label for="title">Title</label>
				<input type="text" id="title" name="title">
			</p>
			<p>
				<label for="date">Date</label>
				<input type="text" id="date" name="date">
			</p>
			<p>
				<label>
				  <input type="checkbox" name="is_enabled" checked>
				  <span class="checkable">Enabled</span>
				</label>
			</p>
			<p>
				<label>
				  <input type="checkbox" name="is_recurring" checked>
				  <span class="checkable">Recurring</span>
				</label>
			</p>
			<p>
				<button type="submit">Save</button>
			</p>
		</form>
	</div>
	<script src="bower_components/pikaday/pikaday.js"></script>
	<script src="js/main.js"></script>
</body>
</html>