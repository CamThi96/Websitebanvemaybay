<div class="item">
	<div class="title">
    	Danh Mục Sản Phẩm
    </div>
    <?php
		$this->table->add_row(array('data'=>'Danh Mục', 'width'=>500), array('data'=>'Xử Lý', 'width'=>200));
		foreach($main as $val){
			$a='<a href="'.base_url().$this->uri->uri_string().'/sua/'.$val['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->uri_string().'/xoa/'.$val['id'].'">Xoá</a>';
			$this->table->add_row($val['title_vi'].'  '.$val['title_en'], $a);
			foreach($sub[$val['id']] as $valsub){
				$a='<a href="'.base_url().$this->uri->uri_string().'/sua/'.$valsub['id'].'">Sửa</a> | <a href="'.base_url().$this->uri->uri_string().'/xoa/'.$valsub['id'].'">Xoá</a>';
				$this->table->add_row('&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'.$valsub['title_vi'].'  '.$valsub['title_en'], $a);
			}
		}
		$them='<a href="'.base_url().$this->uri->uri_string().'/them/">Thêm</a>';
		$this->table->add_row(array('data'=>$them, 'colspan'=>2, 'style'=>'text-align:center'));
		print $this->table->generate();
	?>
</div>