<div class="item">
	<div class="title">
    	Thông Tin Đặt Vé
    </div>
    <?php
		echo $this->pagination->create_links();
		$this->table->add_row(array('data'=>'Mã Đơn Hàng', 'width'=>100), array('data'=>'Bay Đi', 'width'=>100), array('data'=>'Bay Về', 'width'=>100), array('data'=>'Ngày Đi', 'width'=>100), array('data'=>'Ngày Về', 'width'=>100), array('data'=>'Tình Trạng', 'width'=>100), array('data'=>'Xử Lý', 'width'=>100));
		foreach($dat_ve as $val){
			//print_r($val);
			$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xem/'.$val['id'].'">Xem</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a>';
			$bay_di='<a href="'.base_url().$this->uri->segment(1).'/schedule/sua/'.$val['ma_chuyen_bay_di'].'">'.$val['ma_chuyen_bay_di'].'</a>';
			$bay_ve='<a href="'.base_url().$this->uri->segment(1).'/schedule/sua/'.$val['ma_chuyen_bay_ve'].'">'.$val['ma_chuyen_bay_ve'].'</a>';
			($val['status']!=1)?$tinh_trang='<span style="color:#FF0">Chưa Xem</span>':$tinh_trang='Đã Xem';
			$this->table->add_row($val['id'], $bay_di, $bay_ve, $val['ngay_di'], $val['ngay_ve'], $tinh_trang, $a);
		}
		echo $this->table->generate();
	?>
</div>