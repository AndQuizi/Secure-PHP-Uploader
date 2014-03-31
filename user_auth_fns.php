<?php

require_once('db_fns.php');
require_once('Encryption.php');

function register($username, $email, $password)
// register new person with db
// return true or error message
{
  // connect to db
  $conn = db_connect();
  
  $username = mysql_real_escape_string($username);
  $email = mysql_real_escape_string($email);
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // check if username is unique 
  $result = mysql_query("SELECT * FROM testappdb.user WHERE username='$username'"); 
  if (!$result)
    throw new Exception('Could not execute query');
  if (mysql_num_rows($result) > 0) 
    throw new Exception('That username is taken - go back and choose another one.');
  
  $result = mysql_query("SELECT * FROM testappdb.user WHERE email='$email'"); 
  if (!$result)
    throw new Exception('Could not execute query');
  if (mysql_num_rows($result) > 0) 
    throw new Exception('That email is taken - go back and choose another one.');
  // if ok, put in db
  $result = mysql_query("INSERT INTO testappdb.user VALUES 
   ('$username', '$password', '$email')");
  if (!$result)
    throw new Exception('Could not register you in database - please try again later.');

  mkdir("C:/dataFiles/".$username);
  mkdir("C:/dataFiles/".$username."/tmp");
  return true;
}

function login($username, $password)
// check username and password with db
// if yes, return true
// else throw exception
{
  // connect to db
  $conn = db_connect();
  // check if username is unique
  $username = mysql_real_escape_string($username);

  $query="SELECT * FROM testappdb.user 
  WHERE username='$username'";
  
  $result = mysql_query($query);

  if (!$result)
   throw new Exception('Could not log you in.');

 $hashPassword = "";
 
 if (mysql_num_rows($result) > 0){
  while ($row = mysql_fetch_assoc($result)) {
    
    $hashPassword =$row["passwd"];
    
  }
  if(password_verify($password,$hashPassword))
    return true;
  else 
   throw new Exception('Could not log you in.');
}

else 
 throw new Exception('Could not log you in.');
}

function check_valid_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
    echo 'Logged in as '.$_SESSION['valid_user'].'.';
    echo '<br />';
  }
  else
  {
     // they are not logged in 
   do_html_heading('Problem:');
   echo 'You are not logged in.<br />';
   do_html_url('login.php', 'Login');
   do_html_footer();
   exit;
 }  
}

function check_valid_user_boolean()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
    return true;
  }
  else
  {
     // they are not logged in 
   return false;
 }  
}

function change_password($username, $old_password, $new_password)
// change password for username/old_password to new_password
// return true or false
{
  // if the old password is right 
  // change their password to new_password and return true
  // else throw an exception
  login($username, $old_password);
  $conn = db_connect();
  $password = password_hash($new_password, PASSWORD_DEFAULT);
  $result = mysql_query( "UPDATE testappdb.user
    SET passwd = '$password'
    WHERE username = '$username'");

  if (!$result)
    throw new Exception('Password could not be changed.');
  else
    return true;  // changed successfully
}



function reset_password($username)
// set password for username to a random value
// return the new password or false on failure
{ 
  // get a random dictionary word b/w 6 and 13 chars in length
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < 8; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  
  // add a number  between 0 and 999 to it
  // to make it a slightly better password

  $password = password_hash($randomString, PASSWORD_DEFAULT);
  // set user's password to this in database or return false
  $conn = db_connect();
  $result = mysql_query( "UPDATE testappdb.user
    SET passwd = '$password'
    WHERE username = '$username'");
  if (!$result){
    echo mysql_errno($conn) . ": " . mysql_error($conn) . "\n";
    throw new Exception('Could not change password.'); 
    } // not changed
    else
    return $randomString;  // changed successfully  
}

function notify_password($username, $password)
// notify the user that their password has been changed
{
  $conn = db_connect();
  $result = mysql_query("SELECT email FROM testappdb.user
    WHERE username='$username'");
  if (!$result)
  {
    throw new Exception('Could not find email address.');  
  }
  else if (mysql_num_rows($result)==0)
  {
      throw new Exception('Could not find email address.');   // username not in db
    }
    else
    {
      $row = mysql_fetch_assoc($result);
      
      $email = $row['email'];
      $from = "From: support@phpsecureuploader \r\n";
      $mesg = "Your PHP Secure Uploader password has been changed to $password \r\n"
      ."Please change it next time you log in. \r\n";
      
      
      if (mail($email, 'PHP Secure Uploader login information', $mesg, $from))
        return true;      
      else
        throw new Exception('Could not send email.');
    }
  } 


  function decrypt_key($user, $phrase,$file)
  {
  // delete one URL from the database

    $conn = db_connect();
    
    

  $query = "SELECT keyIV FROM testappdb.uploads WHERE username= '$user' and file_name = '$file'";// delete the bookmark

  $result =mysql_query($query);


  
  if(!$result){
   
    return false;

  }
  

  $row1 = mysql_fetch_assoc($result);
  $keyIV = base64_decode($row1['keyIV']);

 $query2 = "SELECT HashKey FROM testappdb.uploads WHERE username= '$user' and file_name = '$file'";// delete the bookmark

 $result2 =mysql_query($query2);

 
 if(!$result2){
   
  return false;

}
$row2 = mysql_fetch_assoc($result2);
$hashKey = base64_decode($row2['HashKey']); 



$phraseHash = hash('md5', $phrase);


$decrypted_key = Encryption::decrypt2($hashKey ,$keyIV,$phraseHash);


return $decrypted_key;  
}

function getIV($user,$file)
{
  // delete one URL from the database

  $conn = db_connect();


  $query = "SELECT IV FROM testappdb.uploads WHERE username= '$user' and file_name = '$file'";// delete the bookmark

  $result =mysql_query($query);


  
  if(!$result){
   
    return false;

  }
  

  $row1 = mysql_fetch_assoc($result);
  $iv =  base64_decode($row1['IV']);

  return $iv; 
}




?>
