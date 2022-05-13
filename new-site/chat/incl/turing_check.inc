<?php
$turing_ok=0;

if(function_exists('imagecolorallocate')&&function_exists('imagecreate')&&function_exists('imagettftext')&&$settings['turing_number']=='1'&&is_writeable('turing_number.png')){

if(isset($turnum)&&isset($md5num)){
$turnum=neutral_escape($turnum,5,'str');
$md5num=neutral_escape($md5num,32,'str');

if(strlen($turnum)==5&&strlen($md5num)==32){
$turing_exists=0;$turing_matches=0;

if(hsh($turnum.$settings['random'])==$md5num){$turing_matches=1;}

if($turing_matches=='1'){
$turnum=(int)$turnum;
$query='SELECT tur_number FROM '.$prefix."_tnumber WHERE tur_number=$turnum";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){$turing_exists=1;}}

if($turing_exists!='1'&&$turing_matches=='1'){
$query='INSERT INTO '.$prefix."_tnumber VALUES($turnum,$timestamp)";
neutral_query($query);$turing_ok=1;}

}}}
else{$turing_ok=1;}
?>