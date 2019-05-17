<?php
	require_once('home_default.php');
	class Home_Customer extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Set_Default_Right();
			$this->load->library('pagination');
			parent::_Add_Title('Khách Hàng Nói Về Chúng Tôi');
		}
		
		function index(){
			$this->db->where('status !=','0');
			$config=array(
				'full_tag_open'			=>	'<div class="pagenumber">',
				'full_tag_close'		=>	'</div>',
				'total_rows'			=>	$this->db->get('customer')->num_rows(),
				'per_page'				=>	10,
				'uri_segment'			=>	2,
				'base_url'				=>	base_url().$this->uri->segment(1),
				'num_links'				=>	5,
			);
			$this->pagination->initialize($config);
			$this->db->where('status !=',0);
			$this->db->limit(10, $page);
			$this->db->order_by('status desc, time desc');
			$data['customer']=$this->db->get('customer')->result_array();
			//print_r($data);
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/customer',$data));
			$this->my_layout->set_data('content_for_website', $this->my_layout->get_data('content_for_website').$this->my_layout->input('front_end/nav_footer'));
			$this->my_layout->output();
		}
	}
?>