<?php

/* PLEASE DO NOT ALLOW EVEN ONE BLANK SPACE/LINE IN THIS FILE OUTSIDE '<?php' AND '?>' */

error_reporting(1);import_request_variables('gpc');error_reporting(8);


// --------------------------------- //


$db_type='mysql';                    // database type, *lowercase* ( options: mysql, mysqli, postgre, sqlite )

$db_host='mysql.infokaw.com.br';                // database host ( in most cases 'localhost' )
$db_user='infokaw02';                         // database user (not used with sqlite)
$db_pass='infokaw77';                         // database password  (not used  with sqlite)
$db_name='infokaw02';                         // Database [mysql, postgre]. Note that the installation script cannot create a database for you!
$db_sqlite='sqlite/blab.dat';        // Database [sqlite]: 'path/filename', a 0-byte file CHMODed to 777 )

$salt='RandOM_StRiNG_123';           // Salt. 
$prefix='blab';                      // Table prefix.
                                     // It is STRONGLY recommended to change both salt & table prefix before running the installation
                                     // You MUST NOT change salt & table prefix later!

$skin_dir='s-skin';                  // skin directory, no trailing slashes
$error_log='errors.txt';             // CHMODed to 777 file to store sql errors if any ( it is strongly recommended to rename this file )

//$encoding='koi8-r';
$encoding='iso-8859-1';              // set here the encoding of your phpBB, IPB, vB, Mambo etc. Not used with standalone installations.
$persistent_connection='0';          // [0 or 1] Establishes a persistent connection to the SQL server. If you are not sure leave it '0'.


// --------------------------------- //

$session=6;    // hours
$update=6;     // seconds [6-20]
$history=20;   // minutes [5-120]
$timezone=3;   // 0=GMT [default]

$no_errs=0;    // suppress http errors caused by network lags etc 
               // [0 = sometimes errors & error info , 1 = no errors & no info]

?>