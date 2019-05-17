<?php
	class MdProductType extends CI_Model{
		function __Construct(){
			parent::__Construct();
		}
		
		function GetAllProductType(){
			$this->db->order_by('order asc');
			return $this->db->get('producttype')->result_array();
		}
		
		function GetProductTypeById($id){
			$this->db->where('id', $id);
			$data=$this->db->get('producttype');
			if($data->num_rows()!=0){
				$data=$data->result_array();
				return $data[0];
			}else{
				return false;
			}
		}
		
		function Delete($id){
			$this->db->where('id', $id);
			$this->db->delete('producttype');
		}
		
		function ChangeProductType(){
			$this->load->helper('unicode');
			$titlevi=strip_tags($this->input->post('titlevi'));
			$titleen=strip_tags($this->input->post('titleen'));
			$contentvi=$this->input->post('contentvi');
			$contenten=$this->input->post('contenten');
			$id=khongdau($titlevi);
			$order=intval(strip_tags($this->input->post('order')));
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('producttype', array(
				'id'		=>	$id,
				'titlevi'	=>	$titlevi,
				'titleen'	=>	$titleen,
				'contentvi'	=>	$contentvi,
				'contenten'	=>	$contenten,
				'order'		=>	$order,
			));
		}
		
		function AddProductType(){
			$this->load->helper('unicode');
			$titlevi=strip_tags($this->input->post('titlevi'));
			$titleen=strip_tags($this->input->post('titleen'));
			$contentvi=$this->input->post('contentvi');
			$contenten=$this->input->post('contenten');
			$id=khongdau($titlevi);
			$order=intval(strip_tags($this->input->post('order')));
			$this->db->insert('producttype', array(
				'id'		=>	$id,
				'titlevi'	=>	$titlevi,
				'titleen'	=>	$titleen,
				'contentvi'	=>	$contentvi,
				'contenten'	=>	$contenten,
				'order'		=>	$order,
			));
		}
	}
?>