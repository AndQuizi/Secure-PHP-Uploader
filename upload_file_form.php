<?php
// include function files for this application
require_once('package_fns.php');
session_start();

// start output html
do_html_header('Uplaod File');
check_valid_user();

echo "</br>";
echo "Accepts only gif, jpeg, jpg, png, and txt files.";
echo "</br>";
echo "Max file size is 1MB.";
echo "</br>";
display_upload_file_form();

display_user_menu();
do_html_footer();

?>
