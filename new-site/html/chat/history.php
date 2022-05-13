<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$query='SELECT count(*) FROM '.$prefix."_online WHERE ($timestamp-rtime)<20";
$result=neutral_query($query);
$user_online=neutral_fetch_array($result);
$user_online=$user_online[0];

if(isset($room)){$room=(int)$room;}else{$room=0;}

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){


if($blab_id=='0'&&$blab_pass==hsh($settings['guest_pass'])){

$my_details['usr_id']='0';
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
}

else{
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}}

elseif(isset($settings['extension'])&&$settings['extension']!='0'){
$the_num=(int)$settings['extension'];
$ext=file('incl/extensions');
if(isset($ext[$the_num])){
$ext=explode(':',$ext[$the_num]);
if(isset($ext[6])){
$ext_name=trim($ext[0]);
$ext1file=trim($ext[1]);$ext2file=trim($ext[2]);
$ext1cook=trim($ext[3]);$ext2cook=trim($ext[4]);
$ext1tble=trim($ext[5]);$ext2tble=trim($ext[6]);
if(isset($$ext1cook)){require_once 'incl/'.$ext1file;}}}}

if(!isset($my_details['usr_id'])){redirect('login.php?login=1',0,0);}
$myd=(int)$my_details['usr_id'];

if(isset($my_details['usr_format'])){
switch($my_details['usr_format']){
case '1':$format='h:i:s A';break;
case '2':$format='Y-m-d H:i:s';break;
case '3':$format='d.m.Y H:i:s';break;
case '4':$format='m/d/Y h:i:s A';break;
default:$format='H:i:s';break;}
}else{$format='H:i';}

/* --- */

include 'incl/open_doc.inc';
print '<script type="text/javascript">document.body.style.height=\'100%\';document.body.style.overflow=\'auto\';</script><div style="padding:5px">';

$query='SELECT room_name FROM '.$prefix."_rooms WHERE room_id=$room";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$room_name=neutral_fetch_array($result);
$room_name=output($room_name[0],2);}else{$room_name='';}

print '<b>'.$room_name.'</b><br /><br />';

$query='SELECT * FROM '.$prefix."_lines WHERE room_id=$room AND (to_id<1 OR (to_id=$myd OR from_id=$myd)) ORDER BY line_id asc";
$result=neutral_query($query);


if(neutral_num_rows($result)>0){
while($row=neutral_fetch_array($result)){
$time=show_time($row['line_stamp'],$timezone,$format);

$from=output($row['from_name'],2);
$from=escape($from);

$to=output($row['to_name'],2);
$to=escape($to);

$post=output($row['line_txt'],2);
$post=escape($post);

if($my_details['usr_fun']>0){
$post=bbcode($post);

$style='';
$biu=output($row['line_biu'],2);$biu=escape($biu);
$clr=output($row['line_clr'],2);$clr=escape($clr);
if(strlen($biu)==3){
if(substr($biu,0,1)=='1'){$style.='font-weight:bold;';}
if(substr($biu,1,1)=='1'){$style.='font-style:italic;';}
if(substr($biu,2,1)=='1'){$style.='text-decoration:underline;';}}
if(strlen($clr)>5){$style.='color:'.$clr;}

if($style!=''){$post='<span style="'.$style.'">'.$post.'</span>';}
}


$time='<span class="s">['.$time.']</span> ';

if(strlen($to)>1){$whsp=' [<b>&raquo;</b>] <b>'.$to.'</b>';}else{$whsp='';}

if(strlen($from)>1){$from='<b>'.$from.'</b>'.$whsp.': ';
$from='<span class="s">'.$from.'</span>';}

print $time.$from.$post.'<br />';
}}


?>



</div></body></html>