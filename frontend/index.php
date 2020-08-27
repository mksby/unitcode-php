<!DOCTYPE html>
<html>
	<head>
		<style>
			form {
				background: #fff;
				padding: 15px;
				border: 1px solid;
			}
		</style>
	</head>
	<body>
		<header id="header"></header>

		<br>
		<br>

		<form action="">
			<div>
				<div>Avatar</div>
				<div><img hidden width="120" src="/" alt="" /></div>
			</div>
			<fieldset>
				<label for="avatar">Change Avatar</label>
				<input type="file" id="avatar" name="avatar" />
			</fieldset>
			<fieldset>
				<label for="first_name">First Name</label>
				<input type="text" id="first_name" name="first_name" />
			</fieldset>
			<fieldset>
				<label for="middle_name">Middle Name</label>
				<input type="text" id="middle_name" name="middle_name" />
			</fieldset>
			<fieldset>
				<label for="last_name">Last Name</label>
				<input type="text" id="last_name" name="last_name" />
			</fieldset>
		</form>

		<h3>Managers</h3>

		<div><button id="addManager">add manager</button></div>

		<ul id="managers"></ul>

		<script src="https://unpkg.com/rxjs/bundles/rxjs.umd.min.js"></script>
		<script
			src="https://code.jquery.com/jquery-3.5.1.min.js"
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			crossorigin="anonymous"></script>
		<script src="main.js"></script>
	</body>
</html>