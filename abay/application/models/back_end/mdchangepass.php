<?php
	class MdChangePass extends CI_Model{
		function __Construct(){
			parent::__Construct();
			$this->load->database();
			if($_POST){
				$this->form_validation->set_rules('username','tên đăng nhập','required');
				$this->form_validation->set_rules('password','mật khẩu','required');
				$this->form_validation->set_rules('npassword','mật khẩu mới','required|matches[npassword2]');
				$this->form_validation->set_rules('npassword2','nhập lại mật khẩu mới','required');
				if($this->form_validation->run()){
					$this->db->where(array('username'=>$this->input->post('username')));
					$data=$this->db->get('user_admin');
					if($data->num_rows()!=0){
						$data=$data->result_array();
						$this->load->library('encrypt');
						if($this->encrypt->decode($data[0]['password'])==md5($this->input->post('password'))){
							$this->db->where(array('username'=>$this->input->post('username')));
							$this->db->update('user_admin',array('password'=>$this->encrypt->encode(md5($this->input->post('npassword')))));
							$this->my_layout->set_data('content_for_website','Đổi Mật Khẩu Thành Công');
						}else{
							$this->my_layout->set_data('content_for_website','Đăng nhập thất bại, không thể thực hiện đổi mật khẩu<br>'.$this->my_layout->input('back_end/content/changepass'));
						}
					}else{
						$this->my_layout->set_data('content_for_website','Đăng nhập thất bại, không thể thực hiện đổi mật khẩu<br>'.$this->my_layout->input('back_end/content/changepass'));
					}
				}
				else{
					$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/changepass'));
				}
			}else{
				$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/changepass'));
			}
		}
	}
?>