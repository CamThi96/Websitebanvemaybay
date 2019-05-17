<div class="item">
	<div class="title">
    	Yahoo Hỗ Trợ Trực Tuyến
    </div>
    <?php
		$this->table->add_row(array('data'=>'Yahoo', 'width'=>500), array('data'=>'Xử Lý', 'width'=>200));
			foreach($yahoo as $val){
				$a='<a href="'.base_url().$this->uri->uri_string().'/sua/'.$val['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a>';
				$this->table->add_row($val['yahoo'].' - '.$val['title'], $a);
			}
		$this->table->add_row(array('data'=>'<a href="'.base_url().$this->uri->uri_string().'/them">Thêm</a>', 'colspan'=>2, 'style'=>'text-align:center'));
		echo $this->table->generate();
	?>
</div>