<?php
// include function files for this application
require_once('package_fns.php');

require_once('Encryption.php');
session_start();
do_html_header('Unique Secure Phrase');
check_valid_user();



if (!checkValidFile()){
	echo"Invalid File. Please try again.";
	display_upload_file_form();
	display_user_menu();
	do_html_footer();
}
else{


  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "<br>";


    //need to validate
  $fileName = $_FILES['file']['name'];

  $tmpName  = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileType = $_FILES['file']['type'];

  $user = $_SESSION['valid_user'];


  if (file_exists("C:/dataFiles/".$user."/". $_FILES["file"]["name"]))
  {
    echo $_FILES["file"]["name"] . " already exists. ";

  }
  else
  {
      	//HERE WE ENCRYPT THE FILe

      $fileName2 = $_FILES["file"]["tmp_name"];
      $file_binary = fread(fopen($fileName2, "r"), 
        filesize($fileName2));

      $encoded_file =  base64_encode($file_binary);
      $encrypted_data = Encryption::encrypt($encoded_file);

      file_put_contents($fileName2,$encrypted_data['2']);
      
      move_uploaded_file($_FILES["file"]["tmp_name"],
      	"C:/dataFiles/".$user."/tmp/". $_FILES["file"]["name"]);




      $file_array=array($_FILES['file']['name'],  $fileSize = $_FILES['file']['type'] ,$fileSize = $_FILES['file']['size'],$encrypted_data['1'],$encrypted_data['0']);

      //pass file information to next page
      $_SESSION['fileContents'] = $file_array;



      echo "<br>";
      echo "<br>";
      echo"Please enter a unqiue phrase assiocated with the file. It is YOUR responsibility to remember and secure your phrase.";
      echo "<br>";
      echo"The hint may only consist of letters, numbers, and spaces, and MINIMUM length of 6 characters. Hints are mandatory.";
      echo "<br>";
      echo"The pass phrase may only consist of letters, numbers, and spaces, and MINIMUM length of 8 characters.";
      echo "<br>";

      display_enter_hash_form();
    }

    


    display_user_menu();
    do_html_footer();
  }

  ?>
