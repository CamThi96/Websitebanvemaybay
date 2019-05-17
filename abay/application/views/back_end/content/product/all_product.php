<div class="item">
	<div class="title">
    	Danh Sách Sản Phẩm
    </div>
    <?php
		echo $this->pagination->create_links();
		$this->table->add_row(array('data'=>'<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/them/">Thêm</a>', 'colspan'=>5, 'style'=>'text-align:center'));
		$this->table->add_row(array('data'=>'Sản Phẩm', 'width'=>300), array('data'=>'Hình Ảnh', 'width'=>100), array('data'=>'Xử Lý', 'width'=>100), array('data'=>'Sản Phẩm Bán Chạy', 'width'=>100), array('data'=>'Sản Phẩm Hot', 'width'=>100));
			foreach($product as $val){
				//print_r($val);
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a>';
				$img='<img src="'.base_url().'public/uploads/products/'.$val['image'].'">';
				if(intval($val['status'])==1 ){
					$noibat='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/tat/'.$val['id'].'">Tắt</a>';
				}else{
					$noibat='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/bat/'.$val['id'].'">Hiển Thị</a>';
				}
				if(intval($val['permissions'])==1){
					$hot='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/tat_hot/'.$val['id'].'">Tắt</a>';
				}else{
					$hot='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/bat_hot/'.$val['id'].'">Hiển Thị</a>';
				}
				$this->table->add_row($val['title_vi'].'  '.$val['title_en'], $img, $a, $noibat, $hot);
			}
		echo $this->table->generate();
		echo $this->pagination->create_links();
	?>
</div>