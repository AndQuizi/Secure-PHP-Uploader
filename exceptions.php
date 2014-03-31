<?php
 require_once('package_fns.php');
class DBException extends Exception
{
  function display()
  {

    echo "DBException: $this->message";
   

  }
}

?>
