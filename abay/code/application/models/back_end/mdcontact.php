<?php
	class MdContact extends CI_Model{
		function __Construct(){
			parent::__Construct();
			if($this->uri->segment(3)=='xoa'){
				$this->db->where('id',$this->uri->segment(4));
				$this->db->delete('contact');
				header('location:'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2));
				exit;
			}
			$data['contact']=$this->db->get('contact')->result_array();
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/contact',$data));
		}
	}
?>