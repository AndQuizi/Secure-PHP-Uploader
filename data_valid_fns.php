<?php

function filled_out($form_vars)
{
  // test that each variable has a value
  if( is_array( $form_vars ) ) {
    foreach ($form_vars as $key => $value)
    {
       if (!isset($key) || ($value == '')) 
          return false;
    } 
  }
  //else return false;
  return true;

}

function valid_email($address)
{
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else 
    return false;
}

function valid_phrase($phrase){

//hints only accept letters and spaces
 if (preg_match('/^[a-zA-Z0-9 ]+$/i', $phrase)) {
    return true;
 }
 else return false;
}



?>
