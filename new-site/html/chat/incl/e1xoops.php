<?php
if(isset($$ext1cook)){
$cookie=neutral_escape($$ext1cook,32,'str');
$query="SELECT b.uid,b.uname,b.timezone_offset FROM $ext2tble a,$ext1tble b WHERE b.uid=a.uid AND a.hash='$cookie'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$xoop_user=neutral_fetch_array($result);

if(isset($xoop_user['uname'])){

$xoop_user['uid']=(int)$xoop_user['uid'];
$my_details['usr_id']=500000000+$xoop_user['uid'];
$my_details['usr_name']=$xoop_user['uname'].$settings['suffix'];
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
$timezone=$xoop_user['timezone_offset'];

}
}
}

?>