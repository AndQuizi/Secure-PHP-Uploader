  <?php
  require_once('package_fns.php');
  session_start();
  
    //create short variable names
   // $del_me = @$_POST['del_me'];
  $del_me =$_SESSION['del_me_post'];
  unset($_SESSION['del_me_post']);


  $phrase = @$_POST['phrase'];
  $user = $_SESSION['valid_user'];

  if($phrase){
    if (count($del_me) >0)
    {
      foreach($del_me as $file)
      {
        $tmpFile = $file; 
      }
    }

    $plainKey = decrypt_key($user, $phrase,$file);

    


    $valid_user = @$HTTP_SESSION_VARS['valid_user'];
    if(strstr($plainKey, " ")){
      do_html_header('Deleting Files');
      check_valid_user();

      if (count($del_me) >0)
      {
        foreach($del_me as $file)
        {
          if (delete_file($_SESSION['valid_user'], $file))
            echo 'Deleted '.$file.'.<br />';
          else
            echo 'Could not delete '.$file.'.<br />';
        }  
      }
      else
        echo 'No files selected for deletion';
      
    // get the bookmarks this user has saved
      if ($file_array = get_user_files($valid_user))
        display_user_files($file_array);
    }
    else{
     do_html_header('Problem:');
     echo "Incorrect phrase. Please try again.";
   }
 }
 else{
  do_html_header('Problem:');
  echo "Incorrect phrase. Please try again.";
}
display_user_menu(); 
do_html_footer();
?>
