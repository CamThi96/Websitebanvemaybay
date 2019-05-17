<div class="item">
	<div class="title">
    	Thêm Sân Bay
    </div>
    <?php
	echo form_open(base_url().$this->uri->uri_string());
		$this->table->add_row(array('data'=>'Mã Sân Bay', 'width'=>150), array('data'=>form_input('airport_code'), 'width'=>650));
		$this->table->add_row('Tên Sân Bay', form_input('airport_title'));
		$this->table->add_row('Thuộc Quốc Gia', form_input('country_name'));
		$this->table->add_row(array('data'=>form_submit('ok', 'Thêm', 'style="width:150px"'), 'colspan'=>2, 'style'=>'text-align:center'));
		echo $this->table->generate();
	echo form_close();
	?>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/style/css/jquery.autocomplete.css">
    <script language="javascript" src="<?=base_url()?>public/style/js/jquery.autocomplete.js"></script>
    <script>
		$(document).ready(function () {
    // Set auto complete
    $('input[name="country_name"]').autocomplete("<?=base_url()?>search_country",
        {
            max: 50,
            highlight: false,
            matchSubset: false,
            scrollHeight: 260,
            width: 261,
            formatItem: function (item, index, total, value) {
                return value.split("{")[0];
            },
            formatResult: function (item, value) {
                return value.split("{")[1];
            }
        });
		$('input[name="country_name"]').result(function () {
		});
	});
	</script>
</div>