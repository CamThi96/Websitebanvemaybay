<div class="item">
	<div class="title">
		Sửa Thông Tin Sân Bay   
    </div>
    <?php
	echo form_open(base_url().$this->uri->uri_string());
		$this->table->add_row(array('data'=>'Mã Sân Bay', 'width'=>150), array('data'=>form_input('airport_code', $airport['airport_code']), 'width'=>600));
		$this->table->add_row('Tên Sân Bay', form_input('airport_name', $airport['airport_name']));
		$this->table->add_row('Thuộc Nước', '<select style="display:none" id="search_country"></select>'.form_input('country_code', $country['country_code']));
		$this->table->add_row(array('data'=>form_submit('ok', 'Sửa', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
		echo $this->table->generate();
	echo form_close();
	?>
    <script language="javascript">
		url_search="<?=base_url()?><?=$this->uri->segment(1)?>/country/search_country";
		$(document).ready(function(e) {
            $('option[id="search_country"]').parent().css('position','relative');
        });
		$('input[name="country_code"]').keypress(function(){
			var obj=$(this);
			obj.parent().css('position','relative');
			obj.parent().find('select').addClass('option_select').bind('click',function(){
				return false;
			}).bind('dblclick',function(){
				obj.val($(this).val());
				$(this).removeClass();
			}).bind('change',function(){
				obj.val($(this).val());
				$(this).removeClass();
			});
			$.post(url_search, { str:obj.val() },function(data){
				obj.parent().find('select').html(data);
			});
		});
	</script>
    <style>
		.option_select{
			display:block !important;
			width:445px;
			height:25px;
			z-index:9999;
			position:absolute;
			top:29px;
			left:5px;
		}
	</style>
</div>