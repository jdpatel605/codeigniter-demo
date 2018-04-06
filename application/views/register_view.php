<!DOCTYPE html>
<html>
<title>Register Panel</title>
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
			    <h3 class="form-signin-heading">Welcome Back! Please Sign Up</h3>
				  <hr class="colorgraph"><br>
				  
				  <input type="text" class="form-control mt-5" name="username" placeholder="Username" autofocus="" />
				  <input type="text" class="form-control mt-5" name="email" placeholder="Email" />
				  <input type="text" class="form-control mt-5" name="password" placeholder="Password" />
				  <input type="text" class="form-control mt-5" name="number" placeholder="Number" />
				  <textarea  class="form-control mt-5" name="address" placeholder="Address"></textarea>
				  <input type="password" class="form-control mt-5" name="Password" placeholder="Password" required=""/>     		  
				 
				  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Register</button>  			
			</form>			
		</div>
	</div>
</body>
</html>
