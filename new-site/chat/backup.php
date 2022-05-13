<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}

if(!isset($my_details['usr_id'])||$my_details['usr_id']!='1'){
redirect('login.php?login=1',0,0);}

/* --- */

$query='SELECT usr_id,usr_name,usr_pass,usr_mail,usr_join_date,usr_mod FROM '.$prefix.'_users';
$result=neutral_query($query);

header('Content-Type: text/x-sql');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-Disposition: attachment; filename="blab_users.sql"');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

while($row=neutral_fetch_array($result)){
$id=(int)$row['usr_id'];
$name=str_replace("'",'',$row['usr_name']);
$pass=$row['usr_pass'];
$mail=str_replace("'",'',$row['usr_mail']);
$join=$row['usr_join_date'];
$mod=(int)$row['usr_mod'];

print 'INSERT INTO '.$prefix."_users VALUES($id,'$name','$pass','$mail',$join,0,0,0,1,1,$mod,0,0,'','','','','0');"."\r\n";
}

?>