<div class="item">
	<div class="title">
    	Nhận xét của khách hàng
    </div>
    <?php
		$this->table->add_row(array('data'=>'Tên', 'width'=>150), array('data'=>'Số điện thoại','width'=>80), array('data'=>'Nhận xét', 'width'=>300), array('data'=>'Xử lý', 'width'=>150));
		foreach($customer as $val){
			if($val['status']==0){
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/1">Bật Hiển Thị</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/2">Hiển Thị Ở Trang Chủ</a>';
			}elseif($val['status']==1){
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/0">Tắt Hiển Thị</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/2">Hiển Thị Ở Trang Chủ</a>';
			}else{
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/0">Tắt Hiển Thị</a> | <a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/change/'.$val['id'].'/1">Tắt Hiển Thị Ở Trang Chủ</a>';
			}
			$this->table->add_row($val['name'], $val['phone'], $val['content'], $a);
		}
		echo $this->table->generate();
	?>
</div>