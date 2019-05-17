<?php
	class MdYahoo extends CI_Model{
		function __Construct(){
			parent::__Construct();
		}
		
		function GetAllYahoo(){
			return $this->db->get('yahoo')->result_array();
		}
		
		function Delete_Yahoo(){
			$this->db->where('id', $this->uri->segment(4));
			$this->db->delete('yahoo');
		}
		
		function GetYahoo($id){
			$this->db->where('id', $id);
			$data=$this->db->get('yahoo');
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function Change_yahoo(){
			$id=$this->uri->segment(4);
			$title=strip_tags($this->input->post('title'));
			$yahoo=strip_tags($this->input->post('yahoo'));
			$this->db->where('id', $id);
			$this->db->update('yahoo', array(
				'title'		=>	$title,
				'yahoo'		=>	$yahoo,
			));
		}
		
		function Add_Yahoo(){
			$id=md5(rand().time());
			$title=strip_tags($this->input->post('title'));
			$yahoo=strip_tags($this->input->post('yahoo'));
			$this->db->insert('yahoo', array(
				'id'		=>	$id,
				'title'		=>	$title,
				'yahoo'		=>	$yahoo,
			));
		}
	}
?>