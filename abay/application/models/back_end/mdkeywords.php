<?php
	class MdKeywords extends CI_Model{
		function __Construct(){
			$obj=&get_instance();
			parent::__Construct();
			$this->load->database();
			if($_POST){
				$this->db->where('id',$this->uri->segment(2));
				$data=$this->db->get('post_config');
				$keywords=$this->input->post('keywords');
				$description=$this->input->post('description');
				$this->load->helper('unicode');
				$date=ngay();
				$time=gio();
				$obj->load->model('mdstatistics');
				$log=$obj->mdstatistics->get_log();
				if($data->num_rows()==0){
					$this->db->insert('post_config',array(
						'id'		=>$this->uri->segment(2),
						'date'		=>	$date,
						'time'		=>	$time,
						'log'		=>	$log,
					));
					$this->db->insert('post_vi',array(
						'id'		=>	$this->uri->segment(2),
						'summary_vi'	=>	$description,
						'content_vi'	=>	$keywords,
						'title_vi'		=>	'Thông Tin Keywords',
					));
				}else{
					$this->db->where('id', $this->uri->segment(2));
					$this->db->update('post_config',array(
						'date'		=>	$date,
						'time'		=>	$time,
						'log'		=>	$log,
					));
					$this->db->where('id', $this->uri->segment(2));
					$this->db->update('post_vi',array(
						'summary_vi'	=>	$description,
						'content_vi'	=>	$keywords,
					));
				}
				header('location:'.base_url().$this->uri->uri_string());
				exit;
			}
			$this->db->where('post_config.id',$this->uri->segment(2));
			$this->db->from('post_config');
			$this->db->join('post_vi', 'post_vi.id=post_config.id');
			$data['post']=$this->db->get()->result_array();
			$data['post']=$data['post'][0];
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/'.$this->uri->segment(2),$data));
		}
	}
?>