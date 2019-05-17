<?php
	class MdBanner extends CI_Model{
		function __Construct(){
			parent::__Construct();
		}
		
		function GetBanner(){
			$this->db->where('id', 'banner');
			$data=$this->db->get('post_config');
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function update(){
			$data=$this->GetBanner();
			$this->load->library('my_img');
			if($data!=false){
				unlink('public/uploads/images/'.$data['code']);
				$data=$this->my_img->upload();
				$image=$data['upload_data']['file_name'];
				$this->my_img->doresize(942, 0,$data['upload_data']['full_path'], $data['upload_data']['full_path']);
				$this->db->where('id', 'banner');
				$this->db->update('post_config',array(
					'code'	=>	$image,
				));
			}else{
				$data=$this->my_img->upload();
				$image=$data['upload_data']['file_name'];
				$this->my_img->doresize(942, 0,$data['upload_data']['full_path'], $data['upload_data']['full_path']);
				$this->db->insert('post_config', array(
					'id'	=>	'banner',
					'code'	=>	$image,
				));
				$this->db->insert('post_vi', array(
					'id'	=>	'banner',
				));
			}
		}
	}
?>