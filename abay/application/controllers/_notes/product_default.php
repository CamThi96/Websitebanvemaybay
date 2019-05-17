<?php
	require_once('right_default.php');
	class Product_Default extends Right_Default{
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
			$this->my_layout->set_data('content_for_title_website', 'Sản Phẩm - '.$this->my_layout->get_data('content_for_title_website'));
			$this->obj->load->library('pagination');
		}
		
		function index(){
			$this->obj->load->model('mdproduct');
			$this->Show_Content_Product();
			//parent::Content_for_left($this->my_layout->input('front_end/left'));
			$this->my_layout->output();
		}
		
		function Show_Content_Product(){
			//Kiểm tra trường xem có mã sản phẩm không
			if($this->uri->segment(3)!=''){
				$type=$this->obj->mdproduct->GetType($this->uri->segment(2));
				if($type==false){//Kiểm tra xem loại sản phẩm có đúng không
					$this->ShowAll_Product();
				}else{
					$main=$this->obj->mdproduct->getmain($this->uri->segment(2));
					if($main!=false){//Kiểm tra xem loại sản phẩm có phải là sub không
						$this->my_layout->set_data('content_for_title_website', $main['title'].' - '. $this->my_layout->get_data('content_for_title_website'));
					}
					$this->my_layout->set_data('content_for_title_website', $type['title'].' - '. $this->my_layout->get_data('content_for_title_website'));
					//Bắt đầu kiểm tra mã sản phẩm
					$id=$this->uri->segment(3);
					$data['product']=$this->obj->mdproduct->GetProductById($id);
					if($data['product']==false){
						$this->ShowAll_Product_Type();//Mã sản phẩm không hợp lệ, chuyển qua hiển thị loại
					}else{
						$this->my_layout->set_data('content_for_title_website', $data['product']['title'].' - '. $this->my_layout->get_data('content_for_title_website'));
						$data['not']=$this->obj->mdproduct->GetProductTypeNotId($id);
						parent::Content_for_left($this->my_layout->input('front_end/product_default',$data));
					}
				}
			}else{
				$this->ShowAll_Product_Type();//Chuyển qua hiển thị các sản phẩm trong loại
			}
		}
		
		function ShowAll_Product_Type(){
			if($this->uri->segment(2)!=''){
				$type=$this->obj->mdproduct->GetType($this->uri->segment(2));
				if($type==false){
					$this->ShowAll_Product();
				}else{
					$config=array(
						'full_tag_open'		=>	'<div class="pagenumber">',
						'full_tag_close'	=>	'</div>',
						'per_page'			=>	12,
						'uri_segment'		=>	3,
						'base_url'			=>	base_url().$this->uri->segment(1).'/'.$this->uri->segment(2),
						'total_rows'		=>	count($this->obj->mdproduct->GetProductType($this->uri->segment(2),999999999,0)),
					);
					$this->obj->pagination->initialize($config);
					(intval($this->uri->segment(3))<0)?$page=0:$page=intval($this->uri->segment(3));
					$data['list_product']=$this->obj->mdproduct->GetProductType($this->uri->segment(2),12,$page);
					$data['title']='Danh Sách Sản Phẩm Thuộc: '.$type['title'];
					$data['page']=$this->obj->pagination->create_links();
					parent::Content_for_left($this->my_layout->input('front_end/list_product', $data));
					$this->my_layout->set_data('content_for_title_website', $type['title'].' - '. $this->my_layout->get_data('content_for_title_website'));
				}
			}else{
				$this->ShowAll_Product();
			}
		}
		
		function ShowAll_Product(){
		}
	}
?>