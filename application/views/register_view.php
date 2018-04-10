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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<!-- Script -->
</head>
<body>
	<div class = "container">
		<div class="wrapper">
			<form action="register/adduser" method="post" name="Login_Form" id="registeruser" onsubmit="return false;" class="form-signin">       
			    <h3 class="form-signin-heading">Welcome Back! Please Sign Up</h3>
				  <hr class="colorgraph"><br>
				  
				  <input type="text" class="form-control mt-5" name="username" placeholder="Username" autofocus="" />
				  <input type="text" class="form-control mt-5" name="email" placeholder="Email" />
				  <input type="password" class="form-control mt-5" id="password" name="password" placeholder="Password" />
				  <input type="password" class="form-control mt-5" name="repassword" placeholder="Confirm Password" >     		  
				  <input type="text" class="form-control mt-5" name="mobileno" placeholder="Mobile No" />
				  <input type="file" class="form-control mt-5" id="image" name="image" src="" >
				  <textarea  class="form-control mt-5" name="address" placeholder="Address"></textarea>
				 
				  <button class="btn btn-lg btn-primary btn-block btn_registration" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Please wait..." name="Submit" value="Login" type="Submit">Register</button>  		
				  <div class="registration_message alert mt20 mb0" role="alert" style="display: none;"></div>	
			</form>			
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#registeruser').validate({ 
		rules :{
			username        : "required",
			mobileno        : {required: true, number: true },
			image           : {required: true, accept: "image/jpg,image/jpeg,image/png,image/gif" },
			email           : {required: true, email: true },
			password        : {required: true, minlength: 8 },
			repassword      : {required: true, minlength: 8, equalTo: "#password"},
			address         : "required",
		},
		messages :{
			username        : "Username field is required",
			mobileno        : {required: "Number field is required", number: "Please enter number only" },
			image           : {required: "Image field is required", accept: "Please upload only image" },
			email           : {required: "Email field is required", email: "Please Enter valid email" },
			password        : {required: "Password field is required", minlength: "Password must be 8 characters" },
			repassword      : {required: "Confirm password field is required", minlength: "Password must be 8 characters", equalTo: "Confirm password doesn't match"},
			address        : "Address field is required",
		},
		submitHandler: function(form) {
			$('.btn_registration').button('loading'); 
			$('.registration_message').removeClass('alert-danger, alert-success');
			var frmData = new FormData();
	    	jQuery.each(jQuery('#image')[0].files, function(i, file) {
			    frmData.append('user_image', file);
			});
			jQuery('#registeruser input').each(function(i, inpu) {
				frmData.append(inpu.name,inpu.value);
			});
			jQuery('#registeruser textarea').each(function(i, inpu) {
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
					$('.btn_registration').button('reset');
					if(data.status=='success'){
						$('.registration_message').addClass('alert-success').html(data.msg).show();
						$('#registeruser')[0].reset();
						setTimeout(function()
						{
							window.location.href = "<?=base_url()?>login";
						}, 2000);
					}
					else{
						$('.registration_message').addClass('alert-danger').html(data.msg).show();
					}
		        }
		    });
			
		}
	});
</script>
