<?php
	class MdYahoo extends CI_Model{
		function __Construct(){
			parent::__Construct();
			if($this->uri->segment(3)=='them'){
				$this->AddYahoo();
			}elseif($this->uri->segment(3)=='sua'){
				$this->UpdateYahoo();
			}elseif($this->uri->segment(3)=='xoa'){
				$this->DelelteYahoo();
			}else{
				$this->ViewAllYahoo();
			}
		}
		
		function DelelteYahoo(){
			$this->db->where('id',$this->uri->segment(4));
			$this->db->delete('yahoo');
			header('location:'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2));
			exit;
		}
		
		function UpdateYahoo(){
			if($_POST){
				$yahoo=strip_tags($this->input->post('yahoo'));
				$title=strip_tags($this->input->post('tieude'));
				$titleen=strip_tags($this->input->post('tieudeen'));
				$id=md5(rand().time());
				$this->db->where('id',$this->uri->segment(4));
				$this->db->update('yahoo', array(
					'yahoo'	=>	$yahoo,
					'titlevi'	=>	$title,
					'titleen'=>	$titleen,
				));
				header('location:'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2));
				exit;
			}
			$this->db->where('id', $this->uri->segment(4));
			$data['yahoo']=$this->db->get('yahoo')->result_array();
			$data['yahoo']=$data['yahoo'][0];
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/changeyahoo',$data));
		}
		
		function AddYahoo(){
			if($_POST){
				$yahoo=strip_tags($this->input->post('yahoo'));
				$title=strip_tags($this->input->post('tieude'));
				$titleen=strip_tags($this->input->post('tieudeen'));
				$id=md5(rand().time());
				$this->db->insert('yahoo', array(
					'id'	=>	$id,
					'yahoo'	=>	$yahoo,
					'titlevi'	=>	$title,
					'titleen'	=>$titleen,
				));
				header('location:'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2));
				exit;
			}
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/addyahoo'));
		}
		
		function ViewAllYahoo(){
			$data['yahoo']=$this->db->get('yahoo')->result_array();
			$this->my_layout->set_data('content_for_website',$this->my_layout->input('back_end/content/yahoo',$data));
		}
	}
?>