<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Login</h2>

<form id="loginForm">
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>
  <button type="submit">Login</button>
</form>

<div id="message"></div>

<script src="{{URL::to('controllers/authCheck.js')}}"></script>
<script src="{{URL::to('controllers/loginController.js')}}"></script>
</body>
</html>
