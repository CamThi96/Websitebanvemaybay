<div class="item">
	<div class="title">
    	Danh Sách Hình Quảng Cáo
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>form_upload('user_file'), 'width'=>500, 'colspan'=>2));//, array('data'=>form_submit('ok', 'Thêm', 'style="width:100px"'), 'width'=>200));
			$this->table->add_row(array('data'=>'Liên Kết', 'width'=>300),array( 'data'=>form_input('link'), 'width'=>500));
			$this->table->add_row(array('colspan'=>2, 'data'=>form_submit('ok', 'Thêm', 'style="width:100px"')));
			foreach($images as $val){
				$img='<img src="'.base_url().'public/uploads/ads/'.$val['image'].'">';
				$a='<a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a> | <a href="'.base_url().$this->uri->uri_string().'/sua/'.$val['id'].'">Sửa</a>';
				$this->table->add_row($img, $a);
			}
			echo $this->table->generate();
		echo form_close();
	?>
</div>