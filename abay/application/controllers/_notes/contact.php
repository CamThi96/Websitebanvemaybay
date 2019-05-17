<?php
	require_once('right_default.php');
	class Contact extends right_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->my_layout->set_data('content_for_title_website', 'Liên Hệ - '.$this->my_layout->get_data('content_for_title_website'));
		}
		
		function index(){
			if($_POST){
				$name=trim(strip_tags($this->input->post('name')));
				$address=trim(strip_tags($this->input->post('address')));
				$phone=trim(strip_tags($this->input->post('phone')));
				$email=trim(strip_tags($this->input->post('email')));
				$comment=nl2br(strip_tags($this->input->post('comment')));
				$this->db->insert('contact', array(
					'id'		=>	md5(rand().time()),
					'name'		=>	$name,
					'address'	=>	$address,
					'phone'		=>	$phone,
					'email'		=>	$email,
					'content'	=>	$comment,
					'time'		=>	time(),
				));
				$dada['error_log']='Thông tin của bạn đã được gửi thành công!<br>Chúng tôi sẽ trả lời trong thời gian sớm nhất.';
			}
			$this->db->where('id', 'contact');
			$data['contact']=$this->db->get('post_vi')->result_array();
			$data['contact']=$data['contact'][0];
			parent::Content_for_left($this->my_layout->input('front_end/contact', $data));
			//$this->my_layout->set_data('content_for_right', );
			$this->my_layout->set_data('content_for_titlewebsite', 'Thông Tin Liên Hệ - '.$this->my_layout->get_data('content_for_titlewebsite'));
			$this->my_layout->output();
		}
	}
?>