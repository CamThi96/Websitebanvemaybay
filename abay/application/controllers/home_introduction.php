<?php
	require_once('home_default.php');
	class Home_Introduction extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Giới Thiệu');
		}
		
		function index(){
			parent::_Set_Default_Right();
			$this->load->model('mdpost');
			$data['content']=$this->mdpost->GetPostByCode('gioi-thieu');
			$data['content']=$data['content']['content_vi'];
			$data['title']='Giới Thiệu Công Ty Chúng Tôi';
			parent::_Set_Default_Left($this->my_layout->input('front_end/left', $data));
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
	}
?>