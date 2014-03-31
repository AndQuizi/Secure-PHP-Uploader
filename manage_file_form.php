<?php
// include function files for this application
require_once('package_fns.php');
session_start();

// start output html
do_html_header('Manage Files');

check_valid_user();

if ($file_array = get_user_files($_SESSION['valid_user'])){
	display_user_filesDelete($file_array);
	display_user_filesDownload($file_array);
}

else
	echo"</br> You have no files.";
//display_user_files();

display_user_menu();
do_html_footer();

?>
