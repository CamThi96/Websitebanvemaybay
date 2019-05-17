<?php
	require_once('home_default.php');
	class Home_Orders_View extends Home_Default{
		function __Construct(){
			parent::__Construct();
			parent::_Add_Title('Xem Đơn Hàng');
		}
		
		function index(){
			if($_POST){
				$id=strip_tags($this->input->post('orders_code'));
				$this->db->where('id', $id);
				$data=$this->db->get('dat_ve')->result_array();
				if(count($data)==0){
					$data['log']='Mã đơn hàng không tồn tại!';
				}else{
					header('location:'.base_url().'thong-tin-don-hang/'.$id);
					exit;
				}
			}
			parent::_Set_Default_Right();
			
			parent::_Set_Default_Left($this->my_layout->input('front_end/content/orders_view', $data));
			
			parent::_set_Default_Nav();
			$this->my_layout->output();
		}
	}
?>