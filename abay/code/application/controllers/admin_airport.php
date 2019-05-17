<?php
	require_once('admindefault.php');
	class Admin_Airport extends admindefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdairport');
		}
		
		function index(){
			$act=$this->uri->segment(3);
			switch($act){
				case 'sua':{
					if($this->uri->segment(5)=='ajax'){
						if($_POST){
							$this->mdairport->_update_name($this->uri->segment(4), strip_tags($this->input->post('airport_name')));
							$data['airport']=$this->mdairport->_Get_Airport_By_Id($this->uri->segment(4));
							echo $this->my_layout->input('back_end/content/airport/change_ajax', $data);
							exit;
						}
					}else{
						if($_POST){
							$this->mdairport->_update($this->uri->segment(4),strip_tags($this->input->post('airport_code')), strip_tags($this->input->post('airport_name')), strip_tags($this->input->post('country_code')));
							parent::HeaderAdmin($this->uri->segment(2));
							exit;
						}else{
							$data['airport']=$this->mdairport->_Get_Airport_By_Id($this->uri->segment(4));
							$this->load->model('mdcountry');
							$data['country']=$this->mdcountry->_Get_Country_By_Id($data['airport']['country_code']);
							$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airport/change', $data));
						}
					}
					break;
				}
				case 'xoa':{
					if($this->uri->segment(5)=='ajax'){
						$this->mdairport->_Delete($this->uri->segment(4));
						exit;
					}
					break;
				}
				case 'search':{
					$data['airport']=$this->mdairport->_Search($this->input->post('str'));
					echo $this->my_layout->input('back_end/content/airport/search', $data);
					exit;
					break;
				}
				case 'them':{
					if($_POST)
					{
						$this->mdairport->_add_airport();
						parent::HeaderAdmin($this->uri->segment(2));
					}
					else
					{
						$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airport/add'));
					}
					break;
				}
				default:{
					$this->view_all();
				}
			}
			$this->my_layout->output();
		}
		
		function view_all(){
			(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
			$config=array(
				'full_tag_open'		=>	'<div class="pagenumber">',
				'full_tag_close'	=>	'</div>',
				'total_rows'		=>	$this->mdairport->_Count_all(),
				'uri_segment'		=>	3,
				'num_links'			=>	7,
				'per_page'			=>	20,
				'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
			);
			$this->pagination->initialize($config);
			$data['airport']=$this->mdairport->_Get_All(20, $page);
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/airport/view', $data));
		}
	}
?>