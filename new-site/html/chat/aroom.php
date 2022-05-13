<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($ajx_user)){die('1');}     else{$ajx_user=(int)$ajx_user;}
if(!isset($ajx_sess)){die('2');}
if(!isset($ajx_code)){die('3');}

$check=hsh($ajx_user.$ajx_name.$ajx_sess);
if($ajx_code!=$check){die('4');}

if(!isset($ajx_room)){die('5');}    else{$ajx_room=(int)$ajx_room;}
   if($ajx_room=='0'){die('6');}

if(($timestamp-$ajx_sess)>($session*3600)){
                      die('7');}

$query='SELECT * FROM '.$prefix."_banned WHERE ban_entry='$my_ip'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
                      die('8');}

if(!isset($ajx_last)){$ajx_last=0;} else{$ajx_last=(int)$ajx_last;}
if(!isset($ajx_zone)){$zone=0;} else{$zone=(int)$ajx_zone;}
if(!isset($ajx_tfrm)){$ajx_tfrm=0;} else{$ajx_tfrm=(int)$ajx_tfrm;}
if(!isset($ajx_funn)){$ajx_funn=0;} else{$ajx_funn=(int)$ajx_funn;}
if(!isset($ajx_lbiu)){$ajx_lbiu='';} else{$ajx_lbiu=neutral_escape($ajx_lbiu,3,'str');}
if(!isset($ajx_lclr)){$ajx_lclr='';} else{$ajx_lclr=neutral_escape($ajx_lclr,32,'str');}

switch($ajx_tfrm){
case '1':$format='h:i:s A';break;
case '2':$format='Y-m-d H:i:s';break;
case '3':$format='d.m.Y H:i:s';break;
case '4':$format='m/d/Y h:i:s A';break;
default:$format='H:i:s';break;}

/* --- */

if(isset($ajx_line)){

$tto_name='';

if(isset($ajx_toid)){$ajx_toid=(int)$ajx_toid;}else{$ajx_toid=0;}

if($ajx_toid>0){
if($ajx_toid==$ajx_user){$tto_name=$ajx_name;}
else{
$query='SELECT usr_name FROM '.$prefix."_online WHERE usr_id=$ajx_toid AND room_id=$ajx_room";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){$row=neutral_fetch_array($result);$tto_name=$row[0];}
else{$ajx_toid==$ajx_user;$tto_name=$ajx_name;}}}

$ajx_name=neutral_escape($ajx_name,64,'str');
$tto_name=neutral_escape($tto_name,64,'str');
$ajx_line=neutral_escape($ajx_line,255,'str');

$bad_words=file('badwords.txt');
$bad_words=explode(',',$bad_words[0]);
if(count($bad_words)>1){
for($i=0;$i<count($bad_words);$i++){
$ajx_line=eregi_replace($bad_words[$i],'***',$ajx_line);}}

$a=substr($timestamp,4,6);$b=microtime();$b=substr($b,2,3);$c=$a.$b;$c=(int)$c;
$query='INSERT INTO '.$prefix."_lines VALUES($c,$ajx_room,$ajx_user,'$ajx_name',$ajx_toid,'$tto_name',$timestamp,'$ajx_line','$ajx_lbiu','$ajx_lclr')";
neutral_query($query);}


$query='SELECT MAX(line_id) FROM '.$prefix."_lines WHERE room_id=$ajx_room";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){
$the_last=neutral_fetch_array($result);
$the_last=$the_last[0];$the_last=(int)$the_last;}
else{$the_last=0;}

if($the_last<1){$the_last=1;}

$lines=array();


if($ajx_last<$the_last&&$ajx_last>0){
$query='SELECT * FROM '.$prefix."_lines WHERE room_id=$ajx_room AND (to_id<1 OR (to_id=$ajx_user OR from_id=$ajx_user)) AND line_id>$ajx_last ORDER BY line_id asc";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
while($row=neutral_fetch_array($result)){

$time=show_time($row['line_stamp'],$zone,$format);

$from=output($row['from_name'],2);
$from=escape($from);

$to=output($row['to_name'],2);
$to=escape($to);

$post=output($row['line_txt'],2);
$post=escape($post);
if($ajx_funn>0){
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
$lines[]=$time.'*'.$from.'*'.$to.'*'.$post;
}}}

$lines=implode('|',$lines);

$keep_time=$update*2;
$query='DELETE FROM '.$prefix."_online WHERE usr_id=$ajx_user OR ($timestamp-rtime)>$keep_time";
neutral_query($query);

$keep_time=$history*60;
$query='DELETE FROM '.$prefix."_lines WHERE ($timestamp-line_stamp)>$keep_time";
neutral_query($query);

$query='INSERT INTO '.$prefix."_online VALUES($ajx_user,'$ajx_name','$my_ip',$ajx_room,$timestamp)";
neutral_query($query);

$query='SELECT usr_id,usr_name FROM '.$prefix."_online WHERE ($timestamp-rtime)<20 AND room_id=$ajx_room";
$result=neutral_query($query);

$online=array();
while($row=neutral_fetch_array($result)){
$id=(int)$row['usr_id'];
$name=output($row['usr_name'],2);
$name=escape($name);
$online[]=$name.'*'.$id;
}

sort($online);
$online=implode('|',$online);

$end_time=time_to_run();
$total_time=substr(($end_time-$start_time),0,5);

$alls=$the_last.'^'.$lines.'^'.$online.'^'.$queries.'^'.$total_time;

print $alls;
?>