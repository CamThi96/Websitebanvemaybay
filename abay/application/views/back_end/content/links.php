<div class="item">
	<div class="title">
    	Liên kết website
    </div>
    <?php
		echo form_open(base_url().$this->uri->uri_string());
			$this->table->add_row(array('data'=>'Liên kết', 'width'=>150), array('data'=>form_input('link'), 'width'=>650));
			$this->table->add_row('Tiêu đề', form_input('title_vi'));
			$this->table->add_row(array('colspan'=>2, 'data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'style'=>'text-align:center'));
			echo $this->table->generate();
		echo form_close();
	?>
    <br />
    <?php
		$this->table->add_row(array('data'=>'Liên kết', 'width'=>500), array('data'=>'Xử lý', 'width'=>200));
		foreach($links as $val){
			$a='<a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a>';
			$this->table->add_row($val['link'].' - '.$val['title_vi'], $a);
		}
		echo $this->table->generate();
	?>
</div>