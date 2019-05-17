<div class="item">
	<div class="title">
    	Thông Tin Chi Tiết Đơn Hàng
    </div>
    <?php
		$this->table->add_row(array('data'=>'Tên Khách Hàng', 'width'=>200), array('data'=>$orders['name'], 'width'=>500));
		$this->table->add_row('Địa Chỉ', $orders['address']);
		$this->table->add_row('Điện Thoại', $orders['phone']);
		$this->table->add_row('Email', $orders['email']);
		$this->table->add_row('Ngày Đặt Hàng', $orders['date']);
		$this->table->add_row('Giờ Đặt Hàng', $orders['time']);
		echo $this->table->generate();
		print '<br>';
		$this->table->add_row(
			array('data'=>'Tên Sản Phẩm', 'width'=>400,),
			array('data'=>'Đơn Giá', 'width'=>100,),
			array('data'=>'Số Lượng', 'width'=>100,),
			array('data'=>'Thành Tiền', 'width'=>100,)
			);
		$total=0;
		foreach($list_product as $val){
			$name='<a target="_blank" href="'.base_url().'san-pham/'.$val['id_type'].'/'.$val['id_product'].'">'.$val['title'].'</a>';
			$this->table->add_row($name, $val['price'], $val['number'], $val['price']*$val['number']);
			$total+=$val['price']*$val['number'];
		}
		$this->table->add_row(array('data'=>'Tổng Tiền:', 'colspan'=>2), array('data'=>number_format($total), 'colspan'=>2));
		echo $this->table->generate();
	?>
</div>