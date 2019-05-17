<div class="item">
	<div class="title">
    	Danh Sách Thông Tin Liên Hệ
   	</div>
    <?php
		$this->table->add_row(array('data'=>'Họ Tên', 'width'=>100), array('data'=>'Địa Chỉ', 'width'=>100), array('data'=>'Điện Thoại', 'width'=>50), array('data'=>'Email', 'width'=>100), array('data'=>'Nội Dung', 'width'=>250), array('data'=>'Xử Lý', 'width'=>40));
		foreach($contact as $val){
			$a='<a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a>';
			$this->table->add_row($val['name'], $val['address'], $val['phone'], $val['email'], $val['content'], $a);
		}
		echo $this->table->generate();
	?>
</div>