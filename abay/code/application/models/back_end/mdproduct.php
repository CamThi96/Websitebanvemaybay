<?php
	class MdProduct extends CI_Model{
		function __Construct(){
			parent::__Construct();
		}
		
		function GetProduct($page, $perpage){
			return $this->db->get('product', $perpage, $page)->result_array();
		}
		
		function GetProductById($id){
			$this->db->where('id', $id);
			$data=$this->db->get('product')->result_array();
			return $data[0];
		}
		
		function Delete($id){
			$data=$this->GetProductById($id);
			unlink('public/uploads/products/'.$data['image']);
			$this->db->where('id', $id);
			$this->db->delete('product');
		}
		
		function CountAll(){
			return $this->db->get('product')->num_rows();
		}
		
		function Change($idchange){
			$titlevi=strip_tags($this->input->post('titlevi'));
			$titleen=strip_tags($this->input->post('titleen'));
			$producttype=strip_tags($this->input->post('producttype'));
			$contentvi=$this->input->post('contentvi');
			$contenten=$this->input->post('contenten');
			$this->load->helper('unicode');
			$id=khongdau($titlevi);
			$this->load->model('mdslideshow');
			$date=ngay();
			$time=gio();
			$image=$_FILES['user_file']['name'];
			$this->db->where('id', $idchange);
			if($image!=''){
				$data=$this->GetProductById($idchange);
				unlink('public/uploads/producs/'.$data['image']);
				$image=$this->DoUpload();
				$this->db->update('product', array(
					'id'		=>	$id,
					'titlevi'	=>	$titlevi,
					'titleen'	=>	$titleen,
					'contentvi'	=>	$contentvi,
					'contenten'	=>	$contenten,
					'dateupdate'=>	$date,
					'timeupdate'=>	$time,
					'image'		=>	$image,
					'producttype'=>	$producttype,
				));
			}else{
				$this->db->update('product', array(
					'id'		=>	$id,
					'titlevi'	=>	$titlevi,
					'titleen'	=>	$titleen,
					'contentvi'	=>	$contentvi,
					'contenten'	=>	$contenten,
					'dateupdate'=>	$date,
					'timeupdate'=>	$time,
					'producttype'=>	$producttype,
				));
			}
		}
		
		function add(){
			$titlevi=strip_tags($this->input->post('titlevi'));
			$titleen=strip_tags($this->input->post('titleen'));
			$producttype=strip_tags($this->input->post('producttype'));
			$contentvi=$this->input->post('contentvi');
			$contenten=$this->input->post('contenten');
			$this->load->helper('unicode');
			$id=khongdau($titlevi);
			$this->load->model('mdslideshow');
			$image=$this->DoUpload();
			$date=ngay();
			$time=gio();
			$this->db->insert('product', array(
				'id'		=>	$id,
				'titlevi'	=>	$titlevi,
				'titleen'	=>	$titleen,
				'contentvi'	=>	$contentvi,
				'contenten'	=>	$contenten,
				'date'		=>	$date,
				'time'		=>	$time,
				'image'		=>	$image,
				'producttype'	=>	$producttype,
			));
		}
		
		function DoUpload(){
			$config['upload_path'] 		= 	'public/uploads/products/';
			$config['allowed_types'] 	= 	'gif|jpg|png';
			$config['max_size']			= 	8*1024;
			$config['max_width']  		= 	200*10;
			$config['max_height']  		= 	200*10;
			$config['max_filename']		=	250;
			$config['encrypt_name']		=	true;
			$this->load->library('upload', $config);
			$this->upload->do_upload('user_file');
			$data=$this->upload->data();
			unset($config);
			$config['image_library'] 	= 'gd2';
			$config['source_image']		= $data['full_path'];
			$config['new_image'] 		= $data['full_path'];
			$config['maintain_ratio'] 	= TRUE;
			$config['width']			= 200;
			$config['height']			= 200;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			return $data['file_name'];
		}
	}
?>