<?php
$arrMenu = array(
	array(
		'Thông tin chuyến bay',
		'Thông tin quốc gia_$_'.base_url().'admin/country',
		'Thông tin sân bay_$_'.base_url().'admin/airport',
		'Thông tin hãng bay_$_'.base_url().'admin/airlines',
		'Thông tin lịch bay_$_'.base_url().'admin/schedule',
	),
	array(
		'Thông tin đặt vé',
		'Thông tin tìm kiếm_$_'.base_url().'admin/search',
		'Thông tin đặt vé_$_'.base_url().'admin/book',
	),
	array(
		'Danh mục tin tức',
		'Tuyển dụng_$_'.base_url().'admin/recruitment',
		'Tin Tức_$_'.base_url().'admin/news',
		'Câu hỏi thường gặp_$_'.base_url().'admin/ask',
		'Báo chí nói về chúng tôi_$_'.base_url().'admin/press',
	),
	array(
		'Danh mục chi tiết',
		//'Báo chí nói về chúng tôi_$_'.base_url().'admin/press',
		'Giới thiệu_$_'.base_url().'admin/introduction',
		'Liên hệ_$_'.base_url().'admin/contact',
		'Hướng dẫn thanh toán_$_'.base_url().'admin/huong-dan-thanh-toan',
		'Thông tin chuyển khoản_$_'.base_url().'admin/thong-tin-chuyen-khoan',
		'Hướng dẫn đặt vé_$_'.base_url().'admin/huong-dan-dat-ve',
	),
	array(
		'Danh mục hiển thị',
		'Thông tin tư vấn_$_'.base_url().'admin/advice',
		'Nhận xét của khách hàng_$_'.base_url().'admin/customer',
		'Hỗ trợ trực tuyến_$_'.base_url().'admin/yahoo',
		'Banner_$_'.base_url().'admin/banner',
		'Footer chi nhánh Hà Nội_$_'.base_url().'admin/footer-ha-noi',
		'Footer chi nhánh tp.HCM_$_'.base_url().'admin/footer-tp-hcm',
		'Bản đồ_$_'.base_url().'admin/maps',
	),
	array(
		'System',
		'Thông tin liên hệ_$_'.base_url().'admin/contact_infomation',
		'Keywords_$_'.base_url().'admin/keywords',
		'Change password_$_'.base_url().'admin/changepass',
		'Log out_$_'.base_url().'admin/logout',
	),
);

for($i=0;$i<count($arrMenu);$i++){
	print <<<EOF
    	<div class="item">
        	<div class="title">
            	{$arrMenu[$i][0]}
            </div>
            <ul>
EOF;
	for($j=1;$j<count($arrMenu[$i]);$j++){
		$arr = explode('_$_',$arrMenu[$i][$j]);
		if($arr[1]!=base_url().'admin/'.$this->uri->segment(2)){
				print "<li>&nbsp;&nbsp;&nbsp;<a href=\"{$arr[1]}\" style=\"text-decoration:none;\">{$arr[0]}</a></li>";
		}else{
				print "<li>&nbsp;&nbsp;&nbsp;<a href=\"{$arr[1]}\" style=\"text-decoration:none;\"><font color=\"#CC0000\">{$arr[0]}</font></a></li>";
		}
	}
    print '</ul>
		</div>';
}?>