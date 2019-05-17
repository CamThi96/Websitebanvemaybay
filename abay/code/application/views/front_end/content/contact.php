<div class="tvo_left_section">
	<div style="padding:15px;">
    <div style="color:#143B85; font-size:20px; font-weight:bold; padding-bottom:20px;">Liên Hệ Với Chúng Tôi</div>
     <?=$content?>
     <div class="clear p5 mgb5"></div>
	<form method="post" action="<?=base_url()?>lien-he" class="cmxform" name="frmContact" id="frmContact" onsubmit="return contact_submit(this)">
            	<div style="color:#333"></div>
                        <ol>
                            <li><label for="name">Họ Và Tên <em>*</em></label> <input name="name" id="name" value="" size="30" onblur="if($.trim(this.value) == '') {alert('Chưa Nhập Tên')}"></li>
                            <li><label for="address">Địa Chỉ <em>*</em></label> <input name="address" id="address" value="" size="30" onblur="if($.trim(this.value) == '') {alert('Chưa Nhập Địa Chỉ')}"></li>
                            <li><label for="phone">Số Điện Thoại <em>*</em></label> <input name="phone" id="phone" value="" size="30" onblur="if(!isPhone(this.value)) alert('Nhập Sai Số Điện Thoại')"></li>
                            <li><label for="email">Email <em>*</em></label> <input name="email" id="email" size="30" value="" onblur="if(!isEmail(this.value)) {alert('Nhập Sai Email')}"></li>
                            <li><label for="comment">Nội Dung Liên Hệ</label> <textarea name="comment" id="comment" rows="8" cols="40" onblur="if($.trim(this.value) == '') {alert('Chưa Nhập Nội Dung')}"></textarea></li>
                        </ol>						
                    <p align="center"><input type="submit" name="submit" id="button" style="width:100px" value="   Send   "></p>
                </form>
                <div class="clear p5 mgb5"></div>
               
    </div>
</div>
<script type="text/javascript">
					function isEmail(sEmail)
					{
						var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9_\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						if (filter.test(sEmail))
							return true;
						else
							return false;
					}
					function isPhone(sEmail)
					{
						var filter  = /^([0-9_\.\-\(\)])+$/;
						if (filter.test(sEmail))
							return true;
						else
							return false;
					}
				</script>
                <style>
					form.cmxform legend { padding-left: 0; }

form.cmxform input{
	width:340px;
}

form.cmxform legend,
form.cmxform label { color: #333; }

form.cmxform fieldset {
	border: none;
	border-top: 1px solid #C9DCA6;
	background: url(../images/cmxform-fieldset.gif) left bottom repeat-x;
	}
	
form.cmxform fieldset fieldset { background: none; }
	
form.cmxform fieldset li {
	padding: 5px 10px 7px;
	background: url(../images/cmxform-divider.gif) left bottom repeat-x;
	}
form.cmxform fieldset { margin-bottom: 10px; }
	
form.cmxform legend {
	padding: 0 2px;
	font-weight: bold;
	_margin: 0 -7px; /* IE Win */
	}
	
form.cmxform label {
	display: inline-block;
	line-height: 1.8;
	vertical-align: top;
	}
	
form.cmxform fieldset ol {
	margin: 0;
	padding: 0;
	}
	
form.cmxform fieldset li {
	list-style: none;
	padding: 5px;
	margin: 0;
	}
	
form.cmxform fieldset fieldset {
	border: none;
	margin: 3px 0 0;
	}
	
form.cmxform fieldset fieldset legend {
	padding: 0 0 5px;
	font-weight: normal;
	}
	
form.cmxform fieldset fieldset label {
	display: block;
	width: auto;
	}

form.cmxform em {
	font-weight: bold;
	font-style: normal;
	color: #f00;
	}

form.cmxform label { width: 120px; } 
				</style>