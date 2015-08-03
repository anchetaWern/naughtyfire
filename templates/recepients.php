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
		<div class="table-container">		
			<legend>Recepients</legend>
			<a href="/recepients/new">New Recepient</a>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($recepients as $recepient){ ?>
					<tr>
						<td><?= $recepient->name ?></td>
						<td><?= $recepient->email ?></td>
						<td><?= $recepient->phone_number ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>