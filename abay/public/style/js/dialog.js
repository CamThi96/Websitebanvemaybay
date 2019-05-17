
    function isEmpty(obj) {
        if (typeof obj == 'undefined' || obj === null || obj === '') return true;
        if (typeof obj == 'number' && isNaN(obj)) return true;
        if (obj instanceof Date && isNaN(Number(obj))) return true;
        return false;
    }
    $(document).ready(function () {
        /*if ($('.one-wave-new input:checked').length > 0)
            $(".enddate").hide();

        $(".one-wave-new input").click(function () {
            $(".enddate").hide();
        });
        $(".round-trip-new input").click(function () {
            $(".enddate").show();
        });

        minDate = new Date();
        maxDate = null;
        $(".startdate").datepicker({
            minDate: minDate,
            numberOfMonths: 2,
            onClose: function () {
                $('#book-form input').removeClass('focus-input');
                $('.endplace').removeClass('choosen');
            }
        });

        $('.startdate').change(function () {
            var d = $(".startdate").datepicker("getDate");
            $(".enddate").datepicker("option", "minDate", $(".startdate").datepicker("getDate"));
            d.setDate(d.getDate() + 3);
            $(".enddate").datepicker("setDate", d);
            $(this).datepicker('hide');
            if ($('.round-trip-new input[type=radio]:checked').length > 0)
                $(".enddate").focus();
        });

        $(".enddate").datepicker({
            minDate: minDate,
            numberOfMonths: 2,
            onClose: function () {
                $('#book-form input').removeClass('focus-input');
                $('.endplace').removeClass('choosen');
            }
        });

        // enable/disable return date if roundtrip/oneway
        if ($("#ContentPlaceHolderMainColumn_UsrSearchForm1_radioOneWay").attr("checked") == "checked") {
            $(".enddate").addClass('disabled');
            $(".enddate").attr("disabled", "disabled");
            $(".enddate").datepicker('disable');
        }
        $('#ContentPlaceHolderMainColumn_UsrSearchForm1_radioOneWay').click(function () {
            $(".enddate").addClass('disabled');
            $(".enddate").attr("disabled", "disabled");
            $(".enddate").datepicker('disable');
        });
        $('#ContentPlaceHolderMainColumn_UsrSearchForm1_radioRoundTrip').click(function () {
            $(".enddate").removeClass('disabled');
            $(".enddate").removeAttr("disabled");
            $(".enddate").datepicker('enable');
        });
        // hide all window when click one
        $(".startplace").click(function () {
            $('#list-arrival').dialog("close");
            $(".startdate").datepicker('hide');
            $(".enddate").datepicker('hide');
        });
        $(".endplace").click(function () {
            $('#list-departure').dialog("close");
            $(".startdate").datepicker('hide');
            $(".enddate").datepicker('hide');
        });

        $('.startdate,.enddate').focus(function () {
            $('.dialog').dialog("close");
            $('#book-form input').removeClass('focus-input');
            if ($(this).hasClass('disabled')) {
                $(this).removeClass('focus-input');
            }
            else
                $(this).addClass('focus-input');
        });

        $('.select-op select,.select-op-lastItem select,.cbo-return-day').each(function (index, value) {
            if ($(this).val() > 0) $(this).addClass('focus-input');
        });
        $('.select-op select,.select-op-lastItem select,.cbo-return-day').change(function () {
            if ($(this).val() > 0) $(this).addClass('focus-input');
            else $(this).removeClass('focus-input');
        });

        $('.startplace,.endplace').each(function (index, value) {
            if ($(this).val() != '') $(this).addClass('focus-input');
        });

        $('.cbo-return-month').each(function (index, value) {
            if ($(this).val() != '0') $(this).addClass('focus-input');
        });
        $('.cbo-return-month').change(function () {
            if ($(this).val() != '0') $(this).addClass('focus-input');
            else $(this).removeClass('focus-input');
        });
        // Select waytype hightlight
        $('.waytype').click(function () {
            $('.waytype-l').removeClass('selected');
            $(this).next().addClass('selected');
        });
        $('input.waytype:checked').each(function (index, value) {
            $(this).next().addClass('selected');
        });


        //*/
		 $(".startplace").click(function (event) {
            $('#list-arrival').dialog("close");
			event.stopPropagation();
			//return false;
            //$(".startdate").datepicker('hide');
            //$(".enddate").datepicker('hide');
        });
        $(".endplace").click(function (event) {
            $('#list-departure').dialog("close");
			event.stopPropagation();
			//return false;
            //$(".startdate").datepicker('hide');
            //$(".enddate").datepicker('hide');
        });
        $(".startplace,.endplace").focus(function () {
            //alert('sfs');

            //$(this).addClass('focus-input');
            dateType = $(this).attr('datetype');
            var deOffset = $('.startplace').offset();
            var arrOffset = $('.endplace').offset();
            var inputHeight = $('.endplace').height() + 15 - $(window).scrollTop();
            $("#list-departure").dialog({
                autoOpen: false,
                width: 580,
                //modal: true,
                position: [deOffset.left, deOffset.top + inputHeight]
            });
            $("#list-arrival").dialog({
                autoOpen: false,
                width: 580,
               	//modal: true,
                position: [arrOffset.left, deOffset.top + inputHeight]
            });
            // $("#inter-city-" + dateType).focus();
            $("#list-" + dateType).dialog("open");
            if ($("#list-departure").dialog("isOpen")) {
                $("#inter-city-departure").focus();
            }
            if ($("#list-arrival").dialog("isOpen")) {
                $("#inter-city-arrival").focus();
            }
            var interCityInput = '';
            $("#inter-city-" + dateType).keyup(function () {
                interCityInput = $(this).val();
            });
            var depCity = $('.startplace').val();
            var arrCity = $('.endplace').val();
            if (isEmpty(interCityInput)) {
                $("#submit-departure").click(function () {
                    var val = $("#inter-city-departure").val().trim();
                    if (val == '') {
                        $('.error-departure').text('Xin hãy nhập tên thành phố hoặc sân bay để tiếp tục.');
                        $("#inter-city-departure").val(val);
                        return;
                    }
                    $('.error-departure').text(' ');
                    $('.startplace').attr('value', val);
                    $('.dialog').dialog("close");
                    if ($('.endplace').hasClass('choosen'))
                        $(".startdate").focus();
                    else
                        $('.endplace').focus();
                });
                $("#submit-arrival").click(function () {
                    var val = $("#inter-city-arrival").val().trim();
                    if (val == '') {
                        $('.error-arrival').text('Xin hãy nhập tên thành phố hoặc sân bay để tiếp tục.');
                        $("#inter-city-arrival").val(val);
                        return;
                    }
                    $('.error-arrival').text(' ');
                    $('.endplace').addClass('choosen');
                    $('.endplace').attr('value', val);
                    $('.dialog').dialog("close");
                    if (isEmpty(depCity))
                        $('.startplace').focus();
                    else {
                        $('.dialog').dialog("close");
                        $(".startdate").focus();
                    }
                });
            }
            // close dialog when click outside dialog
            $('body').click(function () {
                $('.dialog').dialog("close");
            });
            $('#book-form input, .dialog').click(function (event) {
                event.stopPropagation();
            });
            $('.ui-widget-overlay').live('click', function () {
                $('#book-form input').removeClass('focus-input');
                $('.dialog').dialog("close");
            });
            // get data from dialog when click
            $('#list-departure a').click(function () {
               //$('.startplace').attr('value', $(this).value());
                $('.startplace').attr('value', $(this).text());
                $('#list-departure').dialog("close");
                if ($('.endplace').hasClass('choosen') && !isEmpty(arrCity)) {
                    $(".startdate").focus();
                }
                else
                    $(".endplace").focus();
                return false;
            });
            $('.startplace').focus(function () {
                $("#inter-city-departure").focus();
            });
            $('.endplace').focus(function () {
                $("#inter-city-arrival").focus();
            });
            $('#list-arrival a').click(function () {
                $('.endplace').addClass('choosen');
                $('.endplace').attr('value', $(this).text());
                $('#list-arrival').dialog("close");
                if (isEmpty(depCity))
                    $('.startplace').focus();
                else {
                    $('.dialog').dialog("close");
                    $(".startdate").focus();
                }
                return false;
            });
        });

    });
          