<div class="item">
	<div class="title">
    	Bản Đồ
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>form_upload('user_file'), 'width'=>500), array('data'=>form_submit('ok', 'Sửa', 'style="width:100px"'), 'width'=>200));
			$img='<img src="'.base_url().'public/uploads/images/thumbs/'.$maps['image'].'">';
			print $img;
			echo $this->table->generate();
		echo form_close();
	?>
</div>