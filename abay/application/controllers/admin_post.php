<?php
	require_once('admindefault.php');
	class Admin_Post extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdpost');
		}
		
		function index(){
			$id=$this->uri->segment(2);
			switch($id){
				case 'introduction':{
					$data['code']='gioi-thieu';
					$data['title_vi']='Giới Thiệu';
					$data['title_en']='Introduction';
					break;
				}
				case 'press':{
					$data['code']='press';
					$data['title_vi']='Báo Chí Nói Về Chúng Tôi';
					$data['title_en']='press';
					break;
				}
				case 'contact':{
					$data['code']='lien-he';
					$data['title_vi']='Liên Hệ';
					$data['title_en']='Contact';
					break;
				}
				case 'footer':{
					$data['code']='footer';
					$data['title_vi']='Footer';
					$data['title_en']='Footer';
					break;
				}
				case 'footer-ha-noi':{
					$data['code']='footer-ha-noi';
					$data['title_vi']='Footer Hà Nội';
					$data['title_en']='Footer';
					break;
				}
				case 'footer-tp-hcm':{
					$data['code']='footer-tp-hcm';
					$data['title_vi']='Footer Thành Phố Hồ Chí Minh';
					$data['title_en']='Footer';
					break;
				}
				case 'huong-dan-dat-ve':{
					$data['code']='huong-dan-dat-ve';
					$data['title_vi']='Hướng Dẫn Đặt Vé';
					$data['title_en']='Reservation Guide';
					break;
				}
				case 'huong-dan-thanh-toan':{
					$data['code']='huong-dan-thanh-toan';
					$data['title_vi']='Hướng Dẫn Thanh Toán';
					$data['title_en']='Payment Instructions';
					break;
				}
				case 'thong-tin-chuyen-khoan':{
					$data['code']='thong-tin-chuyen-khoan';
					$data['title_vi']='Thông Tin Chuyển Khoản';
					$data['title_en']='Information Transfer';
					break;
				}
			}
			if($_POST){
				$this->mdpost->update($id, $data['code'], $data['title_vi'], $data['title_en']);
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$data['post']=$this->mdpost->getPostById($id);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/content', $data));
			$this->my_layout->output();
		}
	}
?>