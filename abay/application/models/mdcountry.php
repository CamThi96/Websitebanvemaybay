<?php
	class MdCountry extends CI_Model{
		function __Construct(){
			parent::__Construct();
			$this->load->database();
		}
		
		function _Count_All(){
			return $this->db->get('airport_country')->num_rows();
		}
		
		function _Get_Country_By_Id($id){
			$this->db->where('country_code', $id);
			$data=$this->db->get('airport_country');
			if($data->num_rows()!=0){
				$data=$data->result_array();
				return $data[0];
			}else{
				return false;
			}
		}
		
		function _Add_Country(){
			$this->load->helper('unicode');
			$title=strip_tags($this->input->post('country_title'));
			$id=khongdau($title);
			$bl=$this->_Get_Country_By_Id($id);
			if($bl==false){
				$this->db->insert('airport_country', array(
					'country_code'		=>	$id,
					'country_title'		=>	$title,
				));
			}
		}
		
		function _Search($str, $perpage=200){
			$str=str_replace(' ','%', $str);
			$this->db->where("country_code like '%$str%' or country_title like '%$str%'");
			$this->db->limit($perpage);
			$this->db->order_by('country_title');
			return $this->db->get('airport_country')->result_array();
		}
		
		function _Delete($id){
			$this->db->where('country_code', $id);
			$this->db->delete('airport_country');
		}
		
		function _Update($id, $title){
			$this->db->where('country_code', $id);
			$this->db->update('airport_country', array('country_title'=>$title));
		}
		
		function _Get_Country($perpage, $page){
			$this->db->order_by('country_title');
			$this->db->limit($perpage, $page);
			$this->db->from('airport_Country');
			return $this->db->get()->result_array();
		}
	}
?>