<?php
require_once('package_fns.php');
do_html_header('Confirm Secret Phrase');
session_start();

$del_me = @$_POST['del_me'];
$user = $_SESSION['valid_user'];
if(!filled_out(@$HTTP_POST_VARS)){
  echo 'You have not chosen any files to delete.
  Please try again.';
  display_user_menu();
  do_html_footer();  
  exit;
}
else if(count($del_me) >0){
  
  $_SESSION['del_me_post'] = $del_me;

  foreach($del_me as $file)
  {
    $hint = getHint($user,$file);
  }  

  display_enter_hash_form2($hint);
  display_user_menu();

  do_html_footer();
  
}
else{
  echo 'No files selected for deletion';
  display_user_menu();
  do_html_footer();
}

?>
