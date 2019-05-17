<td width="300"><?=$country['country_title']?></td><td width="300"><form action="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/sua/<?=$country['country_code']?>" method="post" accept-charset="utf-8"><input type="text" name="country_title" value="<?=$country['country_title']?>"><input type="submit" name="ok" value="Sửa" style="width:50px"></form></td><td width="150"><a id="delete" href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/xoa/<?=$country['country_code']?>">Xoá</a></td>

    <script language="javascript">
		$('form').submit(function(){
			var obj=$(this);
			url=$(this).attr('action')+'/ajax';
			title=$(this).find('input[name="country_title"]').val();
			$.post(url, { country_title: title }, function(data){
				obj.parent().parent().html(data);
			});
			return false;
		});
	</script>