<?php
	class AdminDefault extends CI_Controller{
		function __Construct(){
			parent::__Construct();
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$this->load->database();
			$this->load->helper(array('url'));
			$this->load->library(array('my_layout', 'table', 'form_validation', 'session', 'pagination'));
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->my_layout->set_layout('back_end/default');
			$this->CheckAdmin();
			$this->Default_Template();
		}
		
		function Default_Template(){
			$this->my_layout->set_data('content_for_header',$this->my_layout->input('back_end/header'));
			$this->my_layout->set_data('content_for_footer',$this->my_layout->input('back_end/footer'));
			$this->my_layout->set_data('content_for_left',$this->my_layout->input('back_end/left'));
		}
		
		function CheckAdmin(){
			if($this->Check_Session_Admin()==false){
				$this->HeaderAdmin('login');
			}else{
				$this->Check_Time_Admin();
			}
		}
		
		function HeaderAdmin($url){
			header('location:'.base_url().$this->uri->segment(1).'/'.$url);
			exit;
		}
		
		function changepass(){
			$this->load->model('back_end/mdchangepass');
			$this->my_layout->output();
		}
		
		function Keywords(){
			$this->load->model('back_end/mdkeywords');
			$this->my_layout->output();
		}
		
		function yahoo(){
			$this->load->model('back_end/mdyahoo');
			$this->my_layout->output();
		}
		
		function Logout(){
			$this->session->unset_userdata('time');
			$this->session->unset_userdata('id');
			$this->HeaderAdmin();
		}
		
		function User(){
			if($_POST){
				$config=array(
					array(
						'field'	=>'user_name',
						'label'	=>'Tên Đăng Nhập',
						'rules'	=>'required|callback_check_user',
					),
					array(
						'field'	=>'password',
						'label'	=>'Mật Khẩu',
						'rules'	=>'required',
					),
					array(
						'field'	=>'re_password',
						'label'	=>'Nhập Lại Mật Khẩu',
						'rules'	=>'required|matches[password]',
					),
				);
				$this->form_validation->set_rules($config);
				if($this->form_validation->run()==true){
					$this->load->model('back_end/mduser');
					$this->mduser->add();
					$this->HeaderAdmin($this->uri->segment(2));
				}
			}
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/user/add'));
			$this->my_layout->output();
		}
		
		function check_user($user){
			$this->form_validation->set_message('check_user', 'Tên đăng nhập: '.$user.' đã tồn tại');
			$this->load->model('back_end/mduser');
			return $this->mduser->checkuser($user);
		}
		
		function Login(){
			if($_POST){
				if($this->Check_Validation()){
					$this->load->model('back_end/mduser');
					$username=$this->input->post('username');
					$password=$this->input->post('password');
					$data=$this->mduser->GetUser($username, $password);
					if($data!=false){
						//if(intval($data['capdo'])==1){
							$this->session->set_userdata('id',$data['id']);
							$this->session->set_userdata('time',time());
							$this->HeaderAdmin();
						//}else{
						//	unset($data);
						//	$data['errorlog']='Bạn không có quyền quản trị!';
						//}
					}else{
						unset($data);
						$data['errorlog']='Sai tên đăng nhập hoặc mật khẩu!.<br>Đăng nhập thất bại.';
					}
				}
			}
			$this->session->unset_userdata('time');
			$this->session->unset_userdata('id');
			$this->load->view('back_end/login', $data);
		}
		
		function Check_Validation(){
			$this->form_validation->set_rules('username','Tên Đăng Nhập','required');
			$this->form_validation->set_rules('password','Mật Khẩu','required');
			return $this->form_validation->run();
		}
		
		function Check_Time_Admin(){
			$timeout=time()-900;
			if($this->session->userdata('time')<$timeout && $this->uri->segment(2)!='login'){
				$this->session->unset_userdata('time');
				$this->session->unset_userdata('id');
				//print 'a';
				header('location:'.base_url().$this->uri->segment(1).'/login/');
				return false;
				exit;
			}else{
				$this->session->set_userdata('time',time());
				return true;
			}
		}
		
		function Check_Session_Admin(){
			if($this->session->userdata('id')=='' && $this->uri->segment(2)!='login'){
				return false;
			}
			return true;
		}
	}
?>