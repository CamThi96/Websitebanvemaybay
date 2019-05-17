<?php
	class MdUser extends CI_Model{
		private $ci;
		function __Construct(){
			parent::__Construct();
			$this->ci=&get_instance();
		}
		
		function Add_User(){
		}
		
		function CheckUser($user){
			$this->db->where('username',$user);
			$data=$this->db->get('user_admin');
			if($data->num_rows()!=0){
				return false;
			}else{
				return true;
			}
		}
		
		function Add(){
			$this->load->library('encrypt');
			$username=strip_tags($this->input->post('user_name'));
			$password=$this->encrypt->encode(md5(strip_tags($this->input->post('password'))));
			$name=strip_tags($this->input->post('name'));
			$company=strip_tags($this->input->post('company'));
			$address=strip_tags($this->input->post('address'));
			$phone=strip_tags($this->input->post('phone'));
			$email=strip_tags($this->input->post('email'));
			$id=md5(rand().time());
			$this->ci->load->model('mdstatistics');
			$log=$this->ci->mdstatistics->get_log();
			$this->db->insert('user_admin', array(
				'id'		=>	$id,
				'username'	=>	$username,
				'password'	=>	$password,
				'name'		=>	$name,
				'company'	=>	$company,
				'email'		=>	$email,
				'address'	=>	$address,
				'phone'		=>	$phone,
				'logreg'	=>	$log,
			));
		}
		
		function GetUser($user, $password){
			$this->load->library('encrypt');
			$password=md5(strip_tags($password));
			$this->db->where('username',$user);
			$data=$this->db->get('user_admin');
			if($data->num_rows()==1){
				$data=$data->result_array();
				if($this->encrypt->decode($data[0]['password'])==$password){
					return $data[0];
				}else{
					return false;
				}
				//print $this->encrypt->decode($data[0]['password']);
				//print $password;
				//$this->db->where(array('username'=>$user, 'password'=>$password));
				//$data=$this->db->get('user_admin');
				//if($data->num_rows()!=0 && $data->num_rows()==1){
				//	$data=$data->result_array();
				//	return $data[0];
				//}else{
				//	return false;
				//}
			}else{
				return false;
			}
		}
	}
?>