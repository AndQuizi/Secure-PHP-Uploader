<?php
require_once('package_fns.php');
do_html_header('Confirm Secret Phrase');
session_start();

$down_me = @$_POST['down_me'];
$user = $_SESSION['valid_user'];
if(!filled_out(@$HTTP_POST_VARS)){
  echo 'You have not chosen any files to download.
  Please try again.';
  display_user_menu();
  do_html_footer();  
  exit;
}
else if(count($down_me) >0){
  
  $_SESSION['down_me_post'] = $down_me;

  foreach($down_me as $file)
  {
    $hint = getHint($user,$file);
  }
  
  display_enter_hash_form3($hint);
  display_user_menu();
  do_html_footer();
  
}
else{
  echo 'No files selected for download';
  display_user_menu();
  do_html_footer();
}

?>
