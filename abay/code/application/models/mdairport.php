<?php
	class MdAirport extends CI_Model{
		function __Contruct(){
			parent::__Construct();
			$this->load->database();
		}
		
		function _Get_All($perpage, $page){
			$this->db->order_by('airport_name');
			$this->db->limit($perpage, $page);
			return $this->db->get('airport_code')->result_array();
		}
		
		function _Add_Airport(){
			if($this->_Get_Airport_By_Id(strtoupper(strip_tags($this->input->post('airport_code'))))==false){
				$this->db->insert('airport_code', array(
					'airport_code'		=>	strtoupper(strip_tags($this->input->post('airport_code'))),
					'airport_name'		=>	strip_tags($this->input->post('airport_title')),
					'country_code'		=>	strip_tags($this->input->post('country_name')),
				));
			}
		}
		
		function _Count_All(){
			return $this->db->get('airport_code')->num_rows();
		}
		
		function _Update_name($id, $name){
			$this->db->where('airport_code', $id);
			$this->db->update('airport_code', array('airport_name'=>$name));
		}
		
		function _update($id, $id_update, $name, $country){
			$this->db->where('airport_code', $id);
			$this->db->update('airport_code', array(
				'airport_name'	=>	$name,
				'airport_code'	=>	$id_update,
				'country_code'	=>	$country,
			));
			
		}
		
		function _Delete($id){
			$this->db->where('airport_code', $id);
			$this->db->delete('airport_code');
		}
		
		function _search($str, $perpage=200){
			$str=str_replace(' ','%', $str);
			$this->db->where("airport_name like '%$str%' or airport_code like '%$str%'");
			$this->db->limit($perpage);
			$this->db->order_by('airport_name');
			return $this->db->get('airport_code')->result_array();
		}
		
		function _Get_Airport_By_Id($id){
			$this->db->where('airport_code', $id);
			$data=$this->db->get('airport_code');
			if($data->num_rows()!=0)
			{
				$data=$data->result_array();
				return $data[0];
			}
			else
			{
				return false;
			}
		}
		
		function _Get_Airport_Full_By_Id($id){
			$this->db->where('airport_code', $id);
			$this->db->join('airport_country', 'airport_code.country_code=airport_country.country_code');
			$this->db->from('airport_code');
			$data=$this->db->get();
			if($data->num_rows()!=0)
			{
				$data=$data->result_array();
				return $data[0];
			}
			else
			{
				return false;
			}
		}
	}
?>