<?php
  // include function files for this application
require_once('package_fns.php');
require_once('filedb_fns.php');
require_once('secure_data_fns.php');
require_once('Encryption.php');
session_start();

do_html_header('Upload Files');
check_valid_user();


  //create short variable names
$hint=$_POST['hint'];
$passPhrase=$_POST['phrase'];

  //remember to unlink this

$user = $_SESSION['valid_user'];
  //==do_html_header('Unique Secure Phrase');

if(isset($_SESSION['fileContents'])){
  $fileName= $_SESSION['fileContents']['0'];
  $fileType=$_SESSION['fileContents']['1'];
  $fileSize=$_SESSION['fileContents']['2'];
  $fileKey =$_SESSION['fileContents']['3'];
  $fileIV =   $_SESSION['fileContents']['4'];

  unset($_SESSION['fileContents']);

  try
  {
    //for every exception add code to remove file
   if (!filled_out($_POST))
   {
     unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
     throw new Exception('You have not filled the form out correctly - please go back'
      .' and try again.');   

   }
    // phrase not valid
   if (!valid_phrase($hint))
   {
     unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
     throw new Exception('That is not a valid secret phrase.  Please go back '
      .' and try again.');
   } 
   if (!valid_phrase($passPhrase))
   {
     unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
     throw new Exception('That is not a valid secret phrase.  Please go back '
      .' and try again.');
   } 

   if (strlen($hint)<6 || strlen($hint) >40)
   {
     unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
     throw new Exception('Your hint must be between 6 and 40 characters.'
       .'Please go back and try again.');
   }
   
   if (strlen($passPhrase)<8 || strlen($passPhrase) >30)
   {
     unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
     throw new Exception('Your phrase must be between 8 and 30 characters.'
      .'Please go back and try again.');
   }

    //little hack to see if pass phrase typed in was correct
   $fileKey .= " ";


    //ENCRYPT KEY HERE WITH PHRASE
   $phraseHash = hash('md5', $passPhrase);

   $encrypted_key = Encryption::encrypt2($fileKey,$phraseHash);


   if(uploadFileDB2($user,$fileName,$fileType,$fileSize,$encrypted_key['1'],$fileIV,$hint, $encrypted_key['0'])){

    rename ("C:/dataFiles/".$user."/tmp/". $fileName,
      "C:/dataFiles/".$user."/". $fileName);
  }
  else{
   unlink('C:/dataFiles/'.$user.'/tmp/'. $fileName);
 }
 
 

}

catch (Exception $e)
{
 do_html_header('Problem:');
 echo $e->getMessage(); 
 display_user_menu();
 do_html_footer();
 exit;
} 
}
else{
  echo "No file to upload.";

}

display_user_menu();
do_html_footer();

?>