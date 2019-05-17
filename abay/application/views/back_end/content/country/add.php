<div class="item">
	<div class="title">
    	Thêm Quốc Gia
    </div>
    <?php
	echo form_open(base_url(). $this->uri->uri_string());
		$this->table->add_row(array('data'=>'Tên Quốc Gia', 'width'=>150), array('data'=>form_input('country_title'), 'width'=>600));
		$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2));
		echo $this->table->generate();
	echo form_close();
	?>
</div>