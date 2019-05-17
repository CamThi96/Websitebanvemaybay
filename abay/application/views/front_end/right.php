<div class="tvo_right_section">
	<div class="item">
    	<div class="title">
        	Tìm Kiếm
        </div>
        <div class="search_form">
        <form action="<?=base_url()?>tim-kiem" method="post">
        	<input type="radio" value="2" name="flightwaytype" class="sdb fl inp1" checked="checked"><span class="select label1 sdb fl" id="vl2">Khứ Hồi</span><input type="radio" value="1" name="flightwaytype" class="sdb fl inp1"><span class="label1 sdb fl" id="vl1">Một Chiều</span>
            <div class="clear"></div>
            <script language="javascript">
				$('input[name="flightwaytype"]').click(function(){
					value=$(this).val();
					$('span[id="vl1"]').removeClass('select');
					$('span[id="vl2"]').removeClass('select');
					$('span[id="vl'+value+'"]').addClass('select');
					if(value==1){
						$('input[name="date_back"]').attr('disabled', 'disabled').val('').animate({opacity:0.5},500);
					}else{
						$('input[name="date_back"]').removeAttr('disabled').animate({opacity:1},500);
					}
				});
			</script>
            
            <span class="label2">
            	Khởi hành từ
            </span>
            <input type="text" name="go" class="input1" />
            <span class="label2">
            	Đến
            </span>
            <input type="text" name="to" class="input1" />
            <script>
				$(document).ready(function () {
			// Set auto complete
				$('input[name="go"]').autocomplete("<?=base_url()?>search",
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
				$('input[name="go"]').result(function () {
				});
				
				$('input[name="to"]').autocomplete("<?=base_url()?>search",
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
				$('input[name="to"]').result(function () {
				});
				
							$( 'input[name="date_back"]' ).datepicker({ dateFormat: "dd-mm-yy" });
							$( 'input[name="date_go"]' ).datepicker({ dateFormat: "dd-mm-yy" });
							$( 'input[name="date_go"]' ).change(function(){
								var d = $(this).datepicker("getDate");
								$( 'input[name="date_back"]' ).datepicker("option", "minDate", $(this).datepicker("getDate"));
								d.setDate(d.getDate() + 3);
								$( 'input[name="date_back"]' ).datepicker("setDate", d);
							});
					});
		</script>
            <span class="label2 w50 fl">
            	Ngày xuất phát
            </span>
            <span class="label2 w50 fl">
            	Ngày xuất về
            </span>
            <div class="clear"></div>
            <input class="input1 w50 fl date" name="date_go" /><input class="input1 w50 fl date" type="text" name="date_back" />
            <div class="clear"></div>
            
            <span class="label2 w30 fl">
            	Người lớn
            </span>
            <span class="label2 w30 fl">
            	Trẻ em
            </span>
            <span class="label2 w30 fl">
            	Em bé
            </span>
            <div class="clear"></div>
            <select name="cboAdult" id="cboAdult" class="focus_input w30 fl">
                <option selected="selected" value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
			</select>
            <select name="cboChild" id="cboChild" class="focus_input w30 fl">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
			</select>
            <select name="cboInfant" id="cboInfant" class="focus_input w30 fl">
                <option selected="selected" value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
			</select>
            <div class="clear"></div>
            <input type="submit" value="Tìm chuyến bay" class="tvo_find">
            </form>
        </div>
        
        <div class="item">
        	<div style="text-align:center">
            	<img src="<?=base_url()?>public/style/img/logo-nganluong-ngang.png" style="margin:10px;" />
                <img src="<?=base_url()?>public/style/img/logo-soha.png" />
            </div>
        </div>
        
        <div class="item">
        	<div class="title">
            	Tôi Làm Thế Nào
            </div>
            <ul class="right_mnu">
            	<li><a href="<?=base_url()?>lien-he" title="Liên Hệ">Liên Hệ</a></li>
            	<li><a href="<?=base_url()?>thanh-toan" title="Thanh Toán">Thanh Toán</a></li>
            	<li><a href="<?=base_url()?>xem-don-hang" title="Xem Đơn Hàng">Xem Đơn Hàng</a></li>
            </ul>
            <script language="javascript">
				$(document).ready(function(e) {
                    $('ul.right_mnu li a').hover(function(){
						$(this).stop().animate({paddingLeft:30},300);
					},function(){
						$(this).stop().animate({paddingLeft:14},300);
					});
                });
			</script>
        </div>
    </div>
</div>