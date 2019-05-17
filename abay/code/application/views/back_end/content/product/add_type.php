<div class="item">
	<div class="title">
    	Thêm Danh Mục Sản Phẩm
    </div>
    <?php
		echo form_open(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Tên Danh Mục', 'width'=>200), array('data'=>form_input('title_vi'), 'width'=>550));
			//$this->table->add_row(array('data'=>'Tên Danh Mục Tiếng Anh', 'width'=>200), array('data'=>form_input('title_en'), 'width'=>550));
			$option['la-danh-muc-cha']='Là Danh Mục Cha';
			foreach($main as $val){
				$option[$val['id']]=$val['title_vi'];
			}
			$this->table->add_row('Thuộc Danh Mục',form_dropdown('main', $option));
			$this->table->add_row('Thứ Tự', form_input('order'));
			$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
			print $this->table->generate();
		echo form_close();
	?>
</div>