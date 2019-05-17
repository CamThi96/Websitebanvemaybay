<?php
	require_once('admindefault.php');
	class Admin extends AdminDefault{
		function __Construct(){
			parent::__Construct();
			$this->load->model('mdyahoo');
		}
		
		function index(){
			$this->my_layout->output();
		}
		
		function ProductType(){
			$this->my_layout->output();
		}
		
		function Maps(){
			$this->load->model('mdslideshow');
			$data['maps']=$this->mdslideshow->_Get_Slideshow_by_id('maps');
			if($_POST){
				unlink('public/uploads/images/'.$data['maps']['image']);
				unlink('public/uploads/images/thumbs/'.$data['maps']['image']);
				$data=$this->mdslideshow->DoUpload('public/uploads/images/');
				$this->mdslideshow->Doresize($data['upload_data']['full_path'], 483, 215, 'public/uploads/images/thumbs/'.$data['upload_data']['file_name']);
				$this->db->where('id', 'maps');
				$this->db->update('slideshow', array('image'=>$data['upload_data']['file_name']));
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/maps', $data));
			$this->my_layout->output();
		}
		
		function contact_infomation(){
			$this->load->model('back_end/mdcontact');
			$this->my_layout->output();
		}
		
		function price(){
			if($_POST){
				$config['upload_path'] 		= 	'public/uploads/files/';//pdf, doc, docx, xls, xlsx, ppt, pptx, txt, zip, rar
				$config['allowed_types'] 	= 	'pdf|PDF|doc|DOC|docx|DOCX|xls|XLS|xlsx|XLSX|ppt|PPT|pptx|PPTX|txt|TXT|zip|ZIP|rar|RAR';
				$config['max_size']			= 	30*1024;
				$config['max_filename']		=	250;
				$config['encrypt_name']		=	true;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('user_file')){
					$data['error']='Có lỗi xảy ra trong quá trình tải file lên server:<br>';
					$data['error'].=$this->upload->display_errors();
				}else{
					$this->db->where('id','file');
					$file=$this->db->get('post_config');
					$data=$this->upload->data();
					if($file->num_rows()==0){
						$this->db->insert('post_config', array(
							'id'	=>	'file',
							'code'	=>	$data['file_name'],
						));
					}else{
						$file=$file->result_array();
						if($data['file_name']!=$file[0]['code']){
							unlink('public/uploads/files/'.$file[0]['code']);
						}
						$this->db->where('id', 'file');
						$this->db->update('post_config',array('code'=>$data['file_name']));
					}
					$data['error']='Sửa file bảng giá thành công!';
				}
			}
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/price', $data));
			$this->my_layout->output();
		}
		
		function link(){
			if($_POST){
				$id=md5(rand().time());
				$link=strip_tags($this->input->post('link'));
				$title_vi=strip_tags($this->input->post('title_vi'));
				$this->db->insert('links', array(
					'id'		=>	$id,
					'link'		=>	$link,
				));
				$this->db->insert('links_vi', array(
					'id'		=>	$id,
					'title_vi'	=>	$title_vi,
				));
				parent::HeaderAdmin($this->uri->segment(2));
			}
			if($this->uri->segment(3)=='xoa'){
				$this->db->where('id', $this->uri->segment(4));
				$this->db->delete('links');
				$this->db->where('id', $this->uri->segment(4));
				$this->db->delete('links_vi');
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$this->db->from('links');
			$this->db->join('links_vi', 'links.id=links_vi.id');
			$data['links']=$this->db->get()->result_array();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/links', $data));
			$this->my_layout->output();
		}
		
		function banner(){
			$this->load->model('mdbanner');
			$image=$_FILES['user_file']['name'];
			if($image!=''){
				$this->mdbanner->update();
				parent::HeaderAdmin($this->uri->segment(2));
			}
			$data=$this->mdbanner->getbanner();
			$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/banner', $data));
			$this->my_layout->output();
		}
		
		function yahoo(){
			$action=$this->uri->segment(3);
			switch($action){
				case 'them':{
					if($_POST){
						$this->mdyahoo->add_yahoo();
						parent::HeaderAdmin($this->uri->segment(2));
					}
					$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/yahoo/add'));
					break;
				}
				case 'sua':{
					if($_POST){
						$this->mdyahoo->change_yahoo();
						parent::HeaderAdmin($this->uri->segment(2));
					}
					$data=$this->mdyahoo->GetYahoo($this->uri->segment(4));
					$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/yahoo/change', $data));
					break;
				}
				case 'xoa':{
					$this->mdyahoo->delete_yahoo();
					parent::HeaderAdmin($this->uri->segment(2));
					break;
				}
				default:{
					$data['yahoo']=$this->mdyahoo->getAllYahoo();
					$this->my_layout->set_data('content_for_website', $this->my_layout->input('back_end/content/yahoo/view', $data));
					break;
				}
			}
			$this->my_layout->output();
		}
	}
?>