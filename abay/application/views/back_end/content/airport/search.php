<?php
		$this->table->add_row(array('data'=>'Sân Bay', 'width'=>300), array('data'=>'Sửa', 'width'=>300), array('data'=>'Xử Lý', 'width'=>150));
			foreach($airport as $val){
				$a='<a href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['airport_code'].'">Sửa</a> | <a id="delete" href="'.base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/xoa/'.$val['airport_code'].'">Xoá</a>';
				$this->table->add_row($val['airport_name'], form_open(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sua/'.$val['airport_code']). 
									form_input('airport_name', $val['airport_name']). form_submit('ok', 'Sửa', 'style="width:50px"')
									.form_close(), $a);
			}
		echo $this->table->generate();
	?>
    
    <script language="javascript">
		$('form').submit(function(){
			var obj=$(this);
			url=$(this).attr('action')+'/ajax';
			name=$(this).find('input[name="airport_name"]').val();
			$.post(url, { airport_name: name }, function(data){
				obj.parent().parent().html(data);
			});
			return false;
		});
		$('a#delete').click(function(){
			var obj=$(this);
			$.get(obj.attr('href')+'/ajax',{ },function(){
				obj.parent().parent().html('');
			});
			return false;
		});
	</script>