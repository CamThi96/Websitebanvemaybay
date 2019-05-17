<div class="item">
	<div class="title">
    	Sửa Quảng Cáo
    </div>
    <?php
		echo form_open_multipart();
			$this->table->add_row(array('data'=>form_upload('user_file'), 'width'=>500, 'colspan'=>2));//, array('data'=>form_submit('ok', 'Thêm', 'style="width:100px"'), 'width'=>200));
			$this->table->add_row(array('data'=>'Liên Kết', 'width'=>300),array( 'data'=>form_input('link', $status), 'width'=>500));
			$this->table->add_row(array('colspan'=>2, 'data'=>form_submit('ok', 'Sửa', 'style="width:100px"')));
			echo $this->table->generate();
		echo form_close();
	?>
</div>