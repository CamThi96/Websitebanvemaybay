<?php
	require_once('admindefault.php');
	class Admin_Country extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdcountry');
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'sua':{
					if($this->uri->segment(5)=='ajax'){
						$this->mdcountry->_update($this->uri->segment(4), strip_tags($this->input->post('country_title')));
						$data['country']=$this->mdcountry->_Get_Country_By_Id($this->uri->segment(4));
						print $this->my_layout->input('back_end/content/country/view_ajax', $data);
						exit;
					}
					break;
				}
				case 'search':{
					$data['country']=$this->mdcountry->_Search($this->input->post('str'));
					echo $this->my_layout->input('back_end/content/country/search', $data);
					exit;
					break;
				}
				case 'search_country':{
					$data['country']=$this->mdcountry->_Search($this->input->post('str'));
					echo $this->my_layout->input('back_end/content/country/search_country', $data);
					exit;
					break;
				}
				case 'xoa':{
					if($this->uri->segment(5)=='ajax'){
						$this->mdcountry->_Delete($this->uri->segment(4));
						exit;
					}
					break;
				}
				case 'them':{
					if($_POST)
					{
						$this->mdcountry->_Add_Country();
						parent::HeaderAdmin($this->uri->segment(2));
					}
					else{
						$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/country/add'));
					}
					break;
				}
				default:{
					$this->viewall();
				}
			}
			$this->my_layout->output();
		}
		
		function viewall(){
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'		=>	'</div>',
				'base_url'				=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
				'per_page'				=>	20,
				'uri_segment'			=>	3,
				'num_links'				=>	7,
				'total_rows'			=>	$this->mdcountry->_Count_All(),
			);
			$this->pagination->initialize($config);
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$data['country']=$this->db->get('airport_country', 20, $page)->result_array();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/country/view', $data));
		}
	}
?>