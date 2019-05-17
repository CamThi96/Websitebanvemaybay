<div class="item">
	<div class="title">
    	Danh Sách Các Hãng Hàng Không
    </div>
    <?php
	echo $this->pagination->create_links();
		$this->table->add_row(array('data'=>'Hãng', 'width'=>300), array('data'=>'Hình đại diện', 'width'=>300), array('data'=>'Xử lý', 'width'=>100));
			foreach($airlines as $val){
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a> ';
				$img='<img src="'.base_url().'/public/uploads/logos/'.$val['image'].'">';
				$this->table->add_row($val['title'], $img, $a);
			}
		$this->table->add_row(array('colspan'=>3, 'data'=>'<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/them/">Thêm</a>', 'style'=>'text-align:center'));
		echo $this->table->generate();
	?>
</div>