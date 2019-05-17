<?php
	require_once('home_default.php');
	class Home_Contact extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Thông Tin Liên Hệ');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->load->model('mdpost');
			$data['content']=$this->mdpost->GetPostByCode('lien-he');
			$data['content']=$data['content']['content_vi'];
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/contact', $data));
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
	}
?>