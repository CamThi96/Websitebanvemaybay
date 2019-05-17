<?php
	class MdContent extends CI_Model{
		function __Construct(){
			parent::__Construct();
			if($_POST){
				$this->db->where('id',$this->uri->segment(2));
				$data=$this->db->get('post');
				$content=$this->input->post('chitiet');
				$contenten=$this->input->post('chitieten');
				if($data->num_rows()!=0){
					$this->db->where('id',$this->uri->segment(2));
					$this->db->update('post',array('contentvi'=>$content, 'contenten'=>$contenten));
				}else{
					$this->db->insert('post',array('id'=>$this->uri->segment(2),'contentvi'=>$content, 'contenten'=>$contenten));
				}
				unset($data);
				header('location:'.base_url().$this->uri->uri_string());
				exit;
			}
		}
		
		function setContent($title){
			$data['module']['title']=$title;
			$this->db->where('id',$this->uri->segment(2));
			$data['content']=$this->db->get('post')->result_array();
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/content', $data));
		}
	}
?>