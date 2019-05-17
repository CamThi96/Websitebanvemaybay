<?php
	class MdProduct extends CI_Model{
		var $obj;
		
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
		}
		
		function GetChild($main){
			$data=$this->db->query('select id from product_type where main=\''.$main.'\'')->result_array();
			foreach($data as $val){
				$str.="'".$val['id']."', ";
			}
			$str=substr($str,0,strlen($str)-2);
			return $str;
		}
		
		function GetProductChild($main){
			$id_type=$this->GetChild($main);
			$this->db->from('product');
			$this->db->join('product_vi','product.id=product_vi.id_product');
			$this->db->where('id_type in ('.$id_type.')' );
			$data=$this->db->get();
			return $data->result_array();
		}
		
		function GetAllTopProduct(){
			$this->db->where('status',1);
			$this->db->from('product');
			$this->db->join('product_vi','product.id=product_vi.id_product');
			$this->db->join('product_en','product.id=product_en.id_product');
			return $this->db->get()->result_array();
		}
		
		function GetAllPermissionsProduct(){
			$this->db->where('permissions',1);
			$this->db->from('product');
			$this->db->join('product_vi','product.id=product_vi.id_product');
			$this->db->join('product_en','product.id=product_en.id_product');
			return $this->db->get()->result_array();
		}
		
		
		
		function GetTypeMain(){
			$this->db->where('main','');
			$this->db->order_by('order', 'asc');
			$this->db->join('product_type_en', 'product_type.id=product_type_en.id');
			$this->db->join('product_type_vi', 'product_type.id=product_type_vi.id');
			return $this->db->get('product_type')->result_array();
		}
		
		function GetType($id){
			$this->db->where('product_type.id', $id);
			$this->db->from('product_type');
			$this->db->join('product_type_en', 'product_type.id=product_type_en.id');
			$this->db->join('product_type_vi', 'product_type.id=product_type_vi.id');
			$data=$this->db->get();
			if($data->num_rows()!=0){
				$data=$data->result_array();
				return $data[0];
			}else{
				return false;
			}
		}
		
		function GetMain($id){
			$this->db->where('id', $id);
			$data=$this->db->get('product_type')->result_array();
			$this->db->where('id', $data[0]['main']);
			$data=$this->db->get('product_type');
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function Delete_type($id){
			$this->db->where('main', $id);
			$this->db->update('product_type',array('main'=>''));
			$this->db->where('id', $id);
			$this->db->delete('product_type');
			$this->db->where('id', $id);
			$this->db->delete('product_type_vi');
			$this->db->where('id', $id);
			$this->db->delete('product_type_en');
		}
		
		function GetTypeSub($main){
			$this->db->where('main', $main);
			$this->db->order_by('order', 'asc');
			$this->db->from('product_type');
			$this->db->join('product_type_vi', 'product_type.id=product_type_vi.id');
			return $this->db->get()->result_array();
		}
		
		function DoAddType(){
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$main=strip_tags($this->input->post('main'));
			if($main=='la-danh-muc-cha')$main='';
			$order=strip_tags($this->input->post('order'));
			$this->load->helper('unicode');
			$id=khongdau($title_vi).rand5str();
			$this->db->insert('product_type', array(
				'id'		=>	$id,
				'order'		=>	$order,
				'main'		=>	$main,
			));
			$this->db->insert('product_type_en', array(
				'id'		=>	$id,
				'title_en'	=>	$title_en,
			));
			$this->db->insert('product_type_vi', array(
				'id'		=>	$id,
				'title_vi'	=>	$title_vi,
			));
		}
		
		function DoChangeType(){
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$main=strip_tags($this->input->post('main'));
			if($main=='la-danh-muc-cha')$main='';
			$order=strip_tags($this->input->post('order'));
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product_type', array(
				'order'		=>	$order,
				'main'		=>	$main,
			));
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product_type_en', array(
				'title_en'	=>	$title_en,
			));
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product_type_vi', array(
				'title_vi'	=>	$title_vi,
			));
		}
		
////////////////////////////////////////////////////////////////

		function _Do_Search_Product($str, $perpage, $page){
			//$str=str_replace(' ','%',$str);
			//print $str;
			//$str=explode(' ',$str);
			//print_r($str);
			$this->db->like('product.id', $str, 'both');
			$this->db->or_like('title_en', $str, 'both');
			$this->db->or_like('title_vi', $str, 'both');
			$this->db->or_like('content_en', $str, 'both');
			$this->db->or_like('content_vi', $str, 'both');
			$this->db->from('product');
			$this->db->join('product_vi','product.id=product_vi.id_product');
			$this->db->join('product_en','product.id=product_en.id_product');
			return $this->db->get()->result_array();
		}

		function GetAllProduct($perpage, $page){
			$this->db->order_by('date desc, time desc');
			$this->db->from('product');
			$this->db->join('product_vi', 'product.id=product_vi.id_product');
			$this->db->join('product_en','product.id=product_en.id_product');
			$this->db->limit($perpage, $page);
			return $this->db->get()->result_array();
			//return $this->db->get('product'
		}
		
		function GetProductType($type, $perpage, $page){
			$this->db->where('id_type =\''.$type.'\' or id_type in(select id from product_type where main=\''.$type.'\')');
			$this->db->from('product');
			$this->db->join('product_vi','product.id=product_vi.id_product');
			$this->db->join('product_en','product.id=product_en.id_product');
			$this->db->limit($perpage, $page);
			$this->db->order_by('date desc, time desc');
			$data=$this->db->get();
			return $data->result_array();
		}
		
		function GetProductById($id){
			$this->db->where('id', $id);
			$this->db->join('product_vi', 'id=product_vi.id_product');
			$this->db->join('product_en','id=product_en.id_product');
			$this->db->from('product');
			$data=$this->db->get();
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				return $data[0];
			}
		}
		
		function GetProductTypeNotId($id, $perpage=10, $page=0){
			$this->db->where('id', $id);
			$this->db->join('product_vi', 'id=id_product');
			$this->db->from('product');
			$data=$this->db->get()->result_array();
			$this->db->where(array('id_type'=>$data[0]['id_type'], 'id !='=>$id));
			$this->db->join('product_vi', 'id=id_product');
			$this->db->from('product');
			$this->db->limit($perpage, $page);
			$this->db->order_by('date desc, time desc');
			return $this->db->get()->result_array();
		}
		
		function Count_all_product(){
			return $this->db->get('product')->num_rows();
		}
		
		function Close_Highlights(){
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product', array(
			'status'=>0));
		}
		
		function Open_highlights(){
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product', array(
			'status'=>1));
		}
		
		function Close_permissions(){
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product', array(
			'permissions'=>0));
		}
		
		function Open_permissions(){
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('product', array(
			'permissions'=>1));
		}
		
		function DoDeleteProduct(){
			$id=$this->uri->segment(4);
			$data=$this->GetProductById($id);
			unlink('public/uploads/products/'.$data['image']);
			$this->db->where('id', $id);
			$this->db->delete('product');
			$this->db->where('id_product', $id);
			$this->db->delete('product_vi');
			$this->db->where('id_product', $id);
			$this->db->delete('product_en');
		}
		
		function upload_quote(){
				$config['upload_path'] 		= 	'public/uploads/files/';//pdf, doc, docx, xls, xlsx, ppt, pptx, txt, zip, rar
				$config['allowed_types'] 	= 	'pdf|PDF|doc|DOC|docx|DOCX|xls|XLS|xlsx|XLSX|ppt|PPT|pptx|PPTX|txt|TXT|zip|ZIP|rar|RAR';
				$config['max_size']			= 	30*1024;
				$config['max_filename']		=	250;
				$config['encrypt_name']		=	true;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('user_file_quote')){
					$data['error']='Có lỗi xảy ra trong quá trình tải file lên server:<br>';
					$data['error'].=$this->upload->display_errors();
				}else{
					//$this->db->where('id','file');
					//$file=$this->db->get('post_config');
					$data=$this->upload->data();
					//if($file->num_rows()==0){
					//	$this->db->insert('post_config', array(
					//		'id'	=>	'file',
					//		'code'	=>	$data['file_name'],
					//	));
					//}else{
					//	$file=$file->result_array();
					//	if($data['file_name']!=$file[0]['code']){
					//		unlink('public/uploads/files/'.$file[0]['code']);
					//	}
					//	$this->db->where('id', 'file');
					//	$this->db->update('post_config',array('code'=>$data['file_name']));
					//}
					//$data['error']='Sửa file bảng giá thành công!';
				}
			return $data['file_name'];
		}
		
		function DoChangeProduct(){
			$id_product=$this->uri->segment(4);
			$image=$_FILES['user_file']['name'];
			$this->load->helper('unicode');
			$date=ngay();
			$time=gio();
			$this->obj->load->model('mdstatistics');
			$log=$this->obj->mdstatistics->Get_log();
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$id_type=strip_tags($this->input->post('product_type'));
			$price=strip_tags($this->input->post('price'));
			$warranty=strip_tags($this->input->post('warranty'));
			$standard=strip_tags($this->input->post('standard'));
			$dimensions=strip_tags($this->input->post('dimensions'));
			$surface=strip_tags($this->input->post('surface'));
			$thickness=strip_tags($this->input->post('thickness'));
			//$price=intval(strip_tags($this->input->post('price')));
			$content_vi=$this->input->post('content_vi');
			$content_en=$this->input->post('content_en');
			if($image!=''){
				$image=$this->GetProductById($id_product);
				unlink('public/uploads/products/'.$image['image']);
				$this->load->library('my_img');
				$data=$this->my_img->upload('public/uploads/products/');
				//if($data['error']==true){
					$this->my_img->doresize(324, 250, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
					$this->my_img->watermark($data['upload_data']['full_path'], 'public/style/img/thumb_logo_sieuviet.png');
					$this->db->where('id', $id_product);
					$this->db->update('product', array(
						'id_type'	=>	$id_type,
						'date_update'=>	$date,
						'time_update'=>	$time,
						'log'		=>	$log,
						'image'		=>	$data['upload_data']['file_name'],
						'price'		=>	$price,
						'warranty'	=>	$warranty,
						'standard'	=>	$standard,
						'dimensions'=>	$dimensions,
						'thickness'	=>	$thickness,
						'surface'	=>	$surface,
					));
				//}
			}else{
					$this->db->where('id', $id_product);
					$this->db->update('product', array(
						'id_type'	=>	$id_type,
						'date_update'=>	$date,
						'time_update'=>	$time,
						'log'		=>	$log,
						'price'		=>	$price,
						'price'		=>	$price,
						'warranty'	=>	$warranty,
						'standard'	=>	$standard,
						'thickness'	=>	$thickness,
						'dimensions'=>	$dimensions,
						'surface'	=>	$surface,
					));
			}
			$quote=$_FILES['user_file_quote']['name'];
			if($quote!=''){
				$data=$this->GetProductById($id_product);
				unlink('public/uploads/files/'.$data['quote']);
				$data=$this->upload_quote();
				$this->db->where('id', $id_product);
				$this->db->update('product', array('quote'=>$data));
			}
			$this->db->where('id_product', $id_product);
			$this->db->update('product_vi', array(
				'title_vi'		=>	$title_vi,
				'content_vi'	=>	$content_vi,
			));
			$this->db->where('id_product', $id_product);
			$this->db->update('product_en', array(
				'title_en'		=>	$title_en,
				'content_en'	=>	$content_en,
			));		
		}
		
		function DoAddProduct(){
			$image=$_FILES['user_file']['name'];
			$this->load->helper('unicode');
			$date=ngay();
			$time=gio();
			$this->obj->load->model('mdstatistics');
			$log=$this->obj->mdstatistics->Get_log();
			$title_vi=strip_tags($this->input->post('title_vi'));
			$title_en=strip_tags($this->input->post('title_en'));
			$id_type=strip_tags($this->input->post('product_type'));
			
			$warranty=strip_tags($this->input->post('warranty'));
			$standard=strip_tags($this->input->post('standard'));
			$dimensions=strip_tags($this->input->post('dimensions'));
			$surface=strip_tags($this->input->post('surface'));
			$price=intval(strip_tags($this->input->post('price')));
			$content_vi=$this->input->post('content_vi');
			$content_en=$this->input->post('content_en');
			$thickness=strip_tags($this->input->post('thickness'));
			$id=khongdau($title_vi).rand5str();
			if($image!=''){
				$this->load->library('my_img');
				$data=$this->my_img->upload('public/uploads/products/');
				//if($data['error']==true){
					$this->my_img->doresize(350, 250, $data['upload_data']['full_path'], $data['upload_data']['full_path']);
					$this->my_img->watermark($data['upload_data']['full_path'], 'public/style/img/thumb_logo_sieuviet.png');
					$this->db->insert('product', array(
						'id'		=>	$id,
						'id_type'	=>	$id_type,
						'date'		=>	$date,
						'time'		=>	$time,
						'log'		=>	$log,
						'image'		=>	$data['upload_data']['file_name'],
						'price'		=>	$price,
						'warranty'	=>	$warranty,
						'standard'	=>	$standard,
						'dimensions'=>	$dimensions,
						'thickness'	=>	$thickness,
						'surface'	=>	$surface,
						//'quote'		=>	$quote,
					));
				//}
			}else{
					$this->db->insert('product', array(
						'id'		=>	$id,
						'id_type'	=>	$id_type,
						'date'		=>	$date,
						'time'		=>	$time,
						'log'		=>	$log,
						'price'		=>	0,
						//'quote'		=>	$quote,
					));
			}
			$this->db->insert('product_vi', array(
				'id_product'=>	$id,
				'title_vi'		=>	$title_vi,
				'content_vi'	=>	$content_vi,
			));
			$this->db->insert('product_en', array(
				'id_product'=>	$id,
				'title_en'		=>	$title_en,
				'content_en'	=>	$content_en,
			));
			
			$quote=$this->upload_quote();
			$this->db->where('id', $id);
			$this->db->update('product', array('quote'=>$quote));
		}
	}
?>