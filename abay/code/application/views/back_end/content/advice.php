<div class="item">
	<div class="title">
    	Thông tin tư vấn
    </div>
    <?php
	echo $this->pagination->create_links();
		$this->table->add_row(array('data'=>'Tên', 'width'=>140), array('data'=>'Email', 'width'=>80), array('data'=>'Số điện thoại', 'width'=>70), array('data'=>'Câu hỏi', 'width'=>300)/*, array('data'=>'Tình trạng','width'=>70)*/ , array('data'=>'Xử lý', 'width'=>70));
		foreach($advice as $val){
			$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['id'].'">Xoá</a>';
			//($val['status']==1)?$status='Đã xem':$status='<span style="color:yellow">Chưa xem</span>';
			$this->table->add_row($val['name'], $val['email'], $val['phone'], $val['question'], $a);
		}
		echo $this->table->generate();
	?>
</div>