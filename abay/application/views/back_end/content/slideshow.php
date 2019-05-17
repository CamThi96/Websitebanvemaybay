<div class="item">
	<div class="title">
    	Danh Sách Hình Động
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>form_upload('user_file'), 'width'=>500), array('data'=>form_submit('ok', 'Thêm', 'style="width:100px"'), 'width'=>200));
			foreach($images as $val){
				$img='<img src="'.base_url().'public/uploads/slideshow/'.$val['image'].'">';
				$a='<a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a>';
				$this->table->add_row($img, $a);
			}
			echo $this->table->generate();
		echo form_close();
	?>
</div>