<?php
require_once('db_fns.php');
require_once('secure_data_fns.php');
function uploadFileDB($user,$name,$type,$filesize,$fileKey, $fileIV,$hint,$keyIV){
  $conn = db_connect();
  
  $fileName= mysql_real_escape_string($name);
  $fileType= mysql_real_escape_string($type);
    //$data= $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
  $fileSize= intval($filesize);
  $hint = mysql_real_escape_string($hint);
  $fileKey = base64_encode($fileKey);
  $fileIV = base64_encode($fileIV);
  $keyIV= base64_encode($keyIV);
  
  
   // if ok, put in db
  $query = "INSERT INTO testappdb.uploads (username,file_name, type, size,HashKey,IV,Hint,keyIV) VALUES ('$user','$fileName', '$fileType', '$fileSize', '$fileKey', '$fileIV','$hint', '$keyIV')";
  
  $result = mysql_query($query);
  echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
    //Check if it was successfull
  if($result) {
    echo 'Success! Your file was successfully added!';
    echo "<br>File $fileName uploaded<br>";
}
else{
   echo 'Error! Failed to insert the file';
}

mysql_close($conn);
}

//function used to test operations
function uploadFileDB2($user,$name,$type,$filesize,$fileKey, $fileIV,$hint,$keyIV){
  $conn = db_connect();
  
  $fileName= mysql_real_escape_string($name);
  $fileType= mysql_real_escape_string($type);
    //$data= $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
  $fileSize= intval($filesize);
  $hint = mysql_real_escape_string($hint);
  $fileKey = base64_encode($fileKey);
  $fileIV = base64_encode($fileIV);
  $keyIV= base64_encode($keyIV);

   // if ok, put in db
  $query = "INSERT INTO testappdb.uploads (username,file_name, type, size,HashKey,IV,Hint,keyIV) VALUES ('$user','$fileName', '$fileType', '$fileSize', '$fileKey', '$fileIV','$hint', '$keyIV')";
  
  $result = mysql_query($query);

    //Check if it was successfull
  if($result) {
    echo 'Success! Your file was successfully added!';
    echo "<br>File $fileName uploaded<br>";
    return true;
}
else{
   echo 'Error! Failed to insert the file';
   return false;
}

mysql_close($conn);
}



?>