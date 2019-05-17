<div class="item">
	<div class="title">
    	Danh Sách <?=$title?>
    </div>
    <?php
		$this->table->add_row(array('data'=>'Tiêu Đề', 'width'=>600), array('data'=>'Xử Lý', 'width'=>100));
			foreach($news as $val){
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a>';
				$this->table->add_row($val['title_vi'].'  '.$val['title_en'], $a);
			}
		$this->table->add_row(array('data'=>'<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/them/">Thêm</a>', 'colspan'=>2, 'style'=>'text-align:center'));
		print $this->table->generate();
		echo $this->pagination->create_links();
	?>
</div>