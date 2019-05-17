<div class="item">
	<div class="title">
    	Thông Tin Các Đơn Hàng
    </div>
    <?php
		$this->table->add_row(array(
			'data'		=>	'Tên Khách Hàng',
			'width'		=>	170,
		), array(
			'data'		=>	'Địa Chỉ',
			'width'		=>	280,
		), array(
			'data'		=>	'Điện Thoại',
			'width'		=>	80
		), array(
			'data'		=>	'Email',
			'width'		=>	120,
		),array(
			'data'		=>	'Xử Lý',
			'width'		=>	100
		));
		foreach($orders as $val){
			$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xem/'.$val['id_orders'].'">Chi Tiết</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id_orders'].'">Xoá</a>';
			$this->table->add_row($val['name'], $val['address'], $val['phone'], $val['email'], $a);
		}
		echo $this->table->generate();
	?>
</div>