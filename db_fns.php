<?php

function db_connect()
{
   $result = mysql_connect('localhost', 'root', ''); //enter db
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

?>
