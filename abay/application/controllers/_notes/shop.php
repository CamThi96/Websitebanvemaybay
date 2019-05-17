<?php
	require_once('right_default.php');
	class Shop extends Right_Default{
		var $action;
		var $obj;
		function __Construct(){
			parent::__Construct();
			$this->obj=&get_instance();
			$this->obj->load->model('mdproduct');
			$this->obj->cart->product_name_rules.="\pL";
		}
		
		function index(){
			$this->action=$this->uri->segment(2);
			switch ($this->action){
				case 'mua':{
					$this->_Do_Buy_Order();
					break;
				}
				case 'xoa':{
					$this->_Do_Delete_Order();
					break;
				}
				case 'thanh-toan':{
					$this->_Show_Buy_Form();
					break;
				}
				default:{
					$this->_Show_Order();
					break;
				}
			}
			$this->my_layout->output();
		}
		
		function check_captcha($captcha){
			$this->obj->form_validation->set_message('check_captcha', 'Nhập sai Captcha');
			$this->db->where('captcha_id', $this->session->userdata('session_id'));
			$data=$this->db->get('captcha');
			if($data->num_rows()==0){
				return false;
			}else{
				$data=$data->result_array();
				if(strtolower($data[0]['word'])!=strtolower($captcha)){
					return false;
				}else{
					return true;
				}
			}
		}
		
		function _Do_Add_Orders(){
			$this->load->helper('unicode');
			$id=md5(rand().time());
			$this->db->insert('orders', array(
				'id_orders'		=>	$id,
				'name'			=>	strip_tags($this->input->post('name')),
				'address'		=>	strip_tags($this->input->post('address')),
				'phone'			=>	$this->input->post('phone'),
				'email'			=>	$this->input->post('email'),
				'date'			=>	ngay(),
				'time'			=>	gio(),
			));
			$data=$this->obj->cart->contents();
			foreach($data as $val){
				$this->db->insert('orders_line',array(
					'id_orders'		=>	$id,
					'id_product'	=>	$val['id'],
					'number'		=>	$val['qty'],
				));
			}
			$this->obj->cart->destroy();
		}

		function _Show_Buy_Form(){
			$this->obj->load->library('form_validation');
			if($_POST){
				$config=array(
					array(
						'field'			=>	'name',
						'label'			=>	'Họ Tên',
						'rules'			=>	'required',
					),
					array(
						'field'			=>	'address',
						'label'			=>	'Địa Chỉ',
						'rules'			=>	'required',
					),
					array(
						'field'			=>	'phone',
						'label'			=>	'Số Điện Thoại',
						'rules'			=>	'required|numeric',
					),
					array(
						'filed'			=>	'email',
						'label'			=>	'Email',
						'rules'			=>	'valid_email',
					),
					array(
						'field'			=>	'captcha',
						'label'			=>	'Captcha',
						'rules'			=>	'required|callback_check_captcha',
					),
				);
				$this->obj->form_validation->Set_rules($config);
				if($this->obj->form_validation->run()){
					if($this->check_captcha($this->input->post('captcha'))){
						$this->_Do_Add_Orders();
						$data['log']='Thông tin đơn hàng của bạn đã được cập nhật.<br>Chúng tôi sẽ liên lạc với bạn trong thời giam sớm nhất!';
					}else{
						$data['log']='Nhập sai captcha';
					}
				}else{
					$data['log']=validation_errors();
				}
			}
			$this->load->helper('captcha');
			$vals = array(
				'img_path'	 => './public/uploads/captcha/',
				'img_url'	 => base_url().'public/uploads/captcha/',
    			'font_path'	 => './public/uploads/fonts/VNTIME.TTF',
				);
			$cap = create_captcha($vals);
			$this->db->where('captcha_id', $this->session->userdata('session_id'));
			$img_captcha=$this->db->get('captcha')->result_array();
			unlink('public/uploads/captcha/'.$img_captcha[0]['image']);
			$this->db->where('captcha_id', $this->session->userdata('session_id'));
			$this->db->delete('captcha');
			$expiration = time()-7200; // Two hour limit
			$this->db->where('captcha_time <',$expiration);
			$img_captcha=$this->db->get('captcha')->result_array();
			foreach($img_captcha as $val){
				unlink('public/uploads/captcha/'.$val['image']);
			}
			$this->db->where('captcha_time <',$expiration);
			$captcha = array(
				'captcha_id'	=>	$this->session->userdata('session_id'),
				'captcha_time'	=> 	$cap['time'],
				'ip_address'	=> 	$this->input->ip_address(),
				'word'	 		=> 	$cap['word'],
				'image'			=>	$cap['img_name'],
				);
			$query = $this->db->insert_string('captcha', $captcha);
			$this->db->query($query);
			$data['image_captcha']=$cap['image'];
			$this->obj->load->model('mdpost');
			$data['content']=$this->obj->mdpost->GetPostByCode('thanh-toan');
			$data['content']=$data['content']['content'];
			parent::Content_for_left($this->my_layout->input('front_end/buyshop', $data));
		}
		
		function _Show_Order(){
			if($_POST){
				$row=$this->input->post('row');
				$total=$this->input->post('total');
				for($i=0;$i<count($row);$i++){
					$data=array(
						'rowid'		=>	$row[$i],
						'qty'		=>	$total[$i],
					);
					$this->obj->cart->update($data);
				}
				$this->_Header();
			}
			$data['orders']=$this->obj->cart->contents();
			$data['order_total']=$this->obj->cart->total();
			parent::Content_for_left($this->my_layout->input('front_end/order', $data));
		}
		
		function _Do_Delete_Order(){
			$id_product=$this->uri->segment(3);
			$data=array(
				'rowid'		=>	$id_product,
				'qty'		=>	0,
			);
			$this->obj->cart->update($data);
			$this->_Header();
		}
		
		function _Do_Buy_Order(){
			$id_product=$this->uri->segment(3);
			$data=$this->obj->cart->Get_by_id($id_product);
			if($data!=false){
				$data=array(
					'rowid'		=>	$data['rowid'],
					'qty'		=>	intval($data['qty'])+1,
				);
				$this->obj->cart->update($data);
			}else{
				$product=$this->obj->mdproduct->GetProductById($id_product);
				if($product!=false){
					$data=array(
							'id'			=>	$id_product,
							'qty'			=>	1,
							'price'			=>	$product['price'],
							'name'			=>	$product['title'],
							'option'		=>	array('id_type'=>$product['id_type'], 'image'=>$product['image']),
						);
					$this->obj->cart->insert($data);
				}
			}
			$this->_Header();
		}
		
		function _Header(){
			$url=$_SERVER['HTTP_REFERER'];
			if(strpos($url, base_url())==0){
				header('location:'.$url);
				exit;
			}else{
				header('location:'.base_url());
				exit;
			}
		}
	}
?>