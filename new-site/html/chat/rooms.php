<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($ajx_user)){die('1');} else{$ajx_user=(int)$ajx_user;}
if(!isset($ajx_sess)){die('2');}
if(!isset($ajx_code)){die('3');}

$check=hsh($ajx_user.$ajx_name.$ajx_sess);
if($ajx_code!=$check){die('4');}

if(($timestamp-$ajx_sess)>($session*3600)){
                      die('7');}

$query='SELECT * FROM '.$prefix."_banned WHERE ban_entry='$my_ip'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
                      die('8');}

/* --- */

$keep_time=$update*2;
$query='DELETE FROM '.$prefix."_online WHERE usr_id=$ajx_user OR ($timestamp-rtime)>$keep_time";
neutral_query($query);

$keep_time=$history*60;
$query='DELETE FROM '.$prefix."_lines WHERE ($timestamp-line_stamp)>$keep_time";
neutral_query($query);

$query='SELECT room_id,count(*) AS online FROM '.$prefix.'_online WHERE rtime IS NOT NULL GROUP BY room_id';
$result=neutral_query($query);
while($row=neutral_fetch_array($result)){
$online[$row['room_id']]=$row['online'];}

$query='SELECT * FROM '.$prefix.'_rooms';
$result=neutral_query($query);


while($room=neutral_fetch_array($result)){
$room_id=output($room['room_id'],2);

$room_name=output($room['room_name'],2);
$room_desc=output($room['room_desc'],2);

$room_name=str_replace("'",'',$room_name);
$room_name=escape($room_name);
$room_desc=escape($room_desc);


$room_online=0;
if(isset($online[$room_id])){$room_online=$online[$room_id];}

print $room_id.'|'.$room_name.'|'.$room_desc.'|'.$room_online.'^';
}
?>