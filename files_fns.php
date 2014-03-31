<?php
require_once('db_fns.php');

function get_user_files($username)
{
  //extract from the database all the URLs this user has stored
  $conn = db_connect();
  $result = mysql_query( "SELECT file_name
    FROM testappdb.uploads
    WHERE username = '".$username."'");
  if (!$result)
    return false; 

  //create an array of the URLs 
  
  $file_array = array();
  while($row = mysql_fetch_assoc($result))
  {

    $file_array[] = $row;
    
  }  
  
  return $file_array;
}

function delete_file($user, $file)
{
  // delete one URL from the database

  $conn = db_connect();
  
  

  $query = "DELETE FROM testappdb.uploads WHERE username= '$user' and file_name= '$file'";// delete the bookmark

  $result =mysql_query($query);
  
  if(!$result){
    echo "could not delete";
    return false;
  // throw new Exception('File could not be deleted');
  }

  unlink('C:/dataFiles/'.$user.'/'. $file);


  return true;  
}

function download_file($file) { // $file = include path 
  if(file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    unlink($file);
    exit;
  }
  

}

function getHint($user, $file) { // $file = include path 
 
  $conn = db_connect();
  $result = mysql_query( "SELECT Hint
    FROM testappdb.uploads
    WHERE username = '".$user."' and file_name = '".$file."'");
  if (!$result)
    return false; 

  //create an array of the URLs 
  
  
  $row = mysql_fetch_assoc($result);

  $hint = $row['Hint'];

  return $hint;

}
function checkValidFile(){
  $allowedExts = array("gif", "jpeg", "jpg", "png", "txt");
  $temp = explode(".", @$_FILES["file"]["name"]);
  $extension = end($temp);
  if (((@$_FILES["file"]["type"] == "image/gif")
    || (@$_FILES["file"]["type"] == "image/jpeg")
    || (@$_FILES["file"]["type"] == "image/jpg")
    || (@$_FILES["file"]["type"] == "image/pjpeg")
    || (@$_FILES["file"]["type"] == "image/x-png")
    || (@$_FILES["file"]["type"] == "image/png")
    || (@$_FILES["file"]["type"] == "text/plain"))
    && (@$_FILES["file"]["size"] < 1000000)
    && in_array($extension, $allowedExts))
  {
    if (isset($_POST['upload']) && $_FILES["file"]["error"] > 0)
    {
      return false;
    }
    else
    {
      return true;
    }

  }
}
?>