<?php

class Encryption
{
    const CYPHER = MCRYPT_RIJNDAEL_256;
    const MODE   = MCRYPT_MODE_CBC;
    
    //this function encrypts the file
    public function encrypt($data)
    {
        $key1    = mt_rand();
        $key2 = mt_rand();
        $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

        $ks = mcrypt_enc_get_key_size($td);

        /* Create key */
        $key1 = md5($key1);
        $key2 = md5($key2);

        /*Md5() and/or sha1() should not be used while forming your key for the mcrypt because hex encoding uses 
        a set of only 16 characters [0-9a-f], which is equivalent to 4 bits, and thus halve the strength of your encryption: 4 x 32 = 128-bit.
        So here is a way to get real 256-bit encryption
        */

        $key = substr($key1, 0, $ks/2) . substr(strtoupper($key2), (round(strlen($key2) / 2)), $ks/2);

        $key = substr($key.$key1.$key2.strtoupper($key1),0,$ks);

        mcrypt_generic_init($td, $key, $iv);
        $crypttext = mcrypt_generic($td, $data);
        mcrypt_generic_deinit($td);

        $iv_and_key_and_crypt = array($iv,$key,$crypttext);

        return  $iv_and_key_and_crypt;
    }

//this function encryts the file key
    public function encrypt2($data,$key)
    {

        $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

        $ks = mcrypt_enc_get_key_size($td);

        

        mcrypt_generic_init($td, $key, $iv);
        $crypttext = mcrypt_generic($td, $data);
        mcrypt_generic_deinit($td);

        $iv_and_key_and_crypt = array($iv,$crypttext);

        return  $iv_and_key_and_crypt;
    }
    //this function decrypts the file
    public function decrypt($crypttext)
    {

     $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');


     mcrypt_generic_init($td, $crypttext['1'], $crypttext['0']);

     /* Decrypt encrypted string */
     $decrypted = mdecrypt_generic($td, $crypttext['2']);

     /* Terminate decryption handle and close module */
     mcrypt_generic_deinit($td);
     mcrypt_module_close($td);
     return $decrypted;
 }

//this function decrypts the key
 public function decrypt2($data,$keyIV,$key)
 {
  if($keyIV!==""){
     $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');



     mcrypt_generic_init($td, $key, $keyIV);

     /* Decrypt encrypted string */
     $decrypted = mdecrypt_generic($td, $data);

     /* Terminate decryption handle and close module */

     mcrypt_generic_deinit($td);
     mcrypt_module_close($td);
     return $decrypted;
 }
}
}

?>