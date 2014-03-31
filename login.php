<?php
require_once('package_fns.php');
session_start();

do_html_header('');

display_site_info(); 

if(check_valid_user_boolean()){
	echo "You are already Logged in!";
	display_user_menu();
}
else {
	
	display_login_form();
}


do_html_footer();
?>