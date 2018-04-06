<!DOCTYPE html>
<html>
<title>Login Panel</title>
<head>
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>">
	<!-- CSS -->
	<!-- Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Script -->
</head>
<body>
	<div class = "container">
		<div class="wrapper">
			<form action="" method="post" name="Login_Form" class="form-signin">       
			    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
				  <hr class="colorgraph"><br>
				  
				  <input type="text" class="form-control" name="Username" placeholder="Username & Email" required="" autofocus="" />
				  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
				 
				  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
				  <p class="text-center mt-20"><a href="<?=base_url('register')?>">Click here to new register</a></p>
			</form>			
		</div>
	</div>
</body>
</html>
