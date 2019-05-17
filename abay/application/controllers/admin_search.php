<?php
	require_once('admindefault.php');
	class Admin_Search extends admindefault{
		function __Construct(){
			parent::__Construct();
		}
		
		function index(){
			if($this->uri->segment(3)=='xoa'){
				$this->db->where('id', $this->uri->segment(4));
				$this->db->delete('thong_tin_tim_kiem');
				parent::HeaderAdmin($this->uri->segment(2));
			}else{
				$config=array(
					'full_tag_open'		=>	'<div class="pagenumber">',
					'full_tag_close'	=>	'</div>',
					'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
					'per_page'			=>	20,
					'uri_segment'		=>	3,
					'num_links'			=>	7,
					'total_rows'		=>	$this->db->get('thong_tin_tim_kiem')->num_rows(),
				);
				$this->pagination->initialize($config);
				$this->db->order_by('id');
				(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
				$this->db->limit(20, $page);
				$data['tim_kiem']=$this->db->get('thong_tin_tim_kiem')->result_array();
				$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/search',$data));
			}
			$this->my_layout->output();
		}
	}
?>