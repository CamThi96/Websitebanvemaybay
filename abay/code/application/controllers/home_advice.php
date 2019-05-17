<?php
	require_once('home_default.php');
	class Home_Advice extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Tư Vấn Khách Hàng');
		}
		
		function index(){
			if($_POST){
				$name=strip_tags($this->input->post('name'));
				$email=strip_tags($this->input->post('email'));
				$phone=strip_tags($this->input->post('mobile'));
				$question=nl2br(strip_tags($this->input->post('question')));
				$this->db->insert('advice', array(
					'id'		=>	md5(rand().time()),
					'name'		=>	$name,
					'email'		=>	$email,
					'phone'		=>	$phone,
					'question'	=>	$question,
					'time'		=>	time(),
				));
			}
			parent::_Set_Default_Right();
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/advice'));
			$this->my_layout->set_data('content_for_website', $this->my_layout->get_data('content_for_website'). $this->my_layout->input('front_end/nav_footer'));
			$this->my_layout->output();
		}
	}
?>