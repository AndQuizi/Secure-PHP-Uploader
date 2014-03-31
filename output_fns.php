<?php

function do_html_header($title)
{
  // print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #3333cc; width=300; text-align=left}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <img src="bookmark.gif" alt="PHPbookmark logo" border=0
       align=left valign=bottom height = 55 width = 57 />
  <h1>&nbsp;Secure PHP File Uploader</h1>
  <hr />
<?php
  if($title)
    do_html_heading($title);
}

function do_html_footer()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading)
{
  // print heading
?>
  <h2><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name)
{
  // output URL as link and br
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

function display_site_info()
{
  // display some marketing info
?>
  <ul>
  <li>Store your files online!</li>
  <li>Safe and Secure File Storage!</li>
  </ul>
<?php
}

function display_login_form()
{
?>
  <a href='register_form.php'>Not a member?</a>
  <form method='post' action='member.php'>
  <table bgcolor='#cccccc'>
   <tr>
     <td colspan=2>Members log in here:</td>
   <tr>
     <td>Username:</td>
     <td><input type='text' name='username'></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type='password' name='passwd'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Log in'></td></tr>
   <tr>
     <td colspan=2><a href='forgot_form.php'>Forgot your password?</a></td>
   </tr>
 </table></form>
<?php
}

function display_registration_form()
{
?>
 <form method='post' action='register_new.php'>
 <table bgcolor='#cccccc'>
   <tr>
     <td>Email address:</td>
     <td><input type='text' name='email' size=30 maxlength=100></td></tr>
   <tr>
     <td>Preferred username <br />(max 16 chars):</td>
     <td valign='top'><input type='text' name='username'
                     size=16 maxlength=16></td></tr>
   <tr>
     <td>Password <br />(between 6 and 16 chars):</td>
     <td valign='top'><input type='password' name='passwd'
                     size=16 maxlength=16></td></tr>
   <tr>
     <td>Confirm password:</td>
     <td><input type='password' name='passwd2' size=16 maxlength=16></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Register'></td></tr>
 </table></form>
<?php 

}



function display_user_menu()
{
  // display the menu options on this page
?>
<hr />
<a href="member.php">Home</a> &nbsp;|&nbsp;


<a href="change_passwd_form.php">Change password</a>
<br />

<a href="upload_file_form.php">Upload File</a>&nbsp;|&nbsp;

<a href="manage_file_form.php">Manage Files</a>
<br />

<a href="logout.php">Logout</a> 

<hr />

<?php
}


function display_password_form()
{
  // display html change password form
?>
   <br />
   <form action='change_passwd.php' method='post'>
   <table width=250 cellpadding=2 cellspacing=0 bgcolor='#cccccc'>
   <tr><td>Old password:</td>
       <td><input type='password' name='old_passwd' size=16 maxlength=16></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type='password' name='new_passwd' size=16 maxlength=16></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type='password' name='new_passwd2' size=16 maxlength=16></td>
   </tr>
   <tr><td colspan=2 align='center'><input type='submit' value='Change password'>
   </td></tr>
   </table>
   <br />
<?php
};

function display_forgot_form()
{
  // display HTML form to reset and email password
?>
   <br />
   <form action='forgot_password.php' method='post'>
   <table width=250 cellpadding=2 cellspacing=0 bgcolor='#cccccc'>
   <tr><td>Enter your username</td>
       <td><input type='text' name='username' size=16 maxlength=16></td>
   </tr>
   <tr><td colspan=2 align='center'><input type='submit' value='Change password'>
   </td></tr>
   </table>
   <br />
<?php
};

function display_upload_file_form()
{
  
?>
  <br />
  <form action="enter_hash_form.php" method="post"
  enctype="multipart/form-data">
  <label for="file">Filename:</label>
  <input type="file" name="file" id="file"><br>
  <input type="submit" name="submit" value="Submit">
  </form>
  <br />
<?php
}

function display_enter_hash_form(){
 ?>
  <form method='post' action='file_register.php'>
  <table bgcolor='#cccccc'>
   <tr>
     <td colspan=2>Secret Phrase and Hint:</td>
   <tr>
     <td>Hint:</td>
     <td><input type='text' name='hint'></td></tr>
   <tr>
     <td>Pass Phrase:</td>
     <td><input type='text' name='phrase'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Submit'></td></tr>
   <tr>
    
   </tr>
 </table></form>
<?php
}

function display_enter_hash_form2($hint){
  echo "Your hint is: ";
  echo $hint;
  echo "</br>";
  echo "</br>";

 ?>
  <form method='post' action='delete_files.php'>
  <table bgcolor='#cccccc'>
   <tr>
     <td colspan=2>Secret Phrase and Hint:</td>
   <tr>
    
     
   <tr>
     <td>Pass Phrase:</td>
     <td><input type='text' name='phrase'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Submit'></td></tr>
   <tr>
    
   </tr>
 </table></form>
<?php
}
function display_enter_hash_form3($hint){
 echo "Your hint is: ";
  echo $hint;
  echo "</br>";
  echo "</br>";
 ?>
  <form method='post' action='download_files.php'>
  <table bgcolor='#cccccc'>
   <tr>
     <td colspan=2>Secret Phrase and Hint:</td>
   <tr>
   
     
   <tr>
     <td>Pass Phrase:</td>
     <td><input type='text' name='phrase'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Submit'></td></tr>
   <tr>
    
   </tr>
 </table></form>
<?php
}

function display_user_filesDelete($file_array)
{
  // display the form for people to ener a new file in
  global $file_table;
  $file_table = true;
?>
   <br />
  <form name='file_table' action='confirm_hash_form_delete.php' method='post'>
  <table width=300 cellpadding=2 cellspacing=0>
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor='$color'><td><strong>File</strong></td>";
  echo "<td><strong>Delete?</strong></td></tr>";
  
  if (is_array($file_array) && count($file_array)>0)
  {
    foreach ($file_array as $file)
    {
      if ($color == "#cccccc")
        $color = "#ffffff";
      else
        $color = "#cccccc";
      
      $filename= $file['file_name'];
      echo "<tr bgcolor='$color'><td><a href=\"$filename\">".$file['file_name']."</a></td>";
      
      echo "<td><input type='radio' name=\"del_me[]\"
             value=\"$filename\">";


      echo "</tr>"; 
     
    }

    
  // only offer the delete option if file table is on this page
    
  global $file_table;
  if($file_table==true)
    echo "<a href='#' onClick='file_table.submit();'>Delete Files</a>&nbsp;|&nbsp;"; 
  else
    echo "<font color='#cccccc'>Delete Files</font>&nbsp;|&nbsp;"; 

  }
  
  

  
  
  else
    echo "<tr><td>No Files on record</td></tr>";
?>
  </table> 
  </form>
<?php

}

function display_user_filesDownload($file_array)
{
  // display the form for people to ener a new file in
  global $file_table2;
  $file_table2 = true;
?>
   <br />
  <form name='file_table2' action='confirm_hash_form_download.php' method='post'>
  <table width=300 cellpadding=2 cellspacing=0>
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor='$color'><td><strong>File</strong></td>";
  echo "<td><strong>Download?</strong></td></tr>";
  
  if (is_array($file_array) && count($file_array)>0)
  {
    foreach ($file_array as $file)
    {
      if ($color == "#cccccc")
        $color = "#ffffff";
      else
        $color = "#cccccc";
      
      $filename= $file['file_name'];
      echo "<tr bgcolor='$color'><td><a href=\"$filename\">".$file['file_name']."</a></td>";
      
      echo "<td><input type='radio' name=\"down_me[]\"
             value=\"$filename\">";


      echo "</tr>"; 
     
    }

    
  // only offer the delete option if file table is on this page
    
  global $file_table2;
  if($file_table2==true)
    echo "<a href='#' onClick='file_table2.submit();'>Download Files</a>&nbsp;|&nbsp;"; 
  else
    echo "<font color='#cccccc'>Download Files</font>&nbsp;|&nbsp;"; 

  }
  
  

  
  
  else
    echo "<tr><td>No Files on record</td></tr>";
?>
  </table> 
  </form>
<?php

}




?>
