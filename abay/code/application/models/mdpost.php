<?php
	class MdPost extends CI_Model{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
		}
		
		function GetPostByCode($code){
			$this->db->from('post_config');
			$this->db->where('post_config.code', $code);
			$this->db->join('post_vi', 'post_config.id=post_vi.id');
			$data=$this->db->get();
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function GetPostById($id){
			$this->db->from('post_config');
			$this->db->where('post_config.id', $id);
			$this->db->join('post_vi', 'post_config.id=post_vi.id');
			$this->db->join('post_en', 'post_config.id=post_en.id');
			$data=$this->db->get();
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function Update($id, $code, $title_vi, $title_en){
			$data=$this->GetPostById($id);
			$content_vi=$this->input->post('content_vi');
			$content_en=$this->input->post('content_en');
			$this->load->helper('unicode');
			$date=ngay();
			$time=gio();
			$this->obj->load->model('mdstatistics');
			$log=$this->obj->mdstatistics->get_log();
			if($data==false){
				$this->db->insert('post_config', array(
					'id'		=>	$id,
					'code'		=>	$code,
					'date'		=>	$date,
					'time'		=>	$time,
					'log'		=>	$log,
				));
				$this->db->insert('post_vi', array(
					'id'		=>	$id,
					'title_vi'	=>	$title_vi,
					'content_vi'=>	$content_vi,
				));
				$this->db->insert('post_en', array(
					'id'		=>	$id,
					'title_en'	=>	$title_en,
					'content_en'=>	$content_en,
				));
			}else{
				$this->db->where('id', $id);
				$this->db->update('post_config', array(
					'date'		=>	$date,
					'time'		=>	$time,
					'log'		=>	$log,
				));
				$this->db->where('id', $id);
				$this->db->update('post_vi', array(
					'content_vi'	=>	$content_vi,
				));
				$this->db->update('post_en', array(
					'content_en'	=>	$content_en,
				));
				
			}
		}
	}
?>