<?php

function encryptData($input, $string){

        //AS OF FEBURARY 11TH THIS CLASS IS NOT LONGER IN USE. See ENCRYPTION.PHP 

$length = strlen($input);

    /* Open the cipher */
    $td = mcrypt_module_open('rijndael-256', '', 'ofb', '');

    /* Create the IV and determine the keysize length, use MCRYPT_RAND
     * on Windows instead */
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    $ks = mcrypt_enc_get_key_size($td);

    /* Create key */
    $key1 = md5($key1);
    $key2 = md5($key2);

    //md5() and/or sha1() should not be used while forming your key for the mcrypt because hex encoding uses a set of only 16 characters [0-9a-f], which is equivalent to 4 bits, and thus halve the strength of your encryption: 4 x 32 = 128-bit.
    //so here is a way to get real 256-bit encryption
    $key = substr($key1, 0, $ks/2) . substr(strtoupper($key2), (round(strlen($key2) / 2)), $ks/2);

    $key = substr($key.$key1.$key2.strtoupper($key1),0,$ks);

    /* Intialize encryption */
    mcrypt_generic_init($td, $key, $iv);

    /* Encrypt data */
    $encrypted = mcrypt_generic($td, $input);

    /* Terminate encryption handler */
    mcrypt_generic_deinit($td);


}


function decryptData($file){

    /* Initialize encryption module for decryption */
    mcrypt_generic_init($td, $key, $iv);

    /* Decrypt encrypted string */
    $decrypted = mdecrypt_generic($td, $encrypted);

    /* Terminate decryption handle and close module */
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    /* Show string */
    echo "Text: ".substr($decrypted,0,$length) . "<br>";
    echo "Encoded: ".$encrypted ."<br>";
    echo "<br>key1: $key1 <br>key2: $key2<br>created key: $key";
}


  



?>