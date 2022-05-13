<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';
$cookie_ext='0';

$query='DELETE FROM '.$prefix."_banned WHERE $timestamp>ban_stamp";
neutral_query($query);

if(isset($language)&&!headers_sent()){$language=(int)$language;
setcookie('blab_lang',$language,time()+3600*24*365,'/');}

if(isset($offset)&&!headers_sent()){$offset=(int)$offset;
setcookie('blab_time',$offset,time()+3600*24*365,'/');}

if(isset($settings['extension'])&&$settings['extension']!='0'){
$the_num=(int)$settings['extension'];
$ext=file('incl/extensions');
if(isset($ext[$the_num])){
$ext=explode(':',$ext[$the_num]);
if(isset($ext[3])){$cookie_ext=trim($ext[3]);}}}

if((isset($blab_id)&&isset($blab_pass))||isset($$cookie_ext)){
redirect('blab.php',0,0);}

else{redirect('login.php',0,0);}
?>
