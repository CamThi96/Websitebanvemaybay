<?php
/*
* Người viết: Lê Bằng
* Email: sincos.net@gmail.com
* Đây là class session có thể lựa chọn kiểu lưu trữ session
* Thông tin và thiết lập xem trong file config.php
*/
$CI = & get_instance();
if($CI->config->item('sess_mode') == "PHP")//Trường hợp dc config dùng session chuẩn của PHP
{
    class MY_session
    {
        function MY_session()
        {
            @session_start();
        }
        function userdata($name)
        {
            if($name == "session_id")
                return session_id();
            else
            {
                return isset($_SESSION[$name])?$_SESSION[$name]:'';
            }
        }
        function set_userdata($name, $value)
        {
            $_SESSION[$name]= $value;
        }
        function unset_userdata($name)
        {
            $_SESSION[$name] = '';
			unset($_SESSION[$name]);
        }
    }
    
}
else//Trường hợp dc config dùng session chuẩn của CI
{
    class MY_session extends CI_session
    {
        function MY_session()
        {
            parent::CI_Session();
        }
    }
}
?>