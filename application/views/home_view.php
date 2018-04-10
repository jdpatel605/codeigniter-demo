<!DOCTYPE html>
<html>
<title>Home</title>
<head>
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>">
	<!-- CSS -->
	<!-- Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<!-- Script -->
</head>
<body>

<div class="content-wrapper container">
	<section class="content-header">
		<h1 class="pull-left"> Product List</h1> 
		<div class="text-right mt-5">
			<?php if(!empty($this->session->userdata['userdata'])) { ?>
			<h4><?=$this->session->userdata['userdata']['username']?></h4>
        	<a href="<?=base_url('home/logout')?>" class="btn btn-primary btn_profile">Logout</a>
			<?php } else { ?>
        	<a href="<?=base_url('login')?>" class="btn btn-primary btn_profile">Login</a>
        	<a href="<?=base_url('register')?>" class="btn btn-danger btn_profile">Register</a>
			<?php } ?>
        </div>

	</section>

  	<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">title</h3>
          </div>
          <div class="box-body filter-body">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 pl-0">
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" id="category">
                  	<option value="">Select Category</option>
                	<?php foreach ($category as $key => $data) { ?>
                  	<option value="<?=$data['id']?>"><?=$data['name']?></option>
                	<?php } ?>
                </select>
              </div>
            </div>
            <div class="text-right">
            	<a href="javascript:void(0);" data-toggle="modal" data-target="#addProduct" class="btn btn-primary btn_profile">Add Product</a>
            </div>
          </div>
          <div class="box-body">
            <table id="product_list" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Status</th>
				  <th>Action</th>

                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->
<!-- DataTables -->
<div class="modal" id="addProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="home/manage_product?mode=add_product" id="form_add_product" method="post" accept-charset="utf-8" novalidate="novalidate" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add Product</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="product">Product</label>
								<input type="text" id="product" required="" class="form-control" name="product" placeholder="Enter product" >
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="category_id">Category</label>
								<select class="form-control" name="category_id" id="category_id">
				                  	<option value="">Select Category</option>
				                	<?php foreach ($category as $key => $data) { ?>
				                  	<option value="<?=$data['id']?>"><?=$data['name']?></option>
				                	<?php } ?>
				                </select>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="image">Image</label>
								<input type="file" class="form-control mt-5" id="image" name="image" src="" >
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="createddate">Created Date</label>
								<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
								<!-- <textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="5"></textarea> -->
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="status">Status</label> <br>
								<input type="radio" name="status" id="status_active" value="1" checked=""/> <label for="status_active">Active</label>&nbsp;&nbsp;
								<input type="radio" name="status" id="status_inactive" value="0"/> <label for="status_inactive">Inactive</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn_add_product" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait...">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<div class="alert msg_add_product text-center" role="alert" style="display: none;"></div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="home/manage_product?mode=edit_product" id="form_edit_product" method="post" accept-charset="utf-8" novalidate="novalidate" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Product</h4>
					<input type="hidden" name="edit_id" id="edit_id" value="0">
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="edit_product">Product</label>
								<input type="text" id="edit_product" required="" class="form-control" name="edit_product" placeholder="Enter product" >
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="edit_category_id">Category</label>
								<select class="form-control" name="edit_category_id" id="edit_category_id">
				                  	<option value="">Select Category</option>
				                	<?php foreach ($category as $key => $data) { ?>
				                  	<option value="<?=$data['id']?>"><?=$data['name']?></option>
				                	<?php } ?>
				                </select>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="edit_image">Image</label>
								<!-- <img src="" id="prd_img"> -->
								<input type="hidden" name="old_image" id="old_image">
								<input type="file" value="abc" class="form-control mt-5" id="edit_image" name="edit_image" src="" >
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="edit_createddate">Created Date</label>
								<input class="form-control" id="edit_date" name="edit_date" placeholder="MM/DD/YYY" type="text"/>
								<!-- <textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="5"></textarea> -->
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label for="status">Status</label> <br>
								<input type="radio" name="edit_status" id="edit_status_active" value="1" checked=""/> <label for="status_active">Active</label>&nbsp;&nbsp;
								<input type="radio" name="edit_status" id="edit_status_inactive" value="0"/> <label for="status_inactive">Inactive</label>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn_edit_product" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait...">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<div class="alert msg_edit_product text-center" role="alert" style="display: none;"></div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<input type="hidden" name="is_image" id="is_image" value="0"/>
	
</body>
</html>

<script type="text/javascript">
	function editProduct(e){
		var row_data = $(e).data('edit');
		console.log(row_data);
		$("#edit_id").val(row_data.id);
		$("#edit_product").val(row_data.product);
		$("#edit_date").val(row_data.insert_date);
		$("#old_image").val(row_data.image);
		// $("#prd_img").attr("src","<?=base_url()?>assets/image/"+row_data.image);
 		$('#edit_category_id option:contains("' + row_data.categoryname + '")').attr("selected",true);
		$('input[name="status"][value="'+row_data.status+'"]').click();
		$('#editProduct').modal('show');
	}

	$( document ).ready(function() {
	  var table = $('#product_list').DataTable({
	    // "dom": '<fl<t>ip>',
	    "processing": true, 
	    "serverSide": true, 
	    "ajax": {
	      "url": "<?=base_url()?>home/product_list",
	      "type": "POST",
	      "data": function ( data ) {
	        data.category = $('#category').val();
	      },
	    },
	    "autoWidth": false
	    // "order": [[ 0, "asc" ]],  
	    // "columnDefs": [ { orderable: false, targets: [1,3,4,5,6,7] } ],
	  });

	$(document).on('change','#category',function(){
	    table.ajax.reload();
	});
		var date_input=$('input[name="date"]'); //our date input has the name "date"
	    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	    var options={
	        format: 'mm/dd/yyyy',
	        container: container,
	        todayHighlight: true,
	        autoclose: true,
	    };
	    date_input.datepicker(options);

	    var date_input_edit=$('input[name="edit_date"]'); //our date input has the name "date"
	    var container_edit=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	    var options_edit={
	        format: 'mm/dd/yyyy',
	        container: container_edit,
	        todayHighlight: true,
	        autoclose: true,
	    };
	    date_input_edit.datepicker(options_edit);

	    $("#form_add_product").validate({
			ignore: [],
			rules: {
				product    : "required",
				category_id    : "required",
				image    : {required: true, accept: "image/jpg,image/jpeg,image/png,image/gif" },
				date    : "required",
				status    : "required",
			},
			messages: {
				product    : "Product name is required",
				category_id    : "Category is required",
				image    : {required: "Image is required", accept: "Please upload only image" },
				date    : "Created date is required",
				status    : "Status is required",
			},
			submitHandler: function(form) {
				$('.btn_add_product').button('loading'); 
				$('.msg_add_product').removeClass('alert-danger, alert-success');
				var frmData = new FormData();
		    	jQuery.each(jQuery('#image')[0].files, function(i, file) {
				    frmData.append('product_image', file);
				});
				jQuery('#form_add_product input[type=text]').each(function(i, inpu) {
					frmData.append(inpu.name,inpu.value);
				});
				jQuery('#form_add_product input[name=status]:checked').each(function(i, inpu) {
					frmData.append(inpu.name,inpu.value);
				});
				jQuery('#form_add_product select').each(function(i, inpu) {
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
						$('.btn_add_product').button('reset');
						if(data.status=='success'){
							$('.msg_add_product').addClass('alert-success').html(data.msg).show();
							$('#form_add_product')[0].reset();
							setTimeout(function()
							{
								$('.msg_add_product').hide();
								location.reload();
							}, 2000);
						}
						else{
							$('.msg_add_product').addClass('alert-danger').html(data.msg).show();
						}
			        }
			    });
				
			},
		});

		$("#form_edit_product").validate({
			ignore: [],
			rules: {
				product    : "required",
				category_id    : "required",
				// image    : {required: true, accept: "image/jpg,image/jpeg,image/png,image/gif" },
				date    : "required",
				edit_status    : "required",
			},
			messages: {
				product    : "Product name is required",
				category_id    : "Category is required",
				// image    : {required: "Image is required", accept: "Please upload only image" },
				date    : "Created date is required",
				edit_status    : "Status is required",
			},
			submitHandler: function(form) {
				$('.btn_edit_product').button('loading'); 
				$('.msg_edit_product').removeClass('alert-danger, alert-success');
				var frmData = new FormData();
		    	jQuery.each(jQuery('#edit_image')[0].files, function(i, file) {
				    frmData.append('product_image', file);
				});
				jQuery('#form_edit_product input[type=text]').each(function(i, inpu) {
					frmData.append(inpu.name,inpu.value);
				});
				jQuery('#form_edit_product input[type=hidden]').each(function(i, inpu) {
					frmData.append(inpu.name,inpu.value);
				});
				jQuery('#form_edit_product input[name=edit_status]:checked').each(function(i, inpu) {
					frmData.append(inpu.name,inpu.value);
				});
				jQuery('#form_edit_product select').each(function(i, inpu) {
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
						$('.btn_edit_product').button('reset');
						if(data.status=='success'){
							$('.msg_edit_product').addClass('alert-success').html(data.msg).show();
							$('#form_edit_product')[0].reset();
							setTimeout(function()
							{
								$('.msg_edit_product').hide();
								location.reload();
							}, 2000);
						}
						else{
							$('.msg_edit_product').addClass('alert-danger').html(data.msg).show();
						}
			        }
			    });
				
			},
		});

		

	});	

</script>
