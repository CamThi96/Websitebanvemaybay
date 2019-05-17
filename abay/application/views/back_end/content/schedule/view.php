<div class="item">
	<div class="title">
    	Danh Sách Lịch Bay
    </div>
    <?php
		echo $this->pagination->create_links();
			$this->table->add_row(array('data'=>'Mã Chuyến Bay', 'width'=>150), array('data'=>'Nơi Đi', 'width'=>200), array('data'=>'Nơi Đến', 'width'=>200), array('data'=>'Xử Lý', 'width'=>100));
			foreach($schedule as $val){
				//print_r($val);
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['ma_chuyen_bay'].'">Sửa</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['ma_chuyen_bay'].'">Xoá</a>';
				$this->table->add_row($val['ma_chuyen_bay'], $val['airport_code_go'], $val['airport_code_to'], $a);
			}
			$this->table->add_row(array('data'=>'<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/them/">Thêm</a>', 'colspan'=>4, 'style'=>'text-align:center'));
		echo $this->table->generate();
	?>
</div>