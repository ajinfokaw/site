<?php

// 3.1 

if(!isset($settings['reg_on'])){
$query='INSERT INTO '.$prefix."_settings VALUES('reg_on','1')";
neutral_query($query);
redirect('admin.php?q=main',$lang['action_ok'],1);}

// 3.2 

if(!isset($settings['a_message'])){
$query='INSERT INTO '.$prefix."_settings VALUES('a_message','%URL%\r\nYour account has been set active.')";
neutral_query($query);
redirect('admin.php?q=main',$lang['action_ok'],1);}

?>