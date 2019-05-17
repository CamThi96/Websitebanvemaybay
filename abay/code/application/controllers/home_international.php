<?php
	require_once('home_default.php');
	class Home_international extends Home_Default{
		function __Construct(){
			parent::__Construct();
			$this->load->model(array('mdsearch', 'mdairport', 'mdairlines', 'mdschedule'));
			parent::_Add_Title('Vé Quốc Tế');
		}
		
		function index(){
			if($_POST){
				$name=strip_tags($this->input->post('FullName'));
				$phone=strip_tags($this->input->post('Phone'));
				$content=nl2br(strip_tags($this->input->post('Review')));
				$this->db->insert('customer', array(
					'id'		=> md5(rand().time()),
					'name'		=>	$name,
					'phone'		=>	$phone,
					'time'		=>	time(),
					'content'	=>	$content,
					'status'	=>	0,
				));
			}
			$this->db->limit(4,0);
			$this->db->order_by('time desc');
			$data['tim_kiem']=$this->db->get('thong_tin_tim_kiem')->result_array();
			$this->db->where('id', 'maps');
			$data['maps']=$this->db->get('slideshow')->result_array();
			$data['maps']=$data['maps'][0]['image'];
			$data['yahoo']=$this->db->get('yahoo')->result_array();
			$this->db->where('status', 2);
			$this->db->order_by('time desc');
			$data['customer']=$this->db->get('customer')->result_array();
			//print_r($data['thong_tin_tim_kiem']);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('front_end/content/home_international',$data));
			$this->my_layout->output();
		}
	}
?>