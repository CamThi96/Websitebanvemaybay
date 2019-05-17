
		$(document).ready(function() {
			var monthNames = [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ]; 
			var dayNames= ["Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy"]
			var newDate = new Date();
			// Extract the current date from Date object
			newDate.setDate(newDate.getDate());
			
			$('#tvo_date').html(dayNames[newDate.getDay()] + " Ngày " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' Năm ' + newDate.getFullYear());
			
			
			var giay=new Date().getSeconds();
			var gio=new Date().getHours();
			var phut=new Date().getMinutes();
			var thoidiem='Sáng';

			if (gio>12){
				gio-=12;
				thoidiem='Chiều';
			}
			$("#tvo_seconds").html(giay + ' - ' + thoidiem);
			$("#tvo_minutes").html(phut);
			$("#tvo_hours").html(gio);
			setInterval(function(){
				giay++;
				if(giay==60){
					giay=0;
					phut++;
					if(phut==60){
						phut=0;
						gio++;
						if(gio==12){
							if(thoidiem=='Chiều'){
								gio=0;
								thoidiem='Sáng';
							}
						}
						if(gio==13){
							thoidiem='Chiều';
							gio=1;
						}
					}
				}
			$("#tvo_seconds").html(giay + ' - ' + thoidiem);
			$("#tvo_minutes").html(phut);
			$("#tvo_hours").html(gio);
			},1000);
		});