<div class="item">
	<div class="title">
    	Sửa Yahoo
    </div>
    <?php
		echo form_open();
			$this->table->add_row(array('data'=>'Yahoo', 'width'=>200), array('data'=>form_input('yahoo', $yahoo), 'width'=>500));
			$this->table->add_row('Tiêu Đề', form_input('title', $title));
			$this->table->add_row(array('data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			echo $this->table->generate();
		echo form_close();
	?>
</div>