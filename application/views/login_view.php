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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<!-- Script -->
</head>
<body>
	<div class = "container">
		<div class="wrapper">
			<form action="login/do_login" method="post" name="Login_Form" id="loginuser" class="form-signin">       
			    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
				  <hr class="colorgraph"><br>
				  
				  <input type="text" class="form-control mt-5" name="username" placeholder="Username & Email" required="" autofocus="" />
				  <input type="password" class="form-control mt-5" name="password" placeholder="Password" required=""/>     		  
				 
				  <button class="btn btn-lg btn-primary btn-block mt-5 btn_login" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Please wait..." name="Submit" value="Login" type="Submit">Login</button>  			
				  <p class="text-center mt-20"><a href="<?=base_url('register')?>">Click here to new register</a></p>
				  <div class="login_message alert mt20 mb0" role="alert" style="display: none;"></div>	
			</form>			
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#loginuser').validate({ 
		rules :{
			username        : "required",
			password        : {required: true, minlength: 8 },
		},
		messages :{
			username        : "Username field is required",
			password        : {required: "Password field is required", minlength: "Password must be 8 characters" },
		},
		submitHandler: function(form) {
			$('.btn_login').button('loading'); 
			$('.login_message').removeClass('alert-danger, alert-success');
			var frmData = new FormData();
	    	
			jQuery('#loginuser input').each(function(i, inpu) {
				frmData.append(inpu.name,inpu.value);
			});
	    	console.log(frmData);
	    	$.ajax({
		        url: form.action,
				type: 'POST',
		        data: frmData,
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function (res) {
		        	var data = jQuery.parseJSON(res);
					$('.btn_login').button('reset');
					if(data.status=='success'){
						$('.login_message').addClass('alert-success').html(data.msg).show();
						$('#loginuser')[0].reset();
						setTimeout(function()
						{
							window.location.href = "<?=base_url()?>";
						}, 2000);
					}
					else{
						$('.login_message').addClass('alert-danger').html(data.msg).show();
					}
		        }
		    });
			
		}
	});
</script>
