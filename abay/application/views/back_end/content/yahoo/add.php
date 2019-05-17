<div class="item">
	<div class="title">
    	Thêm Yahoo
    </div>
    <?php
		echo form_open();
			$this->table->add_row(array('data'=>'Yahoo', 'width'=>200), array('data'=>form_input('yahoo'), 'width'=>500));
			$this->table->add_row('Tiêu Đề', form_input('title'));
			$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			echo $this->table->generate();
		echo form_close();
	?>
</div>