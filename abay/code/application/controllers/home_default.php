<?php
	class Home_Default extends CI_Controller{
		function __Construct(){
			parent::__Construct();
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$this->load->database();
			$this->load->library(array('my_layout', 'session'));
			$this->load->model(array('mdpost'));
			$this->load->helper(array('url'));
			$this->__Set_Default();
		}
		
		function __Set_Default(){
			$data['footer']=$this->mdpost->getPostByCode('footer');
			$this->my_layout->set_data('content_for_footer', $data['footer']['content_vi']);
			
			
			$data['footer']=$this->mdpost->getPostByCode('footer-ha-noi');
			$this->my_layout->set_data('content_for_footer_hn', $data['footer']['content_vi']);
			
			
			$data['footer']=$this->mdpost->getPostByCode('footer-tp-hcm');
			$this->my_layout->set_data('content_for_footer_hcm', $data['footer']['content_vi']);
			
			$this->db->where('id', 'keywords');
			$data['keywords']=$this->db->get('post_vi')->result_array();
			$this->my_layout->set_data('content_for_keywords', $data['keywords'][0]['title_vi']);
			$this->my_layout->set_data('content_for_description', $data['keywords'][0]['summary_vi']);
			
			
			$this->my_layout->set_data('content_for_title_website', 'TVO Việt Nam');
			
			$this->db->where('id', 'banner');
			$data['image_header']=$this->db->get('post_config')->result_array();
			$this->my_layout->set_data('image_header', $data['image_header'][0]['code']);
			$this->my_layout->Set_Layout('front_end/default');
		}
		
		function _Add_Title($str){
			$this->my_layout->set_data('content_for_title_website', $str.' - '.$this->my_layout->get_data('content_for_title_website'));
		}
		
		function _set_Default_Nav(){
			$this->my_layout->set_data('content_for_website', $this->my_layout->get_data('content_for_website').$this->my_layout->input('front_end/nav_footer'));
		}
		
		function _Set_Default_Right(){
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('front_end/right', $data));
		}
		
		function _Set_Default_Left($str){
			$this->my_layout->set_data('content_for_website', $str.$this->my_layout->get_data('content_for_website'));
		}
	}
?>