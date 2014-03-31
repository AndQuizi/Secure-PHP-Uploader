<?php
require_once('package_fns.php');
session_start();

  //create short variable names
 // $del_me = @$_POST['del_me'];
$down_me =@$_SESSION['down_me_post'];
unset($_SESSION['down_me_post']);


$phrase = @$_POST['phrase'];
$user = $_SESSION['valid_user'];

if($phrase){
  if (count($down_me) >0)
  {
    foreach($down_me as $file)
    {
      $tmpFile = $file; 
    }
  }

  $plainKey = decrypt_key($user, $phrase,@$file);
  $IV = getIV($user,@$file);
  $valid_user = @$HTTP_SESSION_VARS['valid_user'];
  
  do_html_header('Download Files');
  check_valid_user();

  if (count($down_me) >0)
  {
    foreach($down_me as $file)
    {

      copy ("C:/dataFiles/".$user."/". $file,
        "C:/dataFiles/".$user."/tmp/". $file);

      $fileName2 = "C:/dataFiles/".$user."/tmp/". $file;
      $file_binary = fread(fopen($fileName2, "r"), 
        filesize($fileName2));

        //  $encoded_file =  base64_decode($file_binary);
      $decrypted_data = Encryption::decrypt2($file_binary,$IV,$plainKey);
      $data = base64_decode($decrypted_data);
      file_put_contents($fileName2,$data);



      download_file($fileName2);
      

    }  
  }
  else
    echo 'No files selected for Download';
  
  // get the bookmarks this user has saved
  if ($file_array = get_user_files($valid_user))
    display_user_files($file_array);
  
}
else{
  do_html_header('Problem:');
  echo "Incorrect phrase. Please try again.";
}
display_user_menu(); 
do_html_footer();
?>
