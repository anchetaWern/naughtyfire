<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Naughtyfire</title>
	<link rel="stylesheet" href="bower_components/picnic/releases/picnic.min.css">
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
		<form action="settings/update" method="POST">		
			<legend>Update Settings</legend>
			<p>		
				<label for="name">Name</label>
				<input type="text" id="name" name="name" value="<?= $name ?>">
			</p>
			<p>
				<label for="name">Email</label>
				<input type="email" id="email" name="email" value="<?= $email ?>">				
			</p>
			<p>		
				<label for="twilio_sid">Twilio SID</label>
				<input type="text" id="twilio_sid" name="twilio_sid" value="<?= $twilio_sid ?>">
			</p>

			<p>		
				<label for="twilio_token">Twilio Token</label>
				<input type="text" id="twilio_token" name="twilio_token" value="<?= $twilio_token ?>">
			</p>

			<p>		
				<label for="twilio_phonenumber">Twilio Phone Number</label>
				<input type="text" id="twilio_phonenumber" name="twilio_phonenumber" value="<?= $twilio_phonenumber ?>">
			</p>

			<p>		
				<label for="mail_host">Mail Host</label>
				<input type="text" id="mail_host" name="mail_host" value="<?= $mail_host ?>">
			</p>


			<p>		
				<label for="mail_port">Mail Port</label>
				<input type="text" id="mail_port" name="mail_port" value="<?= $mail_port ?>">
			</p>

			<p>		
				<label for="mail_username">Mail Username</label>
				<input type="text" id="mail_username" name="mail_username" value="<?= $mail_username ?>">
			</p>

			<p>		
				<label for="mail_password">Mail Password</label>
				<input type="text" id="mail_password" name="mail_password" value="<?= $mail_password ?>">
			</p>


			<p>		
				<label for="subject">Subject</label>
				<input type="text" id="subject" name="subject" value="<?= $subject ?>">
			</p>


			<p>
				<label for="msg_template">Message Template</label>
				<textarea name="msg_template" id="msg_template" cols="30" rows="10" value="<?= $msg_template ?>"><?= $msg_template ?></textarea>
			</p>
			<p>		
				<label for="time_before">Notify Time Before The Actual Date</label>
				<input type="text" id="time_before" name="time_before" value="<?= $time_before ?>">
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