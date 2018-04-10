<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Home_mdl','home_mdl');
    }
	
	public function index()
	{
		$getcategory = $this->home_mdl->getcategory();
		$data['category'] = $getcategory;
		$this->load->view('home_view',$data);
	}

	public function logout()
	{
		$this->session->unset_userdata('userdata');
    	redirect(base_url());
    	exit;
	}

	function product_list()
    {
        $list = $this->home_mdl->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
            $rowData = array();
            $rowData[] = $row->id;
            $rowData[] = $row->product;
            $rowData[] = $row->categoryname;
            $rowData[] = '<img width="100" src="assets/image/'.$row->image.'">';
            $rowData[] = $row->insert_date;
            if($row->status == 1) {
				$rowData[] ='<span class="label label-success">Active</span>';
			} else if($row->status == 0) {
				$rowData[] ='<span class="label label-danger">In Active</span>';
			}  
			$rowData[] = '<buttons onclick="return editProduct(this);"  data-edit=\''.json_encode($row).'\'	 class="btn btn-primary" data-id="'.$row->id.'">Edit <i class="fa fa-pencil"></i></buttons>';
			$data[] = $rowData;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->home_mdl->count_all(),
            "recordsFiltered" => $this->home_mdl->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function manage_product() {
    	if ($_POST != '')
		{
			$mode = $_GET['mode'];		
			if($mode == 'add_product')
			{
				$checkProduct = $this->common_mdl->get_table_by('product',array('name'=>$this->input->post('product'),'category_id'=>$this->input->post('category_id')),'id');
				if($checkProduct) {
					echo json_encode(array(
							'status'=>'error',
							'msg'=>'<strong>ERROR!</strong> Product name is already exist in selected category.'
						));
						exit;
				}

				$imgUpload = $this->common_mdl->singleImageUpload('product_image','jpg',1);

				if($imgUpload['upload'] == True) {

					$insert_data = array('name'=>$_POST['product'],'category_id'=>$_POST['category_id'],'image'=>$imgUpload['data']['file_name'],'insert_date'=>date('Y-m-d h:i:s',strtotime($_POST['date'])),'status'=>$_POST['status']);
					$insertData = $this->common_mdl->insert('product',$insert_data);

					if($insertData) {
						echo json_encode(array(
							'status'=>'success',
							'msg'=>'<strong>SUCCESS!</strong> Product added successfully.'
						));
						exit;
					} else {
						echo json_encode(array(
							'status'=>'error',
							'msg'=>'<strong>ERROR!</strong> Please try again after sometime.'
						));
						exit;
					}
				} else {
					echo json_encode(array(
						'status'=>'error',
						'msg'=>'<strong>ERROR!</strong> There was problem in image uploading.'
					));
					exit;
				}
			} else if($mode == 'edit_product') {
				$checkProduct = $this->common_mdl->get_table_by('product',array('name'=>$this->input->post('edit_product'),'category_id'=>$this->input->post('edit_category_id'),'id!='=>$this->input->post('edit_id')),'id');
				if($checkProduct) {
					echo json_encode(array(
							'status'=>'error',
							'msg'=>'<strong>ERROR!</strong> Product name is already exist in selected category.'
						));
						exit;
				}
				$editImage = $this->input->post('old_image');
				if(!empty($_FILES['product_image'])) {
					$imgUpload = $this->common_mdl->singleImageUpload('product_image','jpg',1);
					if($imgUpload['upload'] == True) {
						$editImage = $imgUpload['data']['file_name'];
					} else {
						echo json_encode(array(
							'status'=>'error',
							'msg'=>'<strong>ERROR!</strong> There was problem in image uploading.'
						));
						exit;
					}
				} 

				$update_data = array('name'=>$_POST['edit_product'],'category_id'=>$_POST['edit_category_id'],'image'=>$editImage,'insert_date'=>date('Y-m-d h:i:s',strtotime($_POST['edit_date'])),'status'=>$_POST['edit_status']);
				$updateData = $this->common_mdl->update('product',$update_data,array('id'=>$_POST['edit_id']));

				if($updateData) {
					echo json_encode(array(
						'status'=>'success',
						'msg'=>'<strong>SUCCESS!</strong> Product updated successfully.'
					));
					exit;
				} else {
					echo json_encode(array(
						'status'=>'error',
						'msg'=>'<strong>ERROR!</strong> Please try again after sometime.'
					));
					exit;
				}
				
			}
				
			
		}
		else
		{
			echo json_encode(array(
				'status'=>'redirect',
				'msg'=>'redirect'
			));
			exit;
		}
    }
}
