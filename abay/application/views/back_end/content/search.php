<div class="item">
	<div class="title">
    	Danh Sách Tìm Kiếm Chuyến Bay
    </div>
    <?php
		echo $this->pagination->create_links();
		$this->table->add_row(array('data'=>'Nơi đi', 'width'=>130), array('data'=>'Nơi đến', 'width'=>130), array('data'=>'Ngày đi', 'width'=>130), array('data'=>'Ngày về', 'width'=>130), array('data'=>'Xử lý', 'width'=>130));
		foreach($tim_kiem as $val){
			$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a>';
			$this->table->add_row($val['diem_di'], $val['diem_den'], $val['ngay_di'], $val['ngay_ve'], $a);
		}
		echo $this->table->generate();
	?>
</div>